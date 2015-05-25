<?php defined('SYSPATH') OR die('No direct access allowed.');
/**

 */

class People_Controller extends NakarteBase
{
	public function  __construct()
	{
		parent::__construct();
		$this->map_block = new View('widgets/map/closed_map_widget');
		$this->search_block = new View('widgets/search/search_widget');
		$this->list_type='';		
	}

	public function index($page_num = 0)
	{
		
		//$people_count=$this->item_count();	
		
		$this->pagination = new Pagination(array(
    	'base_url'    	 => '/people/'.$this->list_type, // base_url will default to current uri
    	'total_items'    => $this->people_count, // use db count query here of course
    	'items_per_page' => $this->per_page(), // it may be handy to set defaults for stuff like this in config/pagination.php
    	'style'          => 'punbb' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));		
		//$this->init_pagination();
		$this->main_block = new View('civil/view_people_all');
		$this->main_block->users = $this->get_items();	
		
		$this->main_block->users_count = $this->people_count;
		//$this->main_block->users_count = $this->people_count;
		$this->main_block->css_class = 'block';
		$this->main_block->avatar_size = 'mid';
		
		
	}
	
	public function item_count()
	{
		return $this->get_orm()->count_all();
		//return Database::instance()->count_last_query(); // damn count_all() reset query
		//return $this->get_user_count();		
				
	}
	
	public function per_page()
	{
		return 12;		
	}
	
	public function get_items()
	{
		$first_item=($this->pagination->current_first_item == 0)?0:$this->pagination->current_first_item -1;
		return $this->get_orm()->find_all($this->per_page(), ($first_item));
	}
	
	public function get_orm()
	{
		return $this->orm;		
	}
	
	protected $orm;
	
	public function init_pagination()
	{
		$this->pagination = new Pagination(array(
    	'base_url'    	 => '/people/'.$this->list_type, // base_url will default to current uri
    	'total_items'    => $this->item_count(), // use db count query here of course
    	'items_per_page' => $this->per_page(), // it may be handy to set defaults for stuff like this in config/pagination.php
    	'style'          => 'punbb' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));		
	}
	
	public function all($page_num = 1) 
	{
		$this->orm = ORM::factory('user');
		$this->people_count= $this->item_count();
		$this->orm = ORM::factory('user')->orderby( NULL,'rand()');
		$this->list_type='all/';
		$this->index();		
	}
	
	public function latest($page_num = 1) 
	{
		$this->orm = ORM::factory('user');
		$this->people_count= $this->item_count();
		$this->orm = ORM::factory('user')->orderby( array('id' => 'desc'));
		$this->list_type='latest/';
		$this->index();		
	}
	
	public function search($page_num=1)	
	{
		if ($_GET) {
		$get = new Validation($_GET);
			if (isset($get['fsearch']) || isset($get['sfsearch'])) {
				$get->pre_filter('trim', TRUE);				
							
				if( $get->validate() ) {
					$search=HTML::specialchars($get['fsearch']);
					list($fname,$lname)=explode(" ",$search." ",2);
					$lname=isset($lname)&&!empty($lname)?trim($lname):$fname;				
					$this->orm = ORM::factory('user')->orlike(array('firstname'=>$fname,'lastname'=>$lname));
					$this->people_count= $this->item_count();
					$this->orm = ORM::factory('user')->orlike(array('firstname'=>$fname,'lastname'=>$lname));
					$this->list_type='search/';
					$this->index();
				}
			}
		}
		else $this->latest();
		
	}
}
