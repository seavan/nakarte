<?php
  class NakartePhotoComments extends NakarteComments
  {
  	  public function __construct($object_id)
  	  {
  	  	  parent::__construct('widgets/review/review_widget', 'photo', $object_id);
	  }
  }
?>
