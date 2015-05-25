<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class Attribute_Type_Model extends ORM {

    protected $has_and_belongs_to_many = array('rubrics');
	protected $has_many = array('attribute_type_substitution');
}
