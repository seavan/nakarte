<?php defined('SYSPATH') OR die('No direct access allowed.');

class Poi_Favorite_Model extends ORM {

	protected $sorting = array('id' => 'desc'); 
	protected $belongs_to = array('poi', 'user');
	
} // End User Model