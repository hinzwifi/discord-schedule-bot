<?php
class Records {	
   
	private $recordsTable = 'celebrants';
	public $id;
    public $username;
    public $surname;
    public $usernumber;
	public $userbday;
	public $useryear;
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function listRecords(){
		
		$sqlQuery = "SELECT * FROM ".$this->recordsTable." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'where(id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR username LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR surname LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR userbday LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR usernumber LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY id DESC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->recordsTable);
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();		
		while ($record = $result->fetch_assoc()) { 				
			$rows = array();			
			$rows[] = $record['id'];
			$rows[] = $record['username'];
			$rows[] = $record['surname'];		
			$rows[] = $record['usernumber'];	
			$rows[] = $record['userbday'];
			$rows[] = $record['useryear'];					
			$rows[] = '<button type="button" name="update" id="'.$record["id"].'" class="btn btn-warning btn-xs update">Update</button>';
			$rows[] = '<button type="button" name="delete" id="'.$record["id"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
			$records[] = $rows;
		}

		
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	
	public function getRecord(){
		if($this->id) {
			$sqlQuery = "
				SELECT * FROM ".$this->recordsTable." 
				WHERE id = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$record = $result->fetch_assoc();
			echo json_encode($record);
		}
	}
	public function updateRecord(){
		
		if($this->id) {			
			
			$stmt = $this->conn->prepare("
			UPDATE ".$this->recordsTable." 
			SET username= ?, surname = ?, usernumber = ?, userbday = ?, useryear = ?
			WHERE id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->username = htmlspecialchars(strip_tags($this->username));
			$this->surname = htmlspecialchars(strip_tags($this->surname));
			$this->usernumber = htmlspecialchars(strip_tags($this->usernumber));
			$this->useryear = htmlspecialchars(strip_tags($this->useryear));
			$this->userbday = htmlspecialchars(strip_tags($this->userbday));
			
			
			$stmt->bind_param("sssssi", $this->username, $this->surname, $this->usernumber, $this->userbday, $this->useryear, $this->id);
			
			if($stmt->execute()){
				return true;
			}
			
		}	
	}
	public function addRecord(){
		
		if($this->username) {

			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->recordsTable."(`username`, `surname`, `usernumber`, `userbday`, `useryear`)
			VALUES(?,?,?,?,?)");
		
			$this->username = htmlspecialchars(strip_tags($this->username));
			$this->surname = htmlspecialchars(strip_tags($this->surname));
			$this->usernumber = htmlspecialchars(strip_tags($this->usernumber));
			$this->userbday = htmlspecialchars(strip_tags($this->userbday));
			$this->useryear = htmlspecialchars(strip_tags($this->useryear));
			
			
			$stmt->bind_param("sssss", $this->username, $this->surname, $this->usernumber, $this->userbday, $this->useryear);
			
			if($stmt->execute()){
				return true;
			}		
		}
	}
	public function deleteRecord(){
		if($this->id) {			

			$stmt = $this->conn->prepare("
				DELETE FROM ".$this->recordsTable." 
				WHERE id = ?");

			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bind_param("i", $this->id);

			if($stmt->execute()){
				return true;
			}
		}
	}
}
?>