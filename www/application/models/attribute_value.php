<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class Attribute_Value_Model extends ORM {

    protected $belongs_to = array('poi', 'attribute_type');
}
