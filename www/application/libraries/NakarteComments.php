<?php
	class NakarteComments extends NakarteModule
	{
		public function __construct($_view_name, $_parent_model_name, $_object_id)
		{
			parent::__construct($_view_name, 'comment', $_parent_model_name, $_object_id);
		}

		public function get_vote_table()
		{
			return $this->add_postfix('rating');
		}
		
		protected function add_vote($vote, $comment_id = NULL)
		{
			$rfname = $this->get_ref_field();
			$object = $this->get_parent();
			
			$user_id = NakarteAuth::getUserId();
			
			$already_voted = ORM::factory($this->get_vote_table())->where( array('user_id' => $user_id, $this->get_ref_field() => $object->id));
			
			// if user already voted
			if( $already_voted->count_all() > 0 ) return;

			$object->vote_avg = ($vote + $object->vote_avg * $object->vote_count) / ($object->vote_count + 1);
			$object->vote_count++;
			$object->save();

			$cr = ORM::factory($this->get_vote_table());
			$cr->$rfname = $object->id;
			$cr->user_id = $user_id;
			$cr->mark = $vote;
			$cr->save();			
		}

		public function parse_post()
		{
			if(!NakarteAuth::isLoggedIn())
			{
				return;
			}
			
			$rfname = $this->get_ref_field();

			$add_comment = new Validation($_POST);

			$add_comment->pre_filter('trim', TRUE);
			$add_comment->add_rules('add_comment','required');
			$add_comment->add_rules('text','required');
			$add_comment->add_rules('vote','numeric');

			if(NakarteAuth::isLoggedIn())
			{
				if($add_comment->validate())
				{
					$comment = ORM::factory($this->get_model_name());
					$comment->text = $add_comment->text;
					$comment->user_id = NakarteAuth::getUser()->id;
					$comment->$rfname = $this->get_parent()->id;
					$comment->save();
					if($add_comment->vote)
					{
						$this->add_vote($add_comment->vote);
					}
					return true;
				}
			}
			
			return false;
		}
	}
?>
