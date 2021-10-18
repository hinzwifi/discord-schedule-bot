<?php
class Records {	
   
	private $recordsTable = 'sched';
	public $id;
    public $subject;
    public $subjectT;
    public $meetLink;
	public $meetSched;
	public $meetDay;
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function listRecords(){
		
		$sqlQuery = "SELECT * FROM ".$this->recordsTable." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'where(id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR subject LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR subjectT LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR meetLink LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR meetSched LIKE "%'.$_POST["search"]["value"].'%") ';
			$sqlQuery .= ' OR meetDay LIKE "%'.$_POST["search"]["value"].'%") ';
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
			$rows[] = $record['subject'];
			$rows[] = $record['subjectT'];		
			$rows[] = $record['meetLink'];	
			$rows[] = $record['meetSched'];
			$rows[] = $record['meetDay'];
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
			SET subject= ?, subjectT = ?, meetLink = ?, meetSched = ?, meetDay = ?
			WHERE id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->subject = htmlspecialchars(strip_tags($this->subject));
			$this->subjectT = htmlspecialchars(strip_tags($this->subjectT));
			$this->meetLink = htmlspecialchars(strip_tags($this->meetLink));
			$this->meetSched = htmlspecialchars(strip_tags($this->meetSched));
			$this->meetDay = htmlspecialchars(strip_tags($this->meetDay));
			
			$stmt->bind_param("sssssi", $this->subject, $this->subjectT, $this->meetLink, $this->meetSched, $this->meetDay, $this->id);
			
			if($stmt->execute()){
				return true;
			}
			
		}	
	}
	public function addRecord(){
		
		if($this->subject) {

			$stmt = $this->conn->prepare("
			INSERT INTO `sched`(`subject`, `subjectT`, `meetLink`, `meetSched`, `meetDay`)
			VALUES (?,?,?,?,?)");
		
			
			$this->subject = htmlspecialchars(strip_tags($this->subject));
			$this->subjectT = htmlspecialchars(strip_tags($this->subjectT));
			$this->meetLink = htmlspecialchars(strip_tags($this->meetLink));
			$this->meetSched = htmlspecialchars(strip_tags($this->meetSched));
			$this->meetDay = htmlspecialchars(strip_tags($this->meetDay));
			
			$stmt->bind_param("sssss", $this->subject, $this->subjectT, $this->meetLink, $this->meetSched, $this->meetDay);
			
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