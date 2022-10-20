<?php
class Timesheet {
	private $start_date;
	private $end_date;
	private $id;
	static private $table="timesheet";

	function __construct($id){
		global $db;
		$this->id=$id;
		$table="timesheet";
		$column="start_date";
		$this->start_date=$db->select_cell_query($table, $column, $id);
		$column="end_date";
		$this->end_date=$db->select_cell_query($table, $column, $id);
	}

	public function remove(){
		global $db;
		$db->delete_query(Timesheet::$table,["id"=>$this->id]);
	}
	public static function create($start_date, $end_date){
		global $db;
		$sql="INSERT INTO ".Timesheet::$table." (start_date, end_date) VALUES ('$start_date', '$end_date')";
		$db->insert_query($sql);
		return new Timesheet($db->get_insert_id());
	}

	public function get_start_date(){
		return $this->start_date;
	}
	public function get_end_date(){
		return $this->end_date;
	}
	public function set_start_date($date){
		global $db;
		$table="timesheet";
		$column="start_date";
		$value=$date;
		$db->update_query($table, $column, $value, $this->id);
	}
	public function set_end_date($date){
		global $db;
		$table="timesheet";
		$column="end_date";
		$value=$date;
		$db->update_query($table, $column, $value, $this->id);
	}

	public static function get_timesheets($day){
		global $db;
		$sql="SELECT * FROM ".Timesheet::$table." WHERE start_date>='$day 00:00:00' AND end_date<='$day 23:59:59' ORDER BY start_date ASC";
		$ids=[];
		$result=$db->query($sql);
		if($result&&mysqli_num_rows($result)){
			while($assoc=$result->fetch_assoc()){
				$ids[]=$assoc['id'];
			}
		}
		$timesheets=[];
		if(is_array($ids))foreach($ids as $id){
			$timesheets[]=new Timesheet($id);
		}
		return $timesheets;
	}
	public function get_start_time_of_day(){
		$start_date=$this->get_start_date();
		$hour=(float)date("H", strtotime($start_date));
		$minute=(float)date("i", strtotime($start_date));
		$time=(((float)$minute/(float)60)/24) + ((float)$hour/(float)24);
		return $time;
	}
	public function get_end_time_of_day(){
		$end_date=$this->get_end_date();
		$hour=(float)date("H", strtotime($end_date));
		$minute=(float)date("i", strtotime($end_date));
		$time=(((float)$minute/(float)60)/24) + ((float)$hour/(float)24);
		return $time;
	}
	public static function remove_all_timesheets($date=""){
		global $db;
		$table="timesheet";
		$where=[];
		if($date){
			$where['date']=$date;
		}
		$db->delete_query($table,$where);
	}
}
