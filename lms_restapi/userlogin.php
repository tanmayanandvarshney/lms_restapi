<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
  
	// include database file
	include_once './config/database.php';
	
	// instantiate database object
	$database = new Database();
	$db = $database->getConnection();
	
	// get posted data
	$data = json_decode(file_get_contents("php://input"));
	
	// check if posted data is empty
	if (!empty($data->uname) && !empty($data->pass)) {
		$sql = "SELECT uid, role FROM users WHERE username = '" . $data->uname . "' && password = '" . $data->pass . "'";
		$result = mysqli_query($db, $sql);
	
		if (mysqli_num_rows($result) > 0) {
			$user_data = array();
			
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				
				$task_list_res = array();
				
				// fetch data for admin role
				if ($row["role"] == "admin") {
					$sql_tl = "SELECT tid, task FROM taskslist";
					$result_tl = mysqli_query($db, $sql_tl);
					if (mysqli_num_rows($result_tl) > 0) {						
						
						while($row_tl = mysqli_fetch_assoc($result_tl)) {
						
							// check task is assigned to which user
							$sql_tlass = "SELECT uid, status FROM assignedtasks WHERE tid = '" . $row_tl["tid"] . "'";
							$result_tlass = mysqli_query($db, $sql_tlass);
							
							$task_list = array();
							
							if (mysqli_num_rows($result_tlass) > 0) {
								
								$row_tlass = mysqli_fetch_assoc($result_tlass);
								
								$task_list = array(
									"tid" => $row_tl["tid"],
									"task" => $row_tl["task"],
									"assigned_to" => $row_tlass["uid"],
									"status" => $row_tlass["status"],
								);
							} else {
								$task_list = array(
									"tid" => $row_tl["tid"],
									"task" => $row_tl["task"],
									"assigned_to" => '',
									"status" => '',
								);
							}
							
							array_push($task_list_res, $task_list);
							
						}					
						
					} else {
						echo json_encode(array("message" => "No tasks found...!!"));
					}
				} else if ($row["role"] == "developer") { // fetch data for developer role
					
					$asstask_list = array();
					
					$sql_devtl = "SELECT taskslist.tid, taskslist.task, assignedtasks.status FROM assignedtasks INNER JOIN taskslist ON assignedtasks.tid=taskslist.tid WHERE assignedtasks.uid='" . $row["uid"] . "'";
					$result_devtl = mysqli_query($db, $sql_devtl);
					if (mysqli_num_rows($result_devtl) > 0) {
						while($row_devtl = mysqli_fetch_assoc($result_devtl)) {
							$asstask_list = array(
								"tid" => $row_devtl["tid"],
								"task" => $row_devtl["task"],
								"status" => $row_devtl["status"],
							);
							
							array_push($task_list_res, $asstask_list);
						}
					} else {
						
						$task_list_res = array(
							"message" => 'No task is assigned to you...!!',
						);
						
					}
					
				}
				
				$user_data = array(
					"uid" => $row["uid"],
					"uname" => $data->uname,
					"role" => $row["role"],
					"taskslist" => $task_list_res,
        );       
        
				echo json_encode($user_data);       
			}
		} else {
			echo json_encode(array("message" => "Login credentials are wrong. Please check...!!"));
		}
	} else {
    echo json_encode(array("message" => "Unable to process data."));
	}
?>	
