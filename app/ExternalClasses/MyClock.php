<?php
namespace App\ExternalClasses;

class MyClock{

	public function get_current_time_ISO_8601_GMT_7(){
		return gmdate("Y-m-d\TH:i:s\Z", time() + 7*60*60);
	}

	public function get_today_date_GMT_7($dateFormat){
		return gmdate($dateFormat, time() + 7*60*60);
	}

	public function get_nextday_date_GMT_7($dateFormat){
		return gmdate($dateFormat, time() + 7*60*60 + 24*60*60);
	}

	public function get_current_time_GMT_7($timeFormat){
		return gmdate($timeFormat, time() + 7*60*60);
	}
	public function get_unix_time_UTC_from_GMT_7($time_string_hh_mm, $date_string_yyyy_mm_dd){ // ex 22:00, 2014-01-01 GMT + 7
		$time_string_hh_mm = $time_string_hh_mm.":00"; // H:i:s
		$date_string = $date_string_yyyy_mm_dd." ".$time_string_hh_mm; // GMT+7
		return (strtotime($date_string) - 7*60*60);
	}
	public function item_type($available_time, $start_date, $end_date){
		
		$currentDate = get_today_date_GMT_7("Y-m-d");
		if ($currentDate >= $end_date) return 2;
		elseif ($currentDate == $start_date){
			list($gmt7_start_time, $gmt7_end_time) = explode("-", $available_time);
			$currentTime = get_current_time_GMT_7("H:i");
			if ($currentTime < $gmt7_start_time) return 1;
			if ($currentTime >= $gmt7_start_time && $currentTime <= $gmt7_end_time) return 0;
			return -1;
		}
	}

	public function get_current_utc_time(){
		$current_time_hh_mm_GMT_7 = $this->get_current_time_GMT_7("H:i");
		$today = $this->get_today_date_GMT_7("Y-m-d");
		$utc_current_time = $this->get_unix_time_UTC_from_GMT_7($current_time_hh_mm_GMT_7, $today);
		return $utc_current_time;
	}
}
?>