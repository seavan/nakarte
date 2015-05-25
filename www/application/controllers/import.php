<?php defined('SYSPATH') OR die('No direct access allowed.');

class Import_Controller extends NakarteBase
{
	public function  __construct()
	{
		parent::__construct();
		$this->map_block = null;
		$this->rubrics_block = null;
	}

	public function index()
	{
		$this->main_block = new View('import/import_view_content');
	}

	public function bat()
	{
		$import = ORM::factory('import1')->find_all();
		$res = '';
		foreach($import as $i)
		{
			$res .= "read2.pl \"$i->link\"<br/>";
		}
		$this->main_block = $res;
	}
}