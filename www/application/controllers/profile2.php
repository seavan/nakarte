<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 */
class Profile2_Controller extends NakarteBase
{
       public function  __construct()
	{
		parent::__construct();
     	$this->map_block = new View('widgets/map/closed_map_widget');
        $this->search_block = new View('widgets/search/search_widget');
	}

	public function index()
	{

    //    this->prof($id);

	}

    public function prof($id)
    {

		$user =  ORM::factory('user')->where('id', $id)->find();

		// Город и страна пользователя

		$user_city_id = $user->city_id;

		if (isset($user_city_id))
			{
				$city =  ORM::factory('city')->where('id', $user_city_id)->find();

				$user_city = $city->name;

				$user_city = ', '.$user_city;
			}
			else
			{
				$user_city = ', Астана';
			}

        // Время последнего посещения

        $last_login = $user->last_login;
		$duration = time()-intval($last_login);
		if ($duration < 86400) $last_login = strftime('сегодня в '."%H:%M ", $last_login);
		elseif (($duration > 86400)&&($duration < 172800)) $last_login = strftime('вчера в '."%H:%M ", $last_login);
		else $last_login = strftime("%e %B".' в '."%H:%M ", $last_login);

   //   $photo = ORM::factory('photo')->where('user_id', $id)->find();

  //    $photo_user = $photo->guid;

        // Фотки пользователей

        $photos = ORM::factory('photo')->where('user_id', $id)->find_all();

        if (count($photos)!== 0)
		{
			$i = 1;
			foreach($photos as $f)
			{
				$all_photos_user[$i] = $f->guid;
				$i++;
			}
		}
		else
		{
			$all_photos_user = array();
		}

		// аватарки друзей

		$user_friends_obj = ORM::factory('User_Friend')->where('user_id', $id)->find_all();

		if (count($user_friends_obj)!== 0)
		{
			$i = 1;
			foreach($user_friends_obj as $f)
			{
				$user_friends[$i] = $f->friend_id;
				$friend_avatar_obj = ORM::factory('user')->where('id', $user_friends[$i])->find();
				$friend_avatar[$i] = $friend_avatar_obj->avatar_guid;
				$i++;
			}
		}
		else
		{
			$user_friends = array();
			$friend_avatar = array();
		}
        
		// Любимые места
		
		
        /* Прежний вывод
		$user_favorite_obj = ORM::factory('poi_favorite')->where('user_id', $id)->find_all();

		if (count($user_favorite_obj)!== 0)
		{
			$i = 1;
			foreach($user_favorite_obj as $f)
			{
				$poi_id[$i] = $f->poi_id;
				$favorite_obj = ORM::factory('poi')->where('id', $poi_id[$i])->find();
				$favorite_caption[$i] = $favorite_obj->caption;
				$favorite_address[$i] = $favorite_obj->address;
				$favorite_vote[$i] = $favorite_obj->vote_avg;
				$favorite_comment_obj = ORM::factory('poi_comment')->where('poi_id', $poi_id[$i])->find_all();
				$count_comment[$i] = count($favorite_comment_obj);
				if ($count_comment[$i]==0) $count_comment[$i] = ' ';
				$i++;
			}
		}
		else
		{
			$favorite_caption = array();
			$favorite_address = array();
			$favorite_vote  = array();
			$count_comment = array();
		}
        */
		// Где побывал

		$user_been_obj = ORM::factory('poi_been')->where('user_id', $id)->find_all();

		if (count($user_been_obj)!== 0)
		{
			$i = 1;
			foreach($user_been_obj as $f)
			{
				$poi_id[$i] = $f->poi_id;
				$been_obj = ORM::factory('poi')->where('id', $poi_id[$i])->find();
				$been_caption[$i] = $been_obj->caption;
				$been_address[$i] = $been_obj->address;
				$been_vote[$i] = $been_obj->vote_avg;
				$been_comment_obj = ORM::factory('poi_comment')->where('poi_id', $poi_id[$i])->find_all();
				$count_comment_been[$i] = count($been_comment_obj);
				if ($count_comment_been[$i]==0) $count_comment[$i] = ' ';
				$i++;
			}
		}
		else
		{
			$been_caption = array();
			$been_address = array();
			$been_vote  = array();
			$count_comment_been = array();
		}

		$this->main_block = new View('civil/profile/profile2',
		array('id' => $id,
		      'user' => $user,
			  'photos' => $photos,
			  'last_login' => $last_login,
//			  'photo_user' => $photo_user,
			  'user_city' => $user_city,
			  'all_photos_user' => $all_photos_user,
			  'user_friends' => $user_friends,
			  'friend_avatar' => $friend_avatar,
//			  'favorite_caption' => $favorite_caption,
//			  'favorite_address' => $favorite_address,
//			  'user_favorite_obj' => $user_favorite_obj,
//			  'favorite_vote' => $favorite_vote,
//			  'count_comment' => $count_comment,
			  'been_caption' => $been_caption,
			  'been_address' => $been_address,
			  'user_been_obj' => $user_been_obj,
			  'been_vote' => $been_vote,
			  'count_comment_been' => $count_comment_been));

    }


	public function poi($id)
	{
		if($_POST)
		{
			$add_comment = new Validation($_POST);

			$add_comment->pre_filter('trim', TRUE);
			$add_comment->add_rules('add_comment','required');
			$add_comment->add_rules('text','required');

			if(NakarteAuth::isLoggedIn())
			{
				if($add_comment->validate())
				{
					$comment = ORM::factory("comment");
					$comment->text = $add_comment->text;
					$comment->user_id = NakarteAuth::getUser()->id;
					$comment->poi_id = $id;
					$comment->save();

					if($add_comment->vote)
					{
						$poi = ORM::factory("poi", $id);
						$poi->addVote($comment->user_id, $add_comment->vote, $comment->id);
					}

					url::redirect(url::current());
				}
			}
		}

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
