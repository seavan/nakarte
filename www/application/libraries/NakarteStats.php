<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/


class NakarteStats
{
	public function  __construct($city_id)
	{
		$city_id = addslashed($city_id);
		$db = Database::instance();

	}

	public $PoiCount = 0;
}

?>
