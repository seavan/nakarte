<?php defined('SYSPATH') OR die('No direct access allowed.');

class User_Model extends Auth_User_Model {
	protected $sorting = array(/*'city_id' => 'asc', 'caption' => 'asc',*/ 'id' => 'desc');
	protected $has_and_belongs_to_many = array('rubrics', 'roles');
	protected $has_one = array('city');
	protected $has_many = array('attribute_values', 'poi_comments', 'photo_comments', 'poi_comment_ratings', 'photo_comment_ratings', 
								'poi_favorites', 'poi_beens', 'photos','user_friends');
	
	public function have_in_favorites($poi_id)
	{
		$pf = ORM::factory('poi_favorite')->where(array('user_id'=>$this->id,'poi_id'=>$poi_id))->count_all();
		return $pf>0;
		
	}
	public function add_favorite($poi)
	{
		$pf = ORM::factory('poi_favorite');
		if (!$this->have_in_favorites($poi->id)) {
		$pf->user_id = $this->id;
		$pf->poi_id = $poi->id;		
		$pf->save();
	}
		
	}
	
	public function remove_favorite($poi)
	{
		$pf = ORM::factory('poi_favorite')->where( array('poi_id' => $poi->id, 'user_id' => $this->id) );
		$pf->delete_all();
	}
	
	public function count_friends()
	{
		return count($this->user_friends);
	}		
	
	public function get_friends($per_page=null,$offset=0)
	{
		$objects= ORM::factory('User_Friend')->where('user_id', $this->id)->find_all($per_page,$offset);
		return NakarteBase::get_objects($objects);
	}
	
	public function get_photos($per_page=null,$offset=0)
	{
		$objects = ORM::factory('photo')->where('user_id', $this->id)->find_all($per_page,$offset);
		return NakarteBase::get_objects($objects);
	}
	
	public function get_fav_places($per_page=null,$offset=0)
	{
		$objects = ORM::factory('poi_favorite')->where('user_id', $this->id)->find_all($per_page,$offset);
		return NakarteBase::get_objects($objects);		
	}
	
	public function get_been_places($per_page=null,$offset=0)
	{
		$objects = ORM::factory('poi_been')->where('user_id', $this->id)->find_all($per_page,$offset);
		return  NakarteBase::get_objects($objects);
	}
	
	public function add_friend($friend)
	{
		$fl = ORM::factory('user_friend');
		$fl->user_id = $this->id;
		$fl->friend_id = $friend->id;
		$fl->save();
	}
	
	public function delete_friend($friend)
	{
		$fl = ORM::factory('user_friend')->where( array('friend_id' => $friend->id));
		$fl->delete_all();		
	}
	
	
	public function hasViewPermission($object)
	{
		return true;
	}
	
	public function hasEditPermission($object)
	{
		return NakarteAuth::getUserId() == $object->id;
	}
	
	public function hasOwnerPermission($object)
	{
		return NakarteAuth::getUserId() == $object->id;
	}
	
	public function get_city()
	{
		return ORM::factory('city')->where('id', $this->city_id)->find();
	}
	
	public function avatar_url($size=NULL,$realpic=FALSE)
	{
		$conf = Kohana::config('photos');
		$path=$conf['avatars_path'];
		$size=isset($size)?'_'.$size:'';		
		if ($realpic) 
		{
			$avatar=($this->avatar_guid)?$path.$this->avatar_guid.$size.'.jpg':null;
		} 
		else 
		{
			$avatar=($this->avatar_guid)?$path.$this->avatar_guid.$size.'.jpg':'/static/i/avatar'.$size.'.png';
		}
		return $avatar;
		
	}
	
	public function getViewUrl()
	{
		return '/u' . $this->id;
	}
	
	public function getFullName()
	{
		$last=$this->lastname;
		$last=(isset($last) && $last)?' '.$last:'';
		return $this->firstname.$last;
	}
} // End User Model
