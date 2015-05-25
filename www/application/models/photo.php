<?php defined('SYSPATH') OR die('No direct access allowed.');

class Photo_Model extends ORM {

	protected $sorting = array('id' => 'desc'); 
	protected $belongs_to = array('poi');
	protected $has_one = array('user');

	public static function get_path()
	{
		$conf = Kohana::config('photos'); 		
		return $conf['photo_path'];
	}
	
	public function thumb_url()
	{

		return self::get_path() . $this->guid . ".thumb.jpg";
	}

	public function full_url()
	{
		return self::get_path() . $this->guid . ".jpg";
	}

	public function view_url()
	{
		return '/photos/id/' . $this->id;
	}
	
	public function vote_css()
	{
		return (int)($this->vote_avg * 20);
	}

	public function chainPhoto($pos, $use_poi = false)
	{
		$ph_db = ORM::factory('photo');
		$where = array();
		$order = array();
		if($use_poi)
		{
			$where['poi_id'] = $this->poi->id;
			
		}
		
		if($pos > 0)
		{
			$where['id>'] = $this->id;
			$order['id'] = 'asc';
		}
        else
        {
        	$where['id<'] = $this->id;
        	$order['id'] = 'desc';
		}
		$ph_db = $ph_db->where($where)->orderby($order);
		
		$res = $ph_db->find();
		
		if($res->loaded) return $res;
		return null;		
	}	
	
	public function delete($with_image) {
		if ($with_image) {
			@unlink(DOCROOT.$this->full_url());
			@unlink(DOCROOT.$this->thumb_url());
		}
		return parent::delete();
	}
	
		public function showAddTime()
	{
		if (empty($this->add_time)) {return false;}
		$date=date('Y-m-d', $this->add_time);
		$time=' в '.date('H:i:s', $this->add_time);		
		return $date.$time;
	}
	
} // End User Model