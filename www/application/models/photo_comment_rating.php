<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class Photo_Comment_Rating_Model extends ORM {
//     protected $sorting = array('atime' => 'desc');
     protected $belongs_to = array('photo', 'user');
}
?>
