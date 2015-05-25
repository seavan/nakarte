<?php defined('SYSPATH') OR die('No direct access allowed.');
/**

*/
class Nakarte_Controller extends NakarteBase
{
	public function  __construct()
	{
		parent::__construct();
		$this->map_block = new View('widgets/map/closed_map_widget');
		$this->search_block = new View('widgets/search/search_widget');
	}

	public function index()
	{
		$this->map_block = new View('widgets/map/map_widget');		
		$this->main_block = new View('civil/main_page_content');
		$this->main_block->photos = ORM::factory('photo')->find_all(Kohana::config("photos.latest_photo_count"));
	}

	public function poi($id)
	{
		$poi = ORM::factory("poi", $id);
		$photos = $poi->photos;
		$photo_count = count($photos);

		$this->main_block = new View('civil/view_poi_content');
		$this->main_block->photo_count = $photo_count;
		$this->main_block->photos = $photos;
		$this->main_block->poi = $poi;
	}


	public function create_poi()
	{
		if( !NakarteAuth::isLoggedIn() )
		{
			$this->main_block = new View('civil/auth_required');
			return;
		}

		if($_POST)
		{
			$add_place = new Validation($_POST);
			$add_place->pre_filter('trim', TRUE);
			$add_place->add_rules('caption', 'required');
			$add_place->add_rules('description', 'required');
			$add_place->add_rules('address', 'required');
			$add_place->add_rules('coords', 'required');
			//			$add_place->add_rules('city_id', 'required');

			if($add_place->validate())
			{
				$coords = $add_place->coords;
				list($lon, $lat) = explode(',', $coords);
				$poi = ORM::Factory("poi");
				$poi->caption = $add_place->caption;
				$poi->description = $add_place->description;
				$poi->lat = $lat;
				$poi->lon = $lon;
				$poi->address = $add_place->address;
				$poi->user_id = NakarteAuth::getUserId();

				// todo
				$poi->city_id = $this->get_current_city_id();
				// end todo
			}

			$this->main_block = new View('civil/edit_poi_attributes');
		}
		else
		{
			$this->main_block = new View('civil/create_poi_content');
		}
	}

}
