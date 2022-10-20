<?php
class Database {
	private $conn;
	private $servername;
	private $username;
	private $password;
	private $db_name;
	function __construct($servername="localhost", $username="root", $password="", $db_name="prototype_erp") {
		$this->conn = new mysqli($servername, $username, $password, $db_name);
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}

		$this->servername=$servername;
		$this->username=$username;
		$this->password=$password;
		$this->db_name=$db_name;
	}

	public function select_cell_query($table, $column, $id, $order_by=""){
		if($id)
			$sql="SELECT $column FROM $table WHERE id = $id";
		else
			$sql="SELECT $column FROM $table";
		$sql.=$order_by;
		$result=$this->conn->query($sql);
		$value=NULL;
		if($result && mysqli_num_rows($result)>0 && !$id){
			$value=array();
			while($assoc=$result->fetch_assoc()){
				$value[]=$assoc[$column];
			}
		}else if($result && mysqli_num_rows($result)>0){
			while($assoc=$result->fetch_assoc()){
				$value=$assoc[$column];
			}
		}
		return $value;
	}

	public function update_query($table, $column, $value, $id){
		$sql="UPDATE $table SET $column='$value' WHERE id=$id";
		$this->conn->query($sql);
	}

	public function delete_query($table,$where_data=[]){
		$sql_where="";
		if($total=count($where_data)>0){
			$sql_where=" WHERE ";
			$i=0;
			foreach($where_data as $key=>$data){
				if($key=="date"){
					$sql_where.=" start_date >= '$data 00:00:00' AND end_date <= '$data 23:59:59' ";
				}else{
					$sql_where.=" $key = '$data' ";
				}
				if($total>++$i){
					$sql_where.=" AND ";
				}
			}
		}
		$sql="DELETE FROM $table $sql_where";
		$this->conn->query($sql);
	}

	public function insert_query($sql){
		$this->conn->query($sql);
	}
	public function get_insert_id(){
		return $this->conn->insert_id;
	}
	public function query($sql){
		return $this->conn->query($sql);

	}

	function __destruct() {
		mysqli_close($this->conn);
	}
}
