<?php

namespace App\Services;

class Util
{
	public static function getCurrentSchoolYear()
	{
		$currentYear = date('Y');
        $currentMonth = date('m');

        if($currentMonth >= 1 && $currentMonth <= 6) {
            return $currentYear - 1;
        } else {
            return $currentYear;
        }
	}

	public static function getCurrentSchoolTerm()
	{
		$currentYear = date('Y');
        $currentMonth = date('m');
        if($currentMonth >= 2 && $currentMonth <= 6) {
            return 2;    
        } else {
            return 1;
        }
	}
}