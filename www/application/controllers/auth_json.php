<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Map controller
 
 */

class Auth_Json_Controller extends Json_Controller
{

	// Set the name of the template to use
	public $template = 'kohana/template_full';
	public $auto_render = FALSE;

	public function  __construct()
	{
		parent::__construct();
		if(! NakarteAuth::isAdmin() ) exit ('no access granted');
	}

	public function add_child_rubric($rubricId, $name)
	{
		$rubric = ORM::factory('rubric');
		$rubric->rubric_id = $rubricId;
		$rubric->name = $name;
		$rubric->save();
	}

	public function add_object_to_rubric($objectId, $rubricId)
	{
		$rubric = ORM::factory('rubric', $rubricId);
		$rubric->add( ORM::factory('poi', $objectId));
		$rubric->save();
	}

	public function remove_object_from_rubric($objectId, $rubricId)
	{
		$rubric = ORM::factory('rubric', $rubricId);
		$rubric->remove( ORM::factory('poi', $objectId));
		$rubric->save();
	}

	public function add_attribute_to_rubric($rubricId, $attributeTypeId)
	{
		echo "$rubricId:$attributeTypeId";
		$rubric = ORM::factory('rubric', $rubricId);
		$attributeType = ORM::factory('attribute_type', $attributeTypeId);
		echo $attributeType->id;
		$rubric->add($attributeType);
		$rubric->save();
	}

	public function remove_attribute_from_rubric($rubricId, $attributeTypeId)
	{
		$rubric = ORM::factory('rubric', $rubricId);
		$rubric->remove( ORM::factory('attribute_type', $attributeTypeId));
		$rubric->save();
	}

	public function create_attribute_type()
	{
		if($_GET)
		{

			$create_attribute_type_post = new Validation($_GET);
			$create_attribute_type_post->pre_filter('trim', TRUE);
			$create_attribute_type_post->add_rules('caption', 'required');
			$create_attribute_type_post->add_rules('type_index', 'required', 'numeric');

			if($create_attribute_type_post->validate())
			{
				$attribute_type = ORM::factory('attribute_type');
				$attribute_type->caption = $create_attribute_type_post->caption;
				$attribute_type->type_index = $create_attribute_type_post->type_index;
				$attribute_type->save();
			}
			else
			{
				echo json_encode($create_attribute_type_post->errors());
			}
		}
		else
		{
			echo "No get information";
		}
	}

	public function delete_attribute_type($attTypeId)
	{
		ORM::factory('attribute_type', $attTypeId)->delete();
	}

	public function create_object()
	{
		if($_POST)
		{
			$create_object_post = new Validation($_POST);
			$create_object_post->add_rules('caption','required');
			//$create_object_post->add_rules('description', 'required');
			if( $create_object_post->validate())
			{
				$poi = ORM::factory('poi');				
				$poi->caption = $create_object_post->caption;
				$poi->descr = $create_object_post->description;
				$poi->city_id = $create_object_post->city;				
				$poi->user_id = $this->get_user()->id;
				$poi->ctime = gmdate("Y-m-d H:i:s");
				$poi_city = $poi->city_id?(ORM::factory('city',$poi->city_id)->name):'';
				$poi->address = 'Казахстан, '.$poi_city;
				$poi->save();
				echo $poi->id;
			}
			
		}
	}

	public function delete_object($objectId)
	{
		$objectId = $objectId + 0;
		echo $objectId;
		$db = Database::instance();
		$db->query("DELETE FROM pois_rubrics WHERE poi_id=$objectId");
		$db->query("DELETE FROM attribute_values WHERE poi_id=$objectId");
		$db->query("DELETE FROM pois WHERE id=$objectId");
	}


	public function edit_object()
	{
		if($_POST)
		{
			$edit_object_post = new Validation($_POST);
			$edit_object_post->add_rules('caption', 'required');
			//$edit_object_post->add_rules('description', 'required');
			$edit_object_post->add_rules('id', 'required', 'numeric');
			$edit_object_post->add_rules('lat', 'required');
			$edit_object_post->add_rules('lon', 'required');
			$edit_object_post->add_rules('moderated', 'required');
			//$edit_object_post->add_rules('address', 'required');


			if( $edit_object_post->validate())
			{
				$poi = ORM::factory('poi', $edit_object_post->id);
				$poi->caption = $edit_object_post->caption;
				$poi->descr = $edit_object_post->description;
				$poi->lat = $edit_object_post->lat;
				$poi->lon = $edit_object_post->lon;
				$poi->address = $edit_object_post->address;
				$poi->city_id = $edit_object_post->city;
				$poi->state = $edit_object_post->moderated > 0 ? 1 : 0;
				$poi->save();
				echo $poi->id;
			}
			else
			{
				echo json_encode($edit_object_post->errors());
			}
		}
	}

	public function edit_object_attribute()
	{
		if($_POST)
		{
			$edit_object_post = new Validation($_POST);
			$edit_object_post->add_rules('poi_id', 'required', 'numeric');
			$edit_object_post->add_rules('attribute_type_id', 'required', 'numeric');
			$edit_object_post->add_rules('attribute_value', 'required');
			if( $edit_object_post->validate())
			{

				$edit_object_post->add_rules('attribute_value_id', 'required', 'numeric');

				if($edit_object_post->validate())
				{
					// we already have the attribute_value in db, modidy it
					$attribute_value = ORM::factory('attribute_value', $edit_object_post->attribute_value_id);
					$attribute_value->value = $edit_object_post->attribute_value;
					$attribute_value->attribute_type_id = $edit_object_post->attribute_type_id;
					$attribute_value->poi_id = $edit_object_post->poi_id;
					$attribute_value->save();
					echo $attribute_value->id;
				}
				else
				{
					$exists = ORM::factory('attribute_value')->where('poi_id', $edit_object_post->poi_id)->where('attribute_type_id', $edit_object_post->attribute_type_id)
							->count_all() > 0;
					if($exists)
					{
						echo "Attribute value already exists";
						return;
					}
					$attribute_value = ORM::factory('attribute_value');
					$attribute_value->value = $edit_object_post->attribute_value;
					$attribute_value->attribute_type_id = $edit_object_post->attribute_type_id;
					$attribute_value->poi_id = $edit_object_post->poi_id;
					$attribute_value->save();
					echo $attribute_value->id;
				}


			}
			else
			{
				echo json_encode($edit_object_post->errors());
			}
		}
	}
}