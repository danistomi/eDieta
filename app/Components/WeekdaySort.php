<?php

namespace App\Components;


class WeekdaySort {
	private static $sortedDays = [ 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' ];

	public static function getSortedDays() {
		return self::$sortedDays;
	}
}