<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class Poi_Been_Model extends ORM {
     protected $sorting = array('id' => 'desc'); 
     protected $belongs_to = array('poi', 'user');
}
?>