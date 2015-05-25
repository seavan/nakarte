<?php
  
  class User_Friend_Model extends ORM
  {
  		protected $belongs_to = array('user', 'friend' => 'user');
  }
  
?>
