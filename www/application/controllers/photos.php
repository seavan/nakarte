<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Photo controller

 */


class Photos_Controller extends NakarteBase
{
	public function  __construct()
	{
		parent::__construct();
		$this->search_block = new View('widgets/search/search_widget');
	}
	
	public function all($page_num=1) 
	{
		$page_num==0 and $page_num++;
		$page_num = abs($page_num);
		$conf = Kohana::config('photos');
		$photo_path= $conf['photo_path'];
		$per_page= $conf['photos_per_page'];
		$offset=($page_num-1) * $per_page;
		$all_photos = ORM::factory('photo')->find_all();
		$all_photos_count = $all_photos->count();
		$this->pagination = new Pagination(array(
    	'base_url'    	 => '/photos/all/', // base_url will default to current uri
    	'total_items'    => $all_photos_count, // use db count query here of course
    	'items_per_page' => $per_page, // it may be handy to set defaults for stuff like this in config/pagination.php
    	'style'          => 'punbb' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));		
		$this->map_block = new View('widgets/map/closed_map_widget');
		$this->main_block = new View('civil/view_photos_all');
		$photos=$this->main_block->photos = $this->get_photos_all($per_page,$offset);	
		$this->main_block->photos_count = $all_photos_count;
	
		$categories = ORM::factory('rubric')->where( array('rubric_id' => null))->find_all(); // выборка всех категорий
		$this->main_block->categories = $categories;
		
		$this->main_block->cur_class_all = "class='cur'"; //Подсветка вкладки Новые места
	}	
	
	public function popular($page_num=1) 
	{
		$page_num==0 and $page_num++;
		$page_num = abs($page_num);
		$conf = Kohana::config('photos');
		$photo_path= $conf['photo_path'];
		$per_page= $conf['photos_per_page'];
		$offset=($page_num-1) * $per_page;
		$all_photos = ORM::factory('photo')->find_all();
		$all_photos_count = $all_photos->count();
		$this->pagination = new Pagination(array(
    	'base_url'    	 => '/photos/popular/', // base_url will default to current uri
    	'total_items'    => $all_photos_count, // use db count query here of course
    	'items_per_page' => $per_page, // it may be handy to set defaults for stuff like this in config/pagination.php
    	'style'          => 'punbb' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));		
		$this->map_block = new View('widgets/map/closed_map_widget');
		$this->main_block = new View('civil/view_photos_all');
		$photo=$this->main_block->photos = $this->get_photos_all($per_page,$offset);	
		$this->main_block->photos_count = $all_photos_count;
	
		$categories = ORM::factory('rubric')->where( array('rubric_id' => null))->find_all(); // выборка всех категорий
		$this->main_block->categories = $categories;
		
		$this->main_block->cur_class_popular = "class='cur'"; //Подсветка вкладки Популярные места
	}
	
	public function upload()
	{
		$conf = Kohana::config('photos');
		
		$photo = Validation::factory($_FILES)
			->add_rules('picture', 'upload::valid', 'upload::type[gif,jpg,png]', 'upload::size[1M]');
		
		$poi_id = $_POST['poi_id'];
		
		if ($photo->validate())
		{
			$photo_file_name = substr(Guid::newguid(), -12);
			// Temporary file name
			$filename = upload::save('picture');
			// Создание превью файла
			Image::factory($filename)
				->resize($conf['thumb_resize_width'], $conf['thumb_resize_height'], Image::HEIGHT)
				->save(DOCROOT.$conf['photo_path'].$photo_file_name.'.thumb.jpg');
 			// Создание основного рисунка
			$width = Image::factory($filename)->__get('width');
			$height = Image::factory($filename)->__get('height');
			
			if($width > $conf['image_resize_width'] || $height > $conf['image_resize_height'])
			{ 
				Image::factory($filename)
					->resize($conf['image_resize_width'], $conf['image_resize_height'], Image::HEIGHT)
					->save(DOCROOT.'userdata/photo/'.$photo_file_name.'.jpg');				
			} 
			else
			{
				Image::factory($filename)
					->save(DOCROOT.'userdata/photo/'.$photo_file_name.'.jpg');				
			}
			
			// Добавление записи о добавленной фотографии в БД
			$photo_db = ORM::factory('photo');
			if( $this->get_user() )
			{
				$photo_db->user_id =  $this->get_user()->id;
			}
			$photo_db->guid = $photo_file_name;
			$photo_db->poi_id = $poi_id;
			$photo_db->save();
			
			// Remove the temporary file
			unlink($filename);
 
			// Redirect back to the account page
			url::redirect("poi/$poi_id");
		} else {
			$this->session->set('photo_error', 'Ошибка загрузки фотографии. Размер фотографии не должен превышать 1 Мб. Формат фотографии - JPG');
			url::redirect("poi/$poi_id");
			exit;
		}
	}

	//вместо $id было $guid
	public function id($id)
	{
		$this->map_block = new View('widgets/map/closed_map_widget');
		$this->main_block = new View('civil/photo_one');
		$this->main_block->photo = ORM::factory('photo',$id);
	}
	
	public function addVote()
	{
		//Валидация параметров голосования
		$post = new Validation($_POST);
		$post->pre_filter('trim');
		$post->add_rules('user_id','required','numeric');
		$post->add_rules('photo_id','required','numeric');
		$post->add_rules('rating','required','numeric','chars[1,2,3,4,5]');
		
		if ($post->validate())
		{
		  $user_id = $_POST['user_id'];
		  $photo_id = $_POST['photo_id'];
		  $vote = $_POST['rating'];

		  $photo = ORM::factory("photo", $photo_id);
		  $photo->addVote($user_id, $vote);
		} else {
			echo "Валидация не прошла!";
			exit;
		}
	}
}
