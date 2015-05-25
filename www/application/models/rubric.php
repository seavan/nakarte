<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
class Rubric_Model extends ORM
{
	protected $sorting = array('rubric_id' => 'asc', 'order' => 'asc', 'name' => 'asc');
	protected $has_many = array('rubrics');
	protected $belongs_to = array('rubric');
	protected $has_and_belongs_to_many = array('pois', 'attribute_types');

	public static function get_parent_rubrics()
	{
		return ORM::factory("rubric")->where( array('rubric_id' => null) )->find_all();
	}
	
	public function get_parent_rubric()
	{
		$rubric_id = ORM::factory("rubric")->where( array('id' => $this->id) )->rubric_id;
		$rubric_id=$rubric_id?$rubric_id:$this->id;
		return ORM::factory('rubric',$rubric_id);
	}
	
	public function get_sub_rubrics()
	{
		return ORM::factory('rubric')->where( array('rubric_id' => $this->id) )->find_all();
	}	
}
