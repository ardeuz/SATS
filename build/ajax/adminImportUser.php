<?php
  ini_set('max_execution_time', 300); //300 seconds = 5 minutes
  ini_set('memory_limit', '256M');
  set_time_limit(30);

  ob_start("ob_gzhandler");

  require_once("../../connection.php");

  if (is_uploaded_file($_FILES['import_user']['tmp_name'])) {
    //get the csv file
    $file = $_FILES['import_user']['tmp_name'];
    $handle = fopen($file,"r");

    //loop through the csv file and insert into database
		while ($data = fgetcsv($handle,1000,",","'")) {
			if ($data[0]) {
        if($db->has('account_table',['emp_id'=>$data[0]])){
          $propertyId = $db->update("account_table", [
            "first_name" => $data[1],
            "middle_name" => $data[2],
            "last_name" => $data[3],
            "department" => $data[4],
          ],["emp_id" => $data[0]]);
        } elseif($db->has("account_table",['emp_id'=>$data[0]])) {
					$propertyId = $db->insert("account_table", [
						"emp_id" => $data[0],
						"first_name" => $data[1],
						"middle_name" => $data[2],
						"last_name" => $data[3],
						"department" => $data[4],
						"password" => $data[0],
            "status" => 1
					]);
        }
			}

		}

    // header ("Location: ../../admin_account_manage.php");
  }
?>
