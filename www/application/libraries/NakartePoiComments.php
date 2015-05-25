<?php
  class NakartePoiComments extends NakarteComments
  {
  	  public function __construct($object_id)
  	  {
  	  	  parent::__construct('widgets/review/review_widget', 'poi', $object_id);
	  }
  }
?>
