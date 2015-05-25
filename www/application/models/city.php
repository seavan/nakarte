<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php

class City_Model extends ORM {

    protected $sorting = array('name' => 'asc');
    protected $has_many = array('pois');

}
