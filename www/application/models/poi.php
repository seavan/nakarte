<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php

class Poi_Model extends ORM
{

	protected $sorting = array(/*'city_id' => 'asc', 'caption' => 'asc',*/ 'id' => 'asc');
	protected $has_and_belongs_to_many = array('rubrics');
	protected $belongs_to = array('city');
	protected $has_one = array('city', 'user');
	protected $has_many = array('attribute_values', 'poi_comments', 'poi_comment_ratings', 'photos', 'poi_favorites');

	public function addVote($user_id, $vote, $comment_id)
	{
		$already_voted = ORM::factory('comment_rating')->where( array('user_id' => $user_id, 'poi_id' => $this->id));

		if( $already_voted->count_all() > 0 ) return;

		$this->vote_avg = ($vote + $this->vote_avg * $this->vote_count) / ($this->vote_count + 1);
		$this->vote_count++;
		$this->save();

		$cr = ORM::factory('comment_rating');
		$cr->poi_id = $this->id;
		$cr->user_id = $user_id;
		$cr->comment_id = $comment_id;
		$cr->mark = $vote;
		$cr->save();
	}

	public function getKzFreeAddress()
	{
		$src = $this->address;
		$src = preg_replace('/.*?,.*?,\s*/', '', $src);
		return $src;
	}
	
	public function hasEditPermission()
	{
		return (NakarteAuth::isAdmin()) || ($this->user_id && ($this->user_id == NakarteAuth::getUserId())); 		
	}
	
	public function getViewUrl()
	{
		return '/poi/' . $this->id;
	}
	
	public function getHref()
	{
		return "<a href='" . $this->getViewUrl() . "'>" . trim($this->caption) . "</a>";
	}
	
	public function vote_css()
	{
		return (int)($this->vote_avg * 20);
	}
	
	public function get_latest_places_rubric($per_page=null,$offset=0)
	{
		$city_id=NakarteBase::get_current_city_id();
		$rubric_id = $this->rubrics[0]->id;
		$rubruc_id=(is_null($rubric_id))?$this->rubrics[0]->rubric->id:$rubric_id;		
		return ORM::factory('poi_rubric')->with('poi')->where(array('poi.city_id' => $city_id, 'rubric_id'=>$rubric_id))->orderby(array('poi.ctime' => 'DESC'))->find_all($per_page,$offset);
	} 
	
	public function count_new_places_rubric()
	{
		$conf=Kohana::config('places');				
	//	$user=Auth::instance()->get_user();
		$city_id=NakarteBase::get_current_city_id();
	//	if (empty($user)) {return '';}
		$rubric_id = $this->rubrics[0]->id;
		$rubruc_id=(is_null($rubric_id))?$this->rubrics[0]->rubric->id:$rubric_id;		
		$last_login=date( 'Y-m-d H:i:s', (mktime()- (60*60*24*$conf['new_places'])));
		//$last_login=$user->last_login;
		//$last_login=date( 'Y-m-d H:i:s', $last_login);
		
		$new_places= ORM::factory('poi_rubric')->with('poi')->where(array('poi.city_id' => $city_id,'poi.ctime >'=>$last_login,'rubric_id'=>$rubric_id))->find_all();
		return count ($new_places);
	}
	
	public function get_popular_places_rubric($per_page=null,$offset=0)
	{
		$city_id=NakarteBase::get_current_city_id();
		$rubric_id = $this->rubrics[0]->id;
		$rubruc_id=(is_null($rubric_id))?$this->rubrics[0]->rubric->id:$rubric_id;		
		return ORM::factory('poi_rubric')->with('poi')->where(array('rubric_id'=>$rubric_id, 'poi.city_id' => $city_id, 'poi.vote_avg>' => '0'))->orderby(array('poi.vote_avg' => 'DESC'))->find_all($per_page,$offset);
	} 
	
	public function get_related_places_rubric($per_page=null,$offset=0)
	{
		$city_id=$this->city_id;
		$rubric_id = $this->rubrics[0]->id;		
		$rubruc_id=(is_null($rubric_id))?$this->rubrics[0]->rubric->id:$rubric_id;		
		return ORM::factory('poi_rubric')->with('poi')->where(array('rubric_id'=>$rubric_id, 'poi.city_id' => $city_id))->orderby(array('poi.vote_avg' => 'DESC'))->find_all($per_page,$offset);
	}
	
	public function get_visitors($per_page=null,$offset=0)
	{
		return ORM::factory('poi_been')->with('user')->where(array('poi_id'=>$this->id))->orderby(array('id' => 'DESC'))->find_all($per_page,$offset);
	} 

}
