<?php defined('SYSPATH') OR die('No direct access allowed.');
/**

 */
class Pages_Controller extends NakarteBase
{
	public function  __construct()
	{
		parent::__construct();
		$this->map_block = null;
		$this->rubrics_block = null;
	}

	public function index()
	{
		
	}

	public function about()
	{
		$this->main_block = new View('pages/about_content');
	}

	public function help()
	{
		$this->main_block = new View('pages/help_content');
	}

	public function tour()
	{
	}

}
?>