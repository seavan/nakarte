<?php
	class User_Controller extends Json_Controller
	{
		public function add_to_favorites()
		{
			if ($_POST)
			{
				NakarteAuth::isLoggedIn() or die( "not logged in" );
				
				$fav_poi = new Validation($_POST);
				$fav_poi->add_rules('object_id', 'required');
	
				if( $fav_poi->validate() )
				{
					NakarteAuth::getUser()->add_favorite(ORM::factory('poi', $fav_poi->object_id));
					echo 'success';
				}
				else
				{
					print 'post data errors';
				}
			}
		}	
	}  
?>
