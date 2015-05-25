<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 */
class Profile_Controller extends NakarteBase
{
       public function  __construct()
	{
		parent::__construct();
     	$this->map_block = new View('widgets/map/closed_map_widget');
        $this->search_block = new View('widgets/search/search_widget');
	}

	public function index($id=NULL)
	{        
        //если id не задан, показываем собственный профиль. Если незалогинен - не показываем ничего
        if (!isset($id)) {
					if( !NakarteAuth::isLoggedIn() ) {
						url::redirect('people/all');
						//$this->main_block = new View('civil/auth_required');
						return;
					} 
			
			$id=$this->get_user();			
		}		 
        
        $this->show_profile($id);
		
	}

    public function show_profile($id)
    {

		$user =  ORM::factory('user')->where('id', $id)->find();
		$conf=Kohana::config('users');
		
		//профиль свой или чужой
		$own_profile=($id==$this->get_user())?true:false;
		
		// Город и страна пользователя

		$city=$user->get_city();
		//$user_city_id = $user->city_id;

		if ($city->id)
			{
				$user_city = ', '.$city->name;
			}
			else
			{
				$user_city = '';
			}
        
        // Время последнего посещения		
		 
        $last_login = $user->last_login;
		$duration = time()-intval($last_login);
		if ($duration < 86400) $last_login = strftime('сегодня в '."%H:%M ", $last_login);
		elseif (($duration > 86400)&&($duration < 172800)) $last_login = strftime('вчера в '."%H:%M ", $last_login); 
		else $last_login = strftime("%e %B".' в '."%H:%M ", $last_login);
 
   //   $photo = ORM::factory('photo')->where('user_id', $id)->find(); 

  //    $photo_user = $photo->guid;

        // Фотки пользователей

        $photos = $user->get_photos($photo_max=$conf['max_photos_profile']);
        $photo_count=count($user->photos);
		
		// друзья
		
		$friends=$user->get_friends($friends_max=$conf['max_friends_profile']);
		$friends_count=$user->count_friends();
		
		// Любимые места 
		
		$fav_places = $user->get_fav_places($fav_places_max=$conf['max_fav_places_profile']);
		$fav_places_count=count($user->poi_favorites);
				
		
		// Где побывал
		
		$been_places = $user->get_been_places($been_places_max=$conf['max_been_places_profile']);
		$been_places_count=count($user->poi_beens);
		
		
		$this->main_block = new View('civil/profile/profile2', 
		array('user' => $user, 			  
			  'last_login' => $last_login, 
			  'user_city' => $user_city, 			 
			  'friends' => $friends, 
			  'friends_count' => $friends_count,
			  'friends_max'=>$friends_max, 
			  'photos' => $photos, 
			  'photo_count' => $photo_count,
			  'photo_max'=>$photo_max,
			  'fav_places' => $fav_places, 
			  'fav_places_count' => $fav_places_count,
			  'fav_places_max'=>$fav_places_max,
			  'been_places' => $been_places, 
			  'been_places_count' => $been_places_count,
			  'been_places_max'=>$been_places_max,
			  'own_profile'=>$own_profile));
    }


	public function poi($id)
	{
		if($_POST)
		{
			$add_comment = new Validation($_POST);

			$add_comment->pre_filter('trim', TRUE);
			$add_comment->add_rules('add_comment','required');
			$add_comment->add_rules('text','required');

			if(NakarteAuth::isLoggedIn())
			{
				if($add_comment->validate())
				{
					$comment = ORM::factory("comment");
					$comment->text = $add_comment->text;
					$comment->user_id = NakarteAuth::getUser()->id;
					$comment->poi_id = $id;
					$comment->save();

					if($add_comment->vote)
					{
						$poi = ORM::factory("poi", $id);
						$poi->addVote($comment->user_id, $add_comment->vote, $comment->id);
					}

					url::redirect(url::current());
				}
			}
		}

		$poi = ORM::factory("poi", $id);
		$photos = $poi->photos;
		$photo_count = count($photos);

		$this->main_block = new View('civil/view_poi_content');
		$this->main_block->photo_count = $photo_count;
		$this->main_block->photos = $photos;
		$this->main_block->poi = $poi;




	}

	public function create_poi()
	{
		if( !NakarteAuth::isLoggedIn() )
		{
			$this->main_block = new View('civil/auth_required');
			return;
		}

        if($_POST)
        {
			$add_place = new Validation($_POST);
			$add_place->pre_filter('trim', TRUE);
			$add_place->add_rules('caption', 'required');
			$add_place->add_rules('description', 'required');
			$add_place->add_rules('address', 'required');
			$add_place->add_rules('coords', 'required');
//			$add_place->add_rules('city_id', 'required');

        	if($add_place->validate())
        	{
        		$coords = $add_place->coords;
        		list($lon, $lat) = explode(',', $coords);
        		$poi = ORM::Factory("poi");
        		$poi->caption = $add_place->caption;
				$poi->description = $add_place->description;
				$poi->lat = $lat;
				$poi->lon = $lon;
				$poi->address = $add_place->address;
				$poi->user_id = NakarteAuth::getUserId();

				// todo
				$poi->city_id = $this->get_current_city_id();
				// end todo
			}

		    $this->main_block = new View('civil/edit_poi_attributes');
        }
        else
        {
            $this->main_block = new View('civil/create_poi_content');
        }
	}
	
	public function upload_avatar()
	{
		$old_avatar=DOCROOT.$this->get_user()->avatar_url(null,$realpic=TRUE);
		$old_sm=DOCROOT.$this->get_user()->avatar_url('sm',$realpic=TRUE);
		$old_mid=DOCROOT.$this->get_user()->avatar_url('mid',$realpic=TRUE);
		$id=$this->get_user()->id;
		if ($this->upload_image('avatar',$id)) {@unlink($old_avatar); @unlink($old_sm); @unlink($old_mid);}			
		url::redirect('/profile');		
	}
	
	public function friends($id=NULL,$page_num=1) 
	{
		if (!isset($id)) {
					if( !NakarteAuth::isLoggedIn() ) {
						url::redirect('/');
						//$this->main_block = new View('civil/auth_required');
						return;
					} 			
			$user=$this->get_user();			
		}	else {
			$user=ORM::factory('user',$id);			
		}	        
		
		$conf=Kohana::config('users');
		
		$page_num==0 and $page_num++;
		$page_num = abs($page_num);
		$per_page= $conf['max_friends'];
		$offset=($page_num-1) * $per_page;		
		$friends=$user->get_friends($per_page,$offset);
		$all_friends_count = $user->count_friends();		
		$this->pagination = new Pagination(array(
    	'base_url'    	 => '/u'.$user->id.'/friends', // base_url will default to current uri
    	'total_items'    => $all_friends_count, // use db count query here of course
    	'items_per_page' => $per_page, // it may be handy to set defaults for stuff like this in config/pagination.php
    	'style'          => 'punbb' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));		
		//$this->map_block = new View('widgets/map/closed_map_widget');
		//$this->main_block = new View('civil/view_user_friends',array('user'=>$user,'friends'=>$friends,'view_type'=>'friends_page'));		
		$this->main_block = new View('civil/view_people_all',array('users'=>$friends,'users_count'=>$all_friends_count,'origin'=>'friends'));
		//$this->main_block->friends_count = $all_friends_count;	
		$column_count=4;		
		$this->main_block->column_count = $column_count;
		$this->main_block->css_class = 'block';
		$this->main_block->avatar_size = 'mid';
		$this->main_block->show_name = true;
		$this->main_block->origin = 'friends';		
		$this->main_block->title = 'Друзья пользователя <a href="'.$user->getViewUrl().'">'.$user->getFullName().'</a>';
	}

		public function favorite_places ($id=NULL,$page_num=1)
		{
			$place_type='favorite';
			
			$this->places($id,$page_num,$place_type);
		}
		
		public function been_places ($id=NULL,$page_num=1)
		{
			$place_type='been';
			
			$this->places($id,$page_num,$place_type);
		}
		
		public function places ($id=NULL,$page_num=1,$place_type) 
	{
		if (!isset($id)) {
					if( !NakarteAuth::isLoggedIn() ) {
						url::redirect('/');
						//$this->main_block = new View('civil/auth_required');
						return;
					} 			
			$user=$this->get_user();			
		}	else {
			$user=ORM::factory('user',$id);			
		}	        
		
		$conf=Kohana::config('places');		
		$per_page= $conf['places_count_user'];		
		$page_num==0 and $page_num++;
		$page_num = abs($page_num);		
		$offset=($page_num-1) * $per_page;				
		
		if ($place_type=='favorite') {
			$places=$user->get_fav_places($per_page,$offset);
			$places_count=count($user->get_fav_places());
			$title='Избранные места пользователя <a href="'.$user->getViewUrl().'">'.$user->getFullName().'</a>';
		} else {
			$places=$user->get_been_places($per_page,$offset);
			$places_count=count($user->get_been_places());
			$title='Посещенные места пользователя <a href="'.$user->getViewUrl().'">'.$user->getFullName().'</a>';
		}
		
		//$places=ORM::factory('poi')->where('user_id','77');
		//$places=$objects = ORM::factory('poi_favorite')->where('user_id', $user->id);		
			
		$this->pagination = new Pagination(array(
    	'base_url'    	 => '/u'.$user->id.'/'.$place_type.'_places', // base_url will default to current uri
    	'total_items'    => $places_count, // use db count query here of course
    	'items_per_page' => $per_page, // it may be handy to set defaults for stuff like this in config/pagination.php
    	'style'          => 'punbb' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));		
		//$this->map_block = new View('widgets/map/closed_map_widget');
		//$this->main_block = new View('civil/profile/view_user_places',array('user'=>$user,'places'=>$places,'view_type'=>'favorite'));		
		$this->map_block = new View('widgets/map/closed_map_widget');
		$this->main_block = new View('civil/view_places_all_new');
		$this->main_block->places = $places;	
		$this->main_block->places_count = $places_count;
		$categories = ORM::factory('rubric')->where( array('rubric_id' => null))->find_all(); // выборка всех категорий
		$this->main_block->categories = $categories;
		$sub_categories=array();
		$this->main_block->sub_categories = $sub_categories;
		$this->main_block->title = $title;
		//@todo : скрыть во view фильтры и поиск для мест в профиле
		$this->main_block->engine = '/u'.$user->id.'/'.$place_type.'_places';
		$this->main_block->hide_search = true;
		$this->main_block->origin = 'friends';
		
		//$this->main_block->places_count = $fav_places_count;	
		$column_count=4;		
		$this->main_block->column_count = $column_count;		
	}
		
		public function photos ($id=NULL,$page_num=1) 
	{
		if (!isset($id)) {
					if( !NakarteAuth::isLoggedIn() ) {
						url::redirect('/');
						//$this->main_block = new View('civil/auth_required');
						return;
					} 			
			$user=$this->get_user();			
		}	else {
			$user=ORM::factory('user',$id);			
		}	        
		
		$conf=Kohana::config('photos');		
		$per_page= $conf['photos_per_page'];
		$page_num==0 and $page_num++;
		$page_num = abs($page_num);		
		$offset=($page_num-1) * $per_page;
		
		$photos = $user->get_photos($per_page,$offset);
		$all_photos_count = count($user->photos);
		$this->pagination = new Pagination(array(
    	'base_url'    	 => '/u'.$user->id.'/photos', // base_url will default to current uri
    	'total_items'    => $all_photos_count, // use db count query here of course
    	'items_per_page' => $per_page, // it may be handy to set defaults for stuff like this in config/pagination.php
    	'style'          => 'punbb' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));		
		$this->map_block = new View('widgets/map/closed_map_widget');
		$this->main_block = new View('civil/view_photos_all');
		$this->main_block->photos = $photos;
		//$photos=$this->main_block->photos = $this->get_photos_all($per_page,$offset);	
		$this->main_block->photos_count = $all_photos_count;		
		$categories = ORM::factory('rubric')->where( array('rubric_id' => null))->find_all(); // выборка всех категорий
		$this->main_block->categories = $categories;		
		$this->main_block->cur_class_all = "class='cur'"; //Подсветка вкладки Новые места	
		$this->main_block->title='Фотографии пользователя <a href="'.$user->getViewUrl().'">'.$user->getFullName().'</a>';	
		$this->main_block->origin='profile';
		$column_count=4;		
		$this->main_block->column_count = $column_count;		
	}

}
