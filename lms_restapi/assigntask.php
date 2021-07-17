<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
	// include database file
	include_once './config/database.php';
	
	// instantiate database object
	$database = new Database();
	$db = $database->getConnection();
	
	// get posted data
	$data = json_decode(file_get_contents("php://input"));
	
	// check if posted data is empty
	if (!empty($data->uid) && !empty($data->tid) && !empty($data->assigntouid)) {
		
		$sql = "SELECT role FROM users WHERE uid = '" . $data->uid . "'";
		$result = mysqli_query($db, $sql);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			if ($row["role"] == "admin") {
				
				// check if task is already assigned
				$sql_chtask = "SELECT username FROM users WHERE uid = (SELECT uid FROM assignedtasks WHERE tid = '" . $data->tid . "')";
				$result_chtask = mysqli_query($db, $sql_chtask);
				if (mysqli_num_rows($result_chtask) > 0) {
					$row_chtask = mysqli_fetch_assoc($result_chtask);
					echo json_encode(array("message" => "Task is already assigned to the user: " . $row_chtask["username"]));
				} else {				
					$sql_asstask = "INSERT INTO assignedtasks (uid, tid, status) VALUES ('" . $data->assigntouid . "', '" . $data->tid . "', 'Not Started')";
					if (mysqli_query($db, $sql_asstask)) {
						echo json_encode(array("message" => "Task assigned successfully...!!"));
					} else {						
						echo json_encode(array("message" => "Error inserting record: " . mysqli_error($db)));
					}
				}

			} else {
				echo json_encode(array("message" => "You don't have any right to assign the task."));
			}
		}
	
		
	} else {
    echo json_encode(array("message" => "Unable to process data."));
	}
?>
