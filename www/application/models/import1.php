<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class Import1_Model extends ORM {
	protected $sorting = array('caption' => 'ASC');
    protected $has_many = array('rubrics');
    protected $belongs_to = array('rubric');

}
