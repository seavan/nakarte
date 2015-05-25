<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
* Map controller

*/
// defines our custom datatypes



class Admin_Controller extends Check_Controller
{

	// Set the name of the template to use
	public $template = 'admin/admin_template_full';

	public $types = array( STRING => 'Строка', INT => 'Целое', BOOLEAN => 'Логическое');

	public $view;

	public function  __construct()
	{
		parent::__construct();
		if(! NakarteAuth::isAdmin() )
		{
			url::redirect("/");
			exit ('no access granted');
		}
	}

	public function index()
	{
		$this->template->title = 'Панель управления';
		$this->view = new View("admin/admin_view_content");
		$this->template->content = $this->view;
		//if(!$this->authed) print( "Authentication required. Stub, so welcome in." );
	}

	public function select_city()
	{
		$this->index();
		$this->view->content = new View("admin/admin_select_city_content");
	}

	public function rubric_objects($cityId, $rubricId)
	{
		//$this->index();

		$iterator = ORM::factory('rubric', $rubricId)->pois;
		$members = array();

		foreach ($iterator as $member)
		{
			if($member->city_id == $cityId)
			{
				$members[] = $member->as_array();
			}
		}
		echo json_encode(array('result' => $members));
		exit();
	}

	public function list_objects_city($city, $page = 0)
	{
		$this->index();
		$view = new View("admin/admin_list_objects_content");
		$this->view->content = $view;
		$objects = ORM::factory('poi')->where(array('city_id' => $city));

		$itemsPerPage = 200;
		$page_num = $this->input->get('page', 1);
		$offset   = ($page_num - 1) * $itemsPerPage;

		$view->objCount = $itemsPerPage;
		$view->pagination = new Pagination(array(
		'base_url'    => "/admin/list_objects_city/", // base_url will default to current uri
		'uri_segment'    => "$city", // pass a string as uri_segment to trigger former 'label' functionality
		'total_items'    => $objects->count_all(), // use db count query here of course
		'items_per_page' => $itemsPerPage, // it may be handy to set defaults for stuff like this in config/pagination.php
		'style'          => 'classic' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));

		$view->limit_objects = $objects->where(array('city_id' => $city))->find_all($itemsPerPage, $view->pagination->sql_offset);
	}


	public function list_objects($page = 0)
	{
		$this->index();
		$view = new View("admin/admin_list_objects_content");
		$this->view->content = $view;
		$objects = ORM::factory('poi');

		$itemsPerPage = 200;
		$page_num = $this->input->get('page', 1);
		$offset   = ($page_num - 1) * $itemsPerPage;

		$view->objCount = $itemsPerPage;
		$view->pagination = new Pagination(array(
		'base_url'    => '/', // base_url will default to current uri
		'uri_segment'    => 'admin/list_objects', // pass a string as uri_segment to trigger former 'label' functionality
		'total_items'    => $objects->count_all(), // use db count query here of course
		'items_per_page' => $itemsPerPage, // it may be handy to set defaults for stuff like this in config/pagination.php
		'style'          => 'classic' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));

		$view->limit_objects = $objects->find_all($itemsPerPage, $view->pagination->sql_offset);
	}

	public function object($poi_id, $action)
	{
		$this->index();

		$object = ORM::factory('poi', $poi_id);
		$view = new View("admin/admin_object_content");
		$view->object = $object;
		$view->object_photo=ORM::factory('photo')->where('poi_id',$object->id)->select_list('id','guid');
		$this->view->content = $view;

		//$nextObject = Database::instance()->where(array('id >' => $poi_id))->orderby(array('city_id' => 'ASC', 'caption' => 'ASC', 'id' => 'ASC'))->get('pois');
		//$nextObject = ORM::factory('poi')->where( array("city_id >=" => $object->city_id, "caption >=" => $object->caption, "id != " => $object->id))->find_all(1, 0)->as_array();
		$nextObject = ORM::factory('poi')->where( array("id >" => $object->id))->find_all(1, 0)->as_array();
		if( count($nextObject) > 0) $view->nextObjectId = $nextObject[0]->id;
		$prevObject = ORM::factory('poi')->orderby(array("city_id" => "DESC", "caption" => "DESC"))->where( array("city_id <=" => $object->city_id, "caption <=" => $object->caption, "id != " => $object->id))->find_all(1, 0)->as_array();
		if( count($prevObject) > 0) $view->prevObjectId = $prevObject[0]->id;

	}

	public function create_object()
	{
		$this->index();
		$view = new View("admin/admin_create_object_content");
		$this->view->content = $view;
	}

	public function select_rubric()
	{
		$this->index();
		$view = new View("admin/admin_select_rubric_content");
		$this->view->content = $view;
	}

	public function edit_rubric($rubricId, $action)
	{
		$this->index();
		$rubric = ORM::factory('rubric', $rubricId);
		$view = new View("admin/admin_edit_rubric_content");
		$view->rubric = $rubric;
		$this->view->content = $view;
	}

	public function edit_attribute_types()
	{
		$this->index();
		$view = new View("admin/admin_edit_attribute_types_content");
		$this->view->content = $view;
	}

	public function rubric()
	{
		$this->index();

		if ($_POST)
		{
			$delete_post = new Validation($_POST);

			$delete_post->pre_filter('trim', TRUE);
			$delete_post->add_rules('delete','required');
			$delete_post->add_rules('selected_rubric_id', 'required');

			if($delete_post->validate())
			{
				// add cascade deleting
				$rubric = ORM::factory('rubric', $delete_post->selected_rubric_id);
				$rubric->delete();
			}

			$create_post = new Validation($_POST);

			$create_post->pre_filter('trim', TRUE);
			$create_post->add_rules('create','required');
			$create_post->add_rules('create_rubric_name', 'required');

			if($create_post->validate())
			{
				$rubric = ORM::factory('rubric');
				$rubric->name = $create_post->create_rubric_name;
				$rubric->save();
			}


			$add_post = new Validation($_POST);

			$add_post->pre_filter('trim', TRUE);
			$add_post->add_rules('add','required');
			$add_post->add_rules('add_rubric_name', 'required');
			$add_post->add_rules('add_to_rubric_id', 'required');
			if($add_post->validate())
			{
				$rubric = ORM::factory('rubric');
				$rubric->name = $add_post->add_rubric_name;
				$rubric->rubric_id = $add_post->add_to_rubric_id;
				$rubric->save();
			}

			$create_object_post = new Validation($_POST);
			$create_object_post->add_rules('selected_rubric_id', 'required');
			$create_object_post->add_rules('create_object','required');
			$create_object_post->add_rules('create_object_name', 'required');
			$create_object_post->add_rules('create_object_description', 'required');
			if( $create_object_post->validate())
			{
				$poi = ORM::factory('poi');
				$poi->name = $create_object_post->create_object_name;
				//                $poi->city_id = $city->id;
				//                $poi->lat = $city->lat;
				//                $poi->lon = $city->lon;
				// todo
				$poi->city_id = 8;
				$poi->descr = $create_object_post->create_object_description;
				$poi->ctime = gmdate("Y-m-d H:i:s");
				$poi->save();
				$rubric = ORM::factory('rubric', $create_object_post->selected_rubric_id);
				$rubric->add($poi);
				$rubric->save();

			}


			$create_attribute_type_post = new Validation($_POST);
			$create_attribute_type_post->add_rules('create_attribute_type','required');
			$create_attribute_type_post->add_rules('create_attribute_type_name', 'required');
			$create_attribute_type_post->add_rules('create_attribute_type_type_id', 'required');

			if($create_attribute_type_post->validate())
			{
				$attribute_type = ORM::factory('attribute_type');
				$attribute_type->caption = $create_attribute_type_post->create_attribute_type_name;
				$attribute_type->type_index = $create_attribute_type_post->create_attribute_type_type_id;
				$attribute_type->save();
			}

			$delete_attribute_type_post = new Validation($_POST);
			$delete_attribute_type_post->add_rules('delete_attribute_type','required');
			$delete_attribute_type_post->add_rules('selected_attribute_type_id', 'required');
			if($delete_attribute_type_post->validate())
			{
				$attribute_type = ORM::factory('attribute_type', $delete_attribute_type_post->selected_attribute_type_id);
				// make cascade delete
				$attribute_type->delete();
			}

			url::redirect(url::current(TRUE));
		}

		$view = new View('admin/rubric_admin_content');

		$rubricList = array();
		$rubrics = ORM::factory('rubric')->where('rubric_id', null)->find_all();
		$parentRubricList = array();
		foreach($rubrics as $rubric)
		{
			$parentRubricList[$rubric->id] = $rubric->name;
			$rubricList[$rubric->id] = $rubric->name;
			$childRubrics = ORM::factory('rubric')->where('rubric_id', $rubric->id)->find_all();
			foreach($childRubrics as $cr)
			{
				$rubricList[$cr->id] = "---" . $cr->name;
			}
		}

		$attributeTypeList = array();
		$attributeTypes = ORM::factory('attribute_type')->find_all();
		foreach($attributeTypes as $attributeType)
		{
			$attributeTypeList[$attributeType->id] = $attributeType->caption;
		}

		$view->rubrics = $rubricList;
		$view->parentRubrics = $parentRubricList;
		$view->paramTypes = $this->types;
		$view->attributeTypes = $attributeTypeList;

		$this->view->content = $view;
	}

	// вывод списка пользователей
	public function users()
	{
		$name='user';
		$fields=array('id'=>'id','email'=>'Email','avatar_guid'=>'Аватар','username'=>'Username','firstname'=>'Имя','lastname'=>'Фамилия',
								'city_id'=>'Город','icq'=>'ICQ','status'=>'Статус');
		$this->list_obj($name,$fields);		
	}

	//управление пользователями - просмотр данных, добавление, изменение, удаление
	public function user($action=NULL,$user_id=NULL)
	{
		$this->index();
		$user = ORM::factory('user', $user_id);
		//вывод сообщения о ненайденном пользователе, если левый id		
		if (!$user->id and $action<>'add') 
		{
			$view = new View("admin/admin404");
			$view->status='Пользователь с id='.$user_id.' не найден';
			$this->view->content = $view;
		}
		else {
			$view = new View("admin/user/".$action);
			$view->status='';	
			$view->user = $user;
			//$view->user_info=ORM::factory('user',$user->id)->as_array();
			$view->user_info=array('id'=>'id','email'=>'Email','username'=>'Username','firstname'=>'Имя','lastname'=>'Фамилия',
			'city_id'=>'Город','status'=>'Статус','logins'=>'Попыток входа','last_login'=>'Последнее посещение','mtime'=>'Время посл. изменения',
			'icq'=>'ICQ','mood'=>'Настроение','avatar_guid'=>'Аватар');
			$this->view->content = $view;		

			if ($action=='delete') 
			{
				$view->user=$user->email;
				$user->delete(); 
				$view->status='Пользователь '.$view->user.' успешно удален.';
			}
			// Изменение данных пользователя или добавление нового
			if (($action=='edit' || $action=='add' ) && $_POST)
			{
				$post = new Validation($_POST);
				$post->pre_filter('trim', TRUE);
				$post->add_rules('email','required','email');
				$post->add_rules('firstname','required');
				if ($action=='add') {$post->add_rules('password','required');				

					if (ORM::factory('user')->where('username', $post->email)->find()->loaded )
					{
						$post->add_error('email', 'exists');
					}
				}
				
				if( $post->validate() )
				{
					$old_avatar=DOCROOT.$user->avatar_url();
					$old_sm=DOCROOT.$user->avatar_url('sm');
					$old_mid=DOCROOT.$user->avatar_url('mid');
					
					$avatar_file_name = $this->upload_image('avatar');
					
					// instantiate User_Model and set attributes to the $_POST data
					if ($action=='add') {$user = ORM::factory('user');}
					$user->username = ($post->username?$post->username:$post->email);
					$user->lastname = $post->lastname;
					if ($post->password) { $user->password = $post->password;}
					$user->firstname = $post->firstname;
					$user->email = $post->email;
					$date = date( 'Y-m-d H:i:s');
					$user->ctime = $date;
					$user->mtime = $date;
					$user->atime = $date;
					$user->status = $post->status;
					$user->city_id = $post->city_id;
					$user->icq = $post->icq;
					$user->mood = isset($post->mood)?$post->mood:'';
					$user->avatar_guid = $avatar_file_name?$avatar_file_name:$post->avatar_guid;
					//$user->loaded === TRUE;

					// if the user was successfully created...
					$user->add(ORM::factory('role', 'login'));
					$user->save();
					//после сохранение удаляем старую картинку
						if ($avatar_file_name && !is_null($user->avatar_guid)) {@unlink($old_avatar); @unlink($old_sm); @unlink($old_mid);}					
					
					if ($action=='add') {url::redirect('admin/user/view/'.$user->id);}

					$view->status='<font color=green>Изменения успешно сохранены!</font>'.$avatar_file_name;								
				}
				else
				{
					$view->errors = $post->errors('errors');
					/*foreach($errors as $key => $value)
					{
						echo $value . "<br/>";			
					}*/
				}
			}		
			
		}


		//$nextObject = Database::instance()->where(array('id >' => $poi_id))->orderby(array('city_id' => 'ASC', 'caption' => 'ASC', 'id' => 'ASC'))->get('pois');
		//$nextObject = ORM::factory('poi')->where( array("city_id >=" => $object->city_id, "caption >=" => $object->caption, "id != " => $object->id))->find_all(1, 0)->as_array();
		/*
		$nextObject = ORM::factory('user')->where( array("id >" => $user->id))->find_all(1, 0)->as_array();
		if( count($nextObject) > 0) $view->nextObjectId = $nextObject[0]->id;
		$prevObject = ORM::factory('user')->orderby(array("id" => "DESC", "username" => "DESC"))->where( array("id <=" => $object->id, "username <=" => $object->username, "id != " => $object->id))->find_all(1, 0)->as_array();
		if( count($prevObject) > 0) $view->prevObjectId = $prevObject[0]->id;
		*/

	} //end of user function
	
		public function cities()
	{
			$name='city_stat';
			$fields=array('id'=>'id','lat'=>'Широта','lon'=>'Долгота','name'=>'Название','kzname'=>'Название (каз.)',
								'poi_count'=>'Кол-во объектов');
			$this->list_obj($name,$fields);
	}
	
	//управление городами - просмотр данных, добавление, изменение, удаление
	public function city($action=NULL,$city_id=NULL)
	{
		$this->index();
		$city = ORM::factory('city', $city_id);
		//вывод сообщения о ненайденном городе, если левый id		
		if (!$city->id and $action<>'add') 
		{
			$view = new View("admin/admin404");
			$view->status='Город с id='.$city_id.' не найден';
			$this->view->content = $view;
		}
		else {
			$view = new View("admin/city/".$action);
			$view->status='';	
			$view->city = $city;
			//$view->user_info=ORM::factory('user',$user->id)->as_array();
			$view->city_info=array('id'=>'id','lat'=>'Широта','lon'=>'Долгота','name'=>'Название','kzname'=>'Название (каз.)',
								'poi_count'=>'Кол-во объектов');
			$this->view->content = $view;		

			if ($action=='delete') 
			{
				$view->city=$city->name;
				$city->delete(); 
				$view->status='Город '.$view->city.' успешно удален.';
			}
			// Изменение данных пользователя или добавление нового
			if (($action=='edit' || $action=='add' ) && $_POST)
			{
				$post = new Validation($_POST);
				$post->pre_filter('trim', TRUE);
				$post->add_rules('name','required');
				//$post->add_rules('lat','required');
				//$post->add_rules('lon','required');				
								
				if( $post->validate() )
				{
					// instantiate User_Model and set attributes to the $_POST data
					if ($action=='add') {$city = ORM::factory('city');
										$city->name = $post->name;
										$city->kzname = $post->name;
										$city->save();
										url::redirect('admin/city/edit/'.$city->id);
										}
					else
					{
					$city->name = $post->name;
					$city->kzname = $post->kzname?$post->kzname:$post->name; 
					$city->lat = $post->lat?$post->lat:$post->lat_map;
					$city->lon = $post->lon?$post->lon:$post->lon_map;

					// if the city was successfully created...
					$city->save();
					$view->status='<font color=green>Изменения успешно сохранены!</font>';
					url::redirect('admin/city/view/'.$city->id);	
					}							
				}
				else
				{
					$view->errors = $post->errors('errors');
				/*	foreach($errors as $key => $value)
					{
						echo $value . "<br/>";			
					} */
				}
			}		
			
		}


		//$nextObject = Database::instance()->where(array('id >' => $poi_id))->orderby(array('city_id' => 'ASC', 'caption' => 'ASC', 'id' => 'ASC'))->get('pois');
		//$nextObject = ORM::factory('poi')->where( array("city_id >=" => $object->city_id, "caption >=" => $object->caption, "id != " => $object->id))->find_all(1, 0)->as_array();
		/*
		$nextObject = ORM::factory('user')->where( array("id >" => $user->id))->find_all(1, 0)->as_array();
		if( count($nextObject) > 0) $view->nextObjectId = $nextObject[0]->id;
		$prevObject = ORM::factory('user')->orderby(array("id" => "DESC", "username" => "DESC"))->where( array("id <=" => $object->id, "username <=" => $object->username, "id != " => $object->id))->find_all(1, 0)->as_array();
		if( count($prevObject) > 0) $view->prevObjectId = $prevObject[0]->id;
		*/

	} //end of city function
	
	//генерация табличного списка объектов (используется в Пользователях, Городах, ...)
	public function list_obj($obj, $fields)
	{ 
		$obj_plural=($obj=='city_stat')?'cities':(inflector::plural($obj));
		$this->index();
		//$view = new View('admin/admin_'.$obj_plural.'_list');
		$view = ($obj<>'city_stat')? new View('admin/'.$obj.'/list'): new View('admin/city/list');		
		$this->view->content = $view;		
				
		//search
		$search=array();
		if ($_GET)
			{
				$get = new Validation($_GET);
				$order[$get['sort']] = isset($get['order'])?$get['order']:'asc';
				$get->pre_filter('trim', TRUE);				
								
				if( $get->validate() )
				{				
					foreach ($get as $key=>$val)
					{
						if (!empty($val) && $key<>'submit' && $key<>'order' && $key<>'sort') {$search[$key] = $val;}
					}					
				}
			}		//end of search	
		if (!isset($order)) {$order['id'] = 'asc';}
		$objects = ORM::factory($obj)->like($search);
		$total_items=$objects->count_all();
		$objects=ORM::factory($obj)->like($search); //it's nesessary 'coz count_all() reset 'like' filter
		//разбивка на страницы
		$itemsPerPage = $obj=='photo'?10:20;
		$page_num = $this->input->get('page', 1);
		$offset   = ($page_num - 1) * $itemsPerPage;
		$view->pagination = new Pagination(array(
		'base_url'    => '/', // base_url will default to current uri
		'uri_segment'    => 'admin/'.$obj_plural, // pass a string as uri_segment to trigger former 'label' functionality
		'total_items'    => $total_items, // use db count query here of course
		'items_per_page' => $itemsPerPage, // it may be handy to set defaults for stuff like this in config/pagination.php
		'style'          => 'classic' // pick one from: classic (default), digg, extended, punbb, or add your own!
		));
		$view->objects = $objects->orderby($order)->find_all($itemsPerPage, $view->pagination->sql_offset);
		//какие поля выводить в списке (только поля из таблицы бд, добавочные - во view)
		$view->list_fields=$fields; 		
	} //end of list_obj function
	
	public function photos()
	{
			$name='photo';
			$fields=array('id'=>'id','user_id'=>'Пользователь','poi_id'=>'Объект','guid'=>'Превью (клик для просмотра)','descr'=>'Описание',
								'add_time'=>'Дата добавления','vote_avg'=>'Рейтинг', 'vote_count'=>'Голосов');
			$this->list_obj($name,$fields);			
	}
	
			//управление фото - просмотр данных, добавление, изменение, удаление
	public function photo($action=NULL,$photo_id=NULL,$from_obj=NULL)
	{
		$this->index();
		$photo = ORM::factory('photo', $photo_id);		
		//вывод сообщения о ненайденном фото, если левый id		
		if ($action<>'add' && !$photo->id)
		{
			$view = new View("admin/admin404");
			$view->status='Фото с id='.$photo_id.' не найдено';
			$this->view->content = $view;
		}
		else //если фото существует
		{
			$view = new View("admin/photo/".$action);
			$view->status=''.$from_obj;
			$view->photo = $photo;
			//$view->user_info=ORM::factory('user',$user->id)->as_array();
			if ($action == 'add' && !is_null($photo_id)) {
			    $view->poi=ORM::factory('poi',$photo_id);

			    }
											
			$view->photo_info=array('id'=>'id','user_id'=>'Пользователь','city_id'=>'Город','poi_id'=>'Объект','guid'=>'Превью','descr'=>'Описание',
								'add_time'=>'Дата добавления','vote_avg'=>'Рейтинг', 'vote_count'=>'Голосов');
								
			$view->cur_user=$this->get_user()->id;
			$this->view->content = $view;

			if ($action=='delete') 
			{
				$view->photo=$photo->id;				
				$photo->delete('TRUE');		//TRUE - удалить вместе с файлами (картинка+превью)		
				$view->status='Фото успешно удалено.';
				if (strpos($_SERVER['HTTP_REFERER'],'object')) {url::redirect($_SERVER['HTTP_REFERER'].'#object_photo_tab');}
			}					
			// Изменение фото или добавление нового
			if (($action=='edit' || $action=='add' ) && $_POST)
			{
		
				$post = new Validation($_POST);
				$post->pre_filter('trim', TRUE);
				$post->add_rules('user_id','required');
				$post->add_rules('poi_id','required');
				//$post->add_rules('guid','required');				
				//$post->add_rules('lat','required');
				//$post->add_rules('lon','required');				
								
				if ($action=='add') {
					$photo = ORM::factory('photo');									
				} else	{
					$view->status='<font color=green>Изменения успешно сохранены!</font>'.$from_obj;				
				}
				if( $post->validate() )
				{
				$old_thumb=DOCROOT.$photo->thumb_url();
			    $old_photo=DOCROOT.$photo->full_url();			   
				//загрузка фото
			    $photo_file_name = $this->upload_image('photo');
			    


					// instantiate Photo_Model and set attributes to the $_POST data
					
						$photo->user_id = $post->user_id;
						$photo->poi_id = $post->poi_id;
						$photo->guid = ($photo_file_name)?$photo_file_name:$post->guid;
						$photo->descr = $post->descr;
						$dt_elements = explode(' ',$post->add_time);
						$date_elements = explode('-',$dt_elements[0]);
						$time_elements =  explode(':',$dt_elements[1]);
						$photo->add_time=mktime($time_elements[0], $time_elements[1],$time_elements[2], $date_elements[1],$date_elements[2], $date_elements[0]);
						$photo->vote_avg=$post->vote_avg;
						$photo->vote_count=$post->vote_count;


						// if the photo was successfully created...
						$photo->save();	
						//после сохранение удаляем старую картинку
						if ($photo_file_name) {@unlink($old_photo); @unlink($old_thumb);}					
						if (isset($from_obj)) {url::redirect('/admin/object/175/view#object_photo_tab');}
				    
				    if ($action=='add') {
						if ($photo_id) { 
							url::redirect('admin/object/'.$photo_id.'/view#object_photo_tab');
							} else { url::redirect('admin/photo/view/'.$photo->id);
						}
						
					}				
				} //конец if( $post->validate()
				else
				{
					$view->errors = $post->errors('errors');
				/*	foreach($errors as $key => $value)
					{
						echo $value . "<br/>";			
					} */
				}
			}		// конец _изменение фото или добавление нового_
			
		} //конец _если фото существует_


		//$nextObject = Database::instance()->where(array('id >' => $poi_id))->orderby(array('city_id' => 'ASC', 'caption' => 'ASC', 'id' => 'ASC'))->get('pois');
		//$nextObject = ORM::factory('poi')->where( array("city_id >=" => $object->city_id, "caption >=" => $object->caption, "id != " => $object->id))->find_all(1, 0)->as_array();
		/*
		$nextObject = ORM::factory('user')->where( array("id >" => $user->id))->find_all(1, 0)->as_array();
		if( count($nextObject) > 0) $view->nextObjectId = $nextObject[0]->id;
		$prevObject = ORM::factory('user')->orderby(array("id" => "DESC", "username" => "DESC"))->where( array("id <=" => $object->id, "username <=" => $object->username, "id != " => $object->id))->find_all(1, 0)->as_array();
		if( count($prevObject) > 0) $view->prevObjectId = $prevObject[0]->id;
		*/

	} //end of city function
}
