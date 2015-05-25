<?php defined('SYSPATH') OR die('No direct access allowed.');
/**

 */

class Places_Controller extends NakarteBase
{
	
	public function  __construct()
	{
		parent::__construct();
		$this->map_block = new View('widgets/map/map_widget');
		$this->search_block = new View('widgets/search/search_widget');
	}

	public function index($page_num=1)
	{
		
	}
	
/*	public function latest($page_num = 1) 
	{
		$page_num <= 0 and ($page_num = 1);
		$page_num = abs($page_num);
		$conf = Kohana::config('places');
		$per_page = $conf['places_count_new'];
		$offset = ($page_num-1) * $per_page;
		
		$all_places_count = $this->get_latest_places_count();
		$this->pagination = new Pagination(array(
    	'base_url'    	 => '/places/latest/', // base_url will default to current uri
    	'total_items'    => $all_places_count, // use db count query here of course
    	'items_per_page' => $per_page, // it may be handy to set defaults for stuff like this in config/pagination.php
    	'style'          => 'punbb' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));		
		$this->map_block = new View('widgets/map/closed_map_widget');
		$this->main_block = new View('civil/view_places_all_new');
		$this->main_block->places = $this->get_latest_places_all($per_page,$offset);	
		$this->main_block->places_count = $all_places_count;
		
		$categories = ORM::factory('rubric')->where( array('rubric_id' => null))->find_all(); // выборка всех категорий
		$this->main_block->categories = $categories;
		
		$sub_categories = array(); // выборка всех подкатегорий
		$this->main_block->sub_categories = $sub_categories;
		
		$this->main_block->cur_class_all = "class='cur'"; //Подсветка вкладки Новые места
	} */
	
	public function show_places($page_num = 1,$type='all') 
	{
		
		$city=NakarteBase::get_current_city();
		$page_num <= 0 and ($page_num = 1);
		$page_num = abs($page_num);
		$conf = Kohana::config('places');
		$per_page = ($type=='popular')?$conf['places_count_popular']:$conf['places_count_new'];
		$offset = ($page_num-1) * $per_page;
		
		//сделать универсальные методы нахождения мест по рубрикам - перенести из Poi_Model в NakarteBase
		if ($type=='popular') 
		{
			$sort=array('poi.ctime' => 'DESC');
		} 
		elseif ($type=='latest')
		{
			$sort=array('poi.vote_avg' => 'DESC');			
		}
		elseif ($type=='all')
		{
			$sort=array(null,'rand()');
		}
		
		if ($_GET) {
				$get = new Validation($_GET);
				if (isset($get['cat']) || isset($get['subcat'])) {
					$get->pre_filter('trim', TRUE);				
									
					if( $get->validate() ) {				
						$rubric_id=(isset($get['subcat']) && $get['subcat'])?$_GET['subcat']:$_GET['cat'];
						$rubric=ORM::factory('rubric',$rubric_id);	
						//$places= ORM::factory('poi_rubric')->with('poi')->where(array('poi.city_id' => $city->id, 'rubric_id'=>$rubric_id))->orderby($sort)->find_all($per_page,$offset);													
						$method='get_'.$type.'_places_rubric';
						$places=$this->$method($rubric_id,$per_page,$offset);						
						$sub_categories = isset($get['cat'])?ORM::factory('rubric',$get['cat'])->get_sub_rubrics():array(); // выборка всех подкатегорий
						$parent_category = $rubric->get_parent_rubric();
						$title=$rubric->name.' города '.$city->name;
						$all_places_count=$this->$method($rubric_id)->count();
						$origin='rubrics';
					}
				}
		} 
		else {
			//@todo: если $type=all, запрашивать все по алфавиту
			$places= ($type=='popular')?$this->get_popular_places_all($per_page,$offset):$this->get_latest_places_all($per_page,$offset);
			$all_places_count = ($type=='popular')?$this->get_popular_places_count():$this->get_latest_places_count();
			$sub_categories=array();
			$title='Места города '.$city->name;
		}
		
		
		
		$this->pagination = new Pagination(array(
		    	'base_url'    	 => '/', // base_url will default to current uri
		    	'uri_segment'    => '/places/'.$type, // base_url will default to current uri
		    	'total_items'    => $all_places_count, // use db count query here of course
		    	'items_per_page' => $per_page, // it may be handy to set defaults for stuff like this in config/pagination.php
		    	'style'          => 'punbb' // pick one from: classic (default), digg, extended, punbb, or add your own!
			));		
		$this->map_block = new View('widgets/map/closed_map_widget');
		$this->main_block = new View('civil/view_places_all_new');
		$this->main_block->places = $places;	
		$this->main_block->places_count = $all_places_count;
		
		$categories = ORM::factory('rubric')->get_parent_rubrics(); // выборка всех категорий
		$this->main_block->categories = $categories;		
		$this->main_block->sub_categories = $sub_categories;		
		$this->main_block->parent_category = isset($parent_category)?$parent_category:null;
		$this->main_block->title = $title;		
		$this->main_block->origin = isset($origin)?$origin:false;
		
		if ($type=='popular') {
			$this->main_block->cur_class_popular = "class='cur'"; //Подсветка вкладки Новые места
		} 
		elseif ($type='latest') {
			$this->main_block->cur_class_all = "class='cur'";
		}
	}
	
/*	public function popular($page_num = 1) 
	{
		$page_num <= 0 and ($page_num = 1);
		$page_num = abs($page_num);
		$conf = Kohana::config('places');
		$per_page = $conf['places_count_popular'];
		$offset = ($page_num-1) * $per_page;
		$all_places_count = $this->get_popular_places_count();
		
		$this->pagination = new Pagination(array(
    	'base_url'    	 => '/places/popular/', // base_url will default to current uri
    	'total_items'    => $all_places_count, // use db count query here of course
    	'items_per_page' => $per_page, // it may be handy to set defaults for stuff like this in config/pagination.php
    	'style'          => 'punbb' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));		
		
		$this->map_block = new View('widgets/map/closed_map_widget');
		$this->main_block = new View('civil/view_places_all_new');
		$this->main_block->places = $this->get_popular_places_all($per_page,$offset);	
		$this->main_block->places_count = $all_places_count;

		$categories = Rubric_Model::get_parent_rubrics(); // выборка всех категорий
		$this->main_block->categories = $categories;
		
		$sub_categories = array(); // выборка всех подкатегорий
		$this->main_block->sub_categories = $sub_categories;
		
		$this->main_block->cur_class_popular = "class='cur'"; //Подсветка вкладки Популярные места
	} */
	
		public function related($poi_id, $page_num = 1) 
	{
		$page_num <= 0 and ($page_num = 1);
		$page_num = abs($page_num);
		$conf = Kohana::config('places');
		$per_page = $conf['places_count_related'];
		$offset = ($page_num-1) * $per_page;
		$poi=ORM::factory('poi',$poi_id);
		$all_places_count = $poi->get_related_places_rubric()->count();
		$base_url='/poi/'.$poi_id.'/related';		
		$this->pagination = new Pagination(array(
    	'base_url'    	 => '/poi/'.$poi_id, // base_url will default to current uri
    	'uri_segment'    =>'related',
    	'total_items'    => $all_places_count, // use db count query here of course
    	'items_per_page' => $per_page, // it may be handy to set defaults for stuff like this in config/pagination.php
    	'style'          => 'punbb' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));		
		
		$this->map_block = new View('widgets/map/closed_map_widget');
		$this->main_block = new View('civil/view_places_all_new');
		$this->main_block->places = $poi->get_related_places_rubric($per_page,$offset);	
		$this->main_block->places_count = $all_places_count;
		$this->main_block->origin='related';

		$categories = Rubric_Model::get_parent_rubrics(); // выборка всех категорий
		$this->main_block->categories = $categories;
		
		$this->main_block->cur_class_popular = "class='cur'"; //Подсветка вкладки Популярные места
	}
}
