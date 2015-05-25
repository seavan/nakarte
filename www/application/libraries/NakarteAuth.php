<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

class NakarteAuth
{

	public static function isLoggedIn()
	{
		return Auth::instance()->logged_in();
	}

	public static function isAdmin()
	{
		$auth = Auth::instance();
		if($auth->logged_in())
		{
			if($auth->get_user()->status == 'admin')
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public static function getUser()
	{
		return Auth::instance()->get_user();
	}
	
	public static function getUserId()
	{
		if (Auth::instance()->get_user()) 
		{
			return Auth::instance()->get_user()->id; 
		} 
		else 
		{
			return false;
		}
	}	
	
	private static function hasPermission($_object, $_method)
	{
		$method = 'has' . $_method . 'Permission';
		return isset($_object) && ($_object != null) && (method_exists($_object, $method)) && ($_object->$method(self::getUser()));
	}
	
	public static function hasViewPermission($_object)
	{
		return self::hasPermission($_object, 'View');
	}
	
	public static function hasEditPermission($_object)
	{
		return self::hasPermission($_object, 'Edit');
	}

	public static function hasOwnerPermission($_object)
	{
		return self::hasPermission($_object, 'Owner');
	}	
}

?>
