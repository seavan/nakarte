<?php defined('SYSPATH') OR die('No direct access allowed.');
/**

*/
class NakarteBase extends Template_Controller
{
	public $template = 'civil/main_template';
	public $session;
	private $cities;
	private $current_city_id;
	private $yakey;
	protected $header_block;

	public function get_yakey()
	{
		if(!$this->yakey)
		{
			$keys = Kohana::config('yandex.key');
			$host = $_SERVER['HTTP_HOST'];
			foreach($keys as $h => $k)
			{
				if(preg_match("/.*$h/", $host))
				{
					$this->yakey = $k;
					break;
				}
			}
		}
		return $this->yakey;
	}

	public function get_header_block()
	{
		return $this->header_block;
	}


	public function get_footer_block()
	{
		return $this->footer_block;
	}

	protected $footer_block;

	public function get_map_block()
	{
		return $this->map_block;
	}

	protected $map_block;

	public function get_main_block()
	{
		return $this->main_block;
	}
	protected $main_block;

	public function get_search_block()
	{
		return $this->search_block;
	}
	protected $search_block;

	public function get_rubrics_block()
	{
		return $this->rubrics_block;
	}
	protected $rubrics_block;

	public function get_places_all ($per_page,$offset)
	{
		return ORM::factory('poi')->find_all($per_page,$offset);
	}
	
	public function get_all_places_rubric($rubric_id,$per_page=null, $offset=0)
	{
		return ORM::factory('poi_rubric')->with('poi')->where(array('rubric_id'=>$rubric_id, 'poi.city_id' => $this->get_current_city_id()))->orderby(array('poi.caption' => 'ASC'))->find_all($per_page,$offset);
	}

	public function get_latest_places()
	{
		return ORM::factory('poi')->where( array('city_id' => $this->get_current_city_id()))->orderby(array('ctime' => 'DESC'))->find_all(5, 0);
	}

	public function get_latest_places_all($per_page,$offset)
	{
		return ORM::factory('poi')->where( array('city_id' => $this->get_current_city_id()))->orderby(array('ctime' => 'DESC'))->find_all($per_page,$offset);
	}
	
		public function get_latest_places_count()
	{
		return ORM::factory('poi')->where( array('city_id' => $this->get_current_city_id()))->orderby(array('ctime' => 'DESC'))->count_all();
	}
	
	public function get_latest_places_rubric($rubric_id, $per_page=null,$offset=0)
	{
		return ORM::factory('poi_rubric')->with('poi')->where(array('rubric_id'=>$rubric_id, 'poi.city_id' => $this->get_current_city_id()))->orderby(array('poi.vote_avg' => 'DESC'))->find_all($per_page,$offset);
	}

	public function get_popular_places()
	{
		return $this->get_popular_places_all(10, 0);
	}

	public function get_popular_places_all($per_page,$offset)
	{
		return ORM::factory('poi')->where(array('city_id' => $this->get_current_city_id(), 'vote_avg>' => '0'))->orderby(array('vote_avg' => 'DESC'))->find_all($per_page,$offset);
	}

	public function get_popular_places_count()
	{
		return ORM::factory('poi')->where(array('city_id' => $this->get_current_city_id(), 'vote_avg>' => '0'))->orderby(array('vote_avg' => 'DESC'))->count_all();
	}
	
	public function get_popular_places_rubric($rubric_id, $per_page=null,$offset=0)
	{
		return ORM::factory('poi_rubric')->with('poi')->where(array('rubric_id'=>$rubric_id, 'poi.city_id' => $this->get_current_city_id(), 'poi.vote_avg>' => '0'))->orderby(array('poi.vote_avg' => 'DESC'))->find_all($per_page,$offset);
	}

	public function get_city_stats()
	{
		return $this->city_stats;
	}
	private $city_stats;

	public function get_auth_block()
	{
		return $this->auth_block;
	}
	private $auth_block;

	public function get_user()
	{
		return Auth::instance()->get_user();
	}

	public function get_top_users()
	{
		return ORM::factory('user')->find_all(5, 0);
	}

	public function get_users_all($per_page,$offset)
	{
		return ORM::factory('user')->find_all($per_page,$offset);
	}

	public function get_photos_all($per_page,$offset)
	{
		return ORM::factory('photo')->find_all($per_page,$offset);
	}

	public function get_current_city_id()
	{
		if(!isset($current_city_id))
		{
			if(cookie::get('nakarte_city_id'))
			{
				$current_city_id = 0 + cookie::get('nakarte_city_id', NULL, true);
			}
			else
			{
				/* Алматы */
				$current_city_id = 8;
			}
		}
		return $current_city_id;
	}

	public function get_current_city()
	{
		return ORM::factory('city', $this->get_current_city_id());
	}

	public function get_cities()
	{
		if( !isset($this->cities) )
		{
			$this->cities = ORM::factory('city')->find_all();
		}
		return $this->cities;
	}

	public function get_user_count()
	{
		return ORM::factory('user')->count_all();
		/* if ($this->get_current_city()->name=='Алматы') {
		
			return ORM::factory('user')->orwhere(array('city_id'=>($this->get_current_city_id()),'city_id'=>null))->count_all();
		} 
		else 
		{
			return ORM::factory('user')->where('city_id',$this->get_current_city_id())->count_all();
		} */
			
	}

	public function get_photo_count()
	{
		return ORM::factory('photo')->count_all();
	}

	public function select_city($city_id)
	{
		//		cookie::set('nakarte_current_city', $city_id, 100000);
	}

	public function  __construct()
	{
		parent::__construct();
		$this->header_block = new View('widgets/common/header_widget');
		$this->footer_block = new View('widgets/common/footer_widget');
		$this->rubrics_block = new View('widgets/search/rubric_widget');

		// make statistics
		$this->city_stats = ORM::factory("city_stat")->find(8);

		if(Auth::instance()->logged_in())
		{
			$this->auth_block = new View('widgets/auth/authed_widget');
		}
		else
		{
			$this->auth_block = new View('widgets/auth/sign_widget');
		}

		$this->session = Session::instance();

	}

	/* функции работы с базой */
	public function get_parent_rubrics()
	{
		return ORM::factory('rubric')->where('rubric_id', null)->find_all();
	}

    /* для виджета get_user_favourite_places ($user_id) */

   public function get_user_favourite_places($id)
	{
		// Любимые места пользователя с идентификатором $id
		$per_page = 10;
		$offset =0;
	    return ORM::factory('poi_favorite')->where('user_id', $id)->orderby(array('poi_id' => 'ASC'))->find_all($per_page,$offset);
				
    }
	
	public function get_user_visited_places($id)
	{
	    // Места, где побывал пользователь с идентификатором $id
		$per_page = 10;
		$offset =0;
	    return ORM::factory('poi_been')->where('user_id', $id)->orderby(array('poi_id' => 'ASC'))->find_all($per_page,$offset);
			
	}
	
	public function upload_image($type,$object_id=NULL)
	{
		$file = Validation::factory($_FILES)
			->add_rules('picture', 'upload::valid', 'upload::type[gif,jpg,png]', 'upload::size[5M]');
		
		if (!empty($_FILES['picture']['name']) && $file->validate())
		{
			$conf = Kohana::config('photos');
			$path = ($type=='photo')?$conf['photo_path']:$conf['avatars_path'];
			$image_file_name = substr(Guid::newguid(), -12);
			// Temporary file name	
			$filename = upload::save('picture');
			$image=Image::factory($filename);
			$width = $image->width;
			$height = $image->height;
			
			//используется для получения квадратных аватарок без искажения пропорций - но с кропом
			//при необходимости раскомментить и вставить $master_dimention вместо Image::AUTO в код создания аватарок ниже
			$master_dimention=($width > $height)?(Image::HEIGHT):(Image::WIDTH);			
			if ($type=='photo') {
			// Создание превью файла
			$image
				->resize($conf['thumb_resize_width'], $conf['thumb_resize_height'], Image::HEIGHT)
				->save(DOCROOT.$path.$image_file_name.'.thumb.jpg');
	 		} else {
				// Создание small и medium аватарок
				$sizes=array('sm','mid');
				foreach ($sizes as $size) {
					$image					
						->resize($conf['avatar_'.$size.'_width'], $conf['avatar_'.$size.'_height'], $master_dimention)					
						->crop($conf['avatar_'.$size.'_width'], $conf['avatar_'.$size.'_height'], 'top')
						->save(DOCROOT.$path.$image_file_name.'_'.$size.'.jpg');				
				}			
			}
 			// Создание основного рисунка			
			
			if($width > $conf['image_resize_width'] || $height > $conf['image_resize_height'])
			{ 
				Image::factory($filename)
					->resize($conf['image_resize_width'], $conf['image_resize_height'], Image::HEIGHT)
					->save(DOCROOT.$path.$image_file_name.'.jpg');				
			} 
			else
			{
				Image::factory($filename)
					->save(DOCROOT.$path.$image_file_name.'.jpg');				
			}
			
			// Добавление записи о добавленной картинке в БД
			if (!is_null($object_id)) {
				$type=($type=='avatar')?'user':$type;
				$object_db=ORM::factory($type,$object_id);
				if ($type=='photo') { 
					$object_db->guid = $image_file_name;
					} else {
						$object_db->avatar_guid=$image_file_name;
						}
				$object_db->save();
			}
			
			// Remove the temporary file
			if ($filename && file_exists($filename)) {@unlink($filename);}
			return $image_file_name;
 
			// Redirect back to the account page
			//url::redirect("poi/$poi_id"); */
			
		} else {
			//$this->session->set('photo_error', 'Ошибка загрузки фотографии. Размер фотографии не должен превышать 5 Мб. Формат фотографии - JPG');
			//url::redirect("poi/$poi_id");
			return false;
			//exit; 
		}
	}
		public function get_objects($orm)
	{
		if (count($orm)!==0) 
		{
			return $orm;
		}
		else
		{
			return array();
		}		
	}
}

