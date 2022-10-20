<?php
include ("errors.php");
include ("globals.php");
include ("functions.php");
include ("forms/timesheet_input_form.php");
include ("view.php");
include ("inputs.php");
include ("objects/Database.php");
include ("objects/Timesheet.php");

$db=new Database();
$timesheet=new Timesheet(1);

$date=get_date();
manage_post($_POST);

$timesheet->remove();
$start_date=TEST_DATE." 00:00:00";
$end_date=TEST_DATE." 02:00:00";
$timesheets=Timesheet::get_timesheets($date);

$total_width=700;
$total_height=100;

timesheet_basic_view($date, $total_width, $total_height);
timesheet_basic_input_form();
date_selector_input();
