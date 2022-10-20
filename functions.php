<?php
function manage_post($post) {
	global $date;
	if(isset($_POST['clear_all_timesheets'])){
		Timesheet::remove_all_timesheets($date);
	}
	if(isset($_POST['create_timesheet'])){
		$start_minute = sprintf("%02d", $_POST['start_minute']);
		$start_hour = sprintf("%02d", $_POST['start_hour']);
		$end_minute = sprintf("%02d", $_POST['end_minute']);
		$end_hour = sprintf("%02d", $_POST['end_hour']);
		$start_date=date("Y-m-d", strtotime($date))." $start_hour:$start_minute:00";
		$end_date=date("Y-m-d", strtotime($date))." $end_hour:$end_minute:00";
		Timesheet::create($start_date, $end_date);
	}
}
function get_date(){
	global $_GET, $_POST;
	$date=date("Y-m-d", strtotime("today"));
	if(isset($_GET['date'])){
		$date=$_GET['date'];
	}
	if(isset($_POST['date'])){
		$date=$_POST['date'];
	}
	return $date;
}
