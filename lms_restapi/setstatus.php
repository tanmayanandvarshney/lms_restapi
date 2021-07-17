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
	if (!empty($data->uid) && !empty($data->tid) && !empty($data->status)) {
		
		$sql = "SELECT role FROM users WHERE uid = '" . $data->uid . "'";
		$result = mysqli_query($db, $sql);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			if ($row["role"] == "developer") {
				
				// check if task is already assigned to the user
				$sql_chtask = "SELECT srno FROM assignedtasks WHERE uid = '" . $data->uid . "' && tid = '" . $data->tid . "'";
				$result_chtask = mysqli_query($db, $sql_chtask);
				if (mysqli_num_rows($result_chtask) > 0) {
					
					$sql_upst = "UPDATE assignedtasks SET status = '" . $data->status . "' WHERE uid = '" .$data->uid. "' && tid = '" . $data->tid . "'";
					if (mysqli_query($db, $sql_upst)) {
						echo json_encode(array("message" => "Status is updated...!!"));
					} else {
						echo json_encode(array("message" => "Error updating record: " . mysqli_error($db)));
					}
					
				} else {
					echo json_encode(array("message" => "You don't have any right to set the status of the task as this task is not assigned to you."));
				}

			} else {
				echo json_encode(array("message" => "Dear Admin, you don't have any right to set the status of the task."));
			}
		}
	
		
	} else {
    echo json_encode(array("message" => "Unable to process data."));
	}
?>	
