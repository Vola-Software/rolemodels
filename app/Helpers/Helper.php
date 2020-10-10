<?php
namespace App\Helpers;

class Helper
{
	public static function is_checked($key1, $key2)
	{
		return static::is_selected_helper($key1, $key2, 'checked');
	}

	public static function is_selected($key1, $key2)
	{
		return static::is_selected_helper($key1, $key2, 'selected');
	}

	public static function is_selected_multiple($key1, $arr)
	{
		return static::is_selected_multiple_helper($key1, $arr, 'selected');
	}

	private static function is_selected_helper($key1, $key2, $verb)
	{
		$result = '';
		if($key1 == $key2)
		{
			$result = $verb;
		}

		return $result;
	}

	private static function is_selected_multiple_helper($key1, $arr, $verb)
	{
		$result = '';
		if(!empty($arr) && in_array($key1, $arr))
		{
			$result = $verb;
		}

		return $result;
	}
}