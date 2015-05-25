<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Map controller
 
 */
class Json_Controller extends NakarteBase
{

	// Set the name of the template to use
	public $template = 'kohana/template_full';
	public $auto_render = FALSE;

	public function  __construct()
	{
		parent::__construct();
	}

	public function index()
	{

	}

	public function cities()
	{
		echo Json::toJson(ORM::factory('city')->find_all()->as_array());
	}

	public function rubrics()
	{
		$result = array();
		$rubrics = ORM::factory("rubric")->where('rubric_id', null)->find_all();
		foreach($rubrics as $rubric)
		{
			$result[] = $rubric;

			$result = array_merge($result, $rubric->rubrics->as_array());
		}

		echo Json::toJson($result);
	}

	public function get_child_rubrics($parentId)
	{
		echo Json::toJson(ORM::factory('rubric', $parentId)->rubrics);
	}

	public function attribute_types()
	{
		echo Json::toJson(ORM::factory("attribute_type")->find_all());

	}

	public function rubric_list_attribute_types($rubricId)
	{
		$rubric = ORM::factory("rubric", $rubricId);
		echo Json::toJson($rubric->attribute_types);
	}

	public function object_list_attributes($objectId)
	{
		$query =
				'SELECT DISTINCT attribute_types.*, attribute_values.id as attribute_value_id, attribute_values.value as attribute_value FROM attribute_types'
				. ' LEFT JOIN attribute_types_rubrics ON attribute_types_rubrics.attribute_type_id = attribute_types.id'
				. ' LEFT JOIN pois_rubrics ON pois_rubrics.rubric_id = attribute_types_rubrics.rubric_id'
				. ' LEFT JOIN attribute_values ON attribute_values.poi_id = pois_rubrics.poi_id AND attribute_values.attribute_type_id = attribute_types.id'
				. " WHERE pois_rubrics.poi_id = $objectId ORDER BY attribute_types.caption";
		$result = Database::instance()->query($query);

		echo Json::objectToJson($result);
	}

	public function object_list_rubrics($object_id)
	{
		$result = array();
		$rubrics = ORM::factory("poi", $object_id)->rubrics;

		$currentParentId = null;
		foreach($rubrics as $rubric)
		{

			if( $rubric->rubric_id != null )
			{
				if($rubric->rubric->id != $currentParentId)
				{
					$currentParentId = $rubric->rubric->id;
					$result[] = $rubric->rubric;
				}
				$result[] = $rubric;
			}
			//$result[] = $rubric;
		}

		echo Json::toJson($result);
	}



	public function get_data_types()
	{
		echo json_encode(array('result' => (Kohana::config('core.datatypes'))));
	}

	public function import_rubrics_1()
	{
		$imports = ORM::factory('import1')->find_all();
		echo Json::toJson($imports);
	}

	public function update_import_1($their_id, $our_id)
	{
		$import = ORM::factory('import1', $their_id);
		$import->rubric_id = $our_id;
		$import->save();
	}

	public function search($what)
	{

		$res = NakarteSearch::search(0, 0, 0, 0, $this->get_current_city_id(), $what);
		echo Json::objectToJson($res);
	}

	public function search_rubrics($rubric_list)
	{
		$rubrics = explode(":", $rubric_list);
		$res = NakarteSearch::search_rubrics(0, 0, 0, 0, $this->get_current_city_id(), $rubrics);
		echo Json::objectToJson($res);
	}

} // End Auth_Controller