<?php defined('SYSPATH') OR die('No direct access allowed.');

class Poi_Rubric_Model extends ORM {

	protected $sorting = array('poi_id' => 'desc'); 
	protected $belongs_to = array('poi', 'rubric');
	protected $table_name='pois_rubrics';
	
} // End User Model