<?php

class Json
{
	public static function toJson($iterator)
	{
		$members = array();
		foreach ($iterator as $member)
		{
			$members[] = $member->as_array();
		}
		return json_encode(array('result' => $members));
	}

	public static function objectToJson($iterator)
	{
		$members = array();
		foreach ($iterator as $member)
		{
			$members[] = get_object_vars($member);
		}
		return json_encode(array('result' => $members));
	}

	public static function arrayToJson($iterator)
	{
		$members = array();
		foreach ($iterator as $member)
		{
			$members[] = $iterator;
		}
		return json_encode(array('result' => $members));

	}
}

?>