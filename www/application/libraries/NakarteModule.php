<?php
	class NakarteModule
	{
		private $model_name;
		private $parent_model_name;
		private $object_id;
		private $view_name;
		private $ref_field_name;
		private $object;
		private $params;

		public function __construct($_view_name, $_model_name, $_parent_model_name, $_object_id, $_params = array())
		{
			$this->params = $_params;
			$this->view_name = $_view_name;
			$this->model_name = $_parent_model_name . '_' . $_model_name;
			$this->object_id = $_object_id;	
			$this->parent_model_name = $_parent_model_name;
			$this->ref_field_name = $this->parent_model_name . '_id';
			
			if($_POST)
			{
  	  	  		if($this->parse_post())
  	  	  		{
					url::redirect(url::current());				
				}
			}
		}

		public function get()
		{
			return ORM::factory($this->model_name)->where(array($this->ref_field_name => $this->object_id))->find_all();
		}

		public function get_parent()
		{
			if(!$this->object)
			{
				$this->object = ORM::factory($this->parent_model_name, $this->object_id);
			}

			return $this->object;
		}

		public function get_view($params = array())
		{
			$params = array_merge(
			$this->params,
			$params,
			array(
			'items' => $this->get(),
			'object' => $this->get_parent(),
			)
			);
			return new View($this->view_name, $params);
		}

		public function add_postfix($_postfix)
		{
			return $this->model_name . '_' . $_postfix;
		}
		
		protected function get_ref_field()
		{
			return $this->ref_field_name;
		}

		protected function get_model_name()
		{
			return $this->model_name;
		}

		protected function parse_post()
		{
		}

		public function __toString()
		{
			return $this->get_view()->__toString();
		}

	}
?>
