<?php
  ini_set('max_execution_time', 300); //300 seconds = 5 minutes
  ini_set('memory_limit', '256M');
  set_time_limit(300);

  ob_start("ob_gzhandler");

  require_once("../../connection.php");
  if (is_uploaded_file($_FILES['physical']['tmp_name'])) {
    //get the csv file
    $file = $_FILES['physical']['tmp_name'];
    $handle = fopen($file,"r");

    //loop through the csv file and insert into database
		while ($data = fgetcsv($handle,1000)) {
			if ($data[0]) {
        //select first the id's of account location condition minor and major category
          $emp_id = $db->get("account_table","emp_id",["emp_id"=>$data[0]]);
          $location = $db->get("location","id",["location"=>$data[13]]);
          $condition = $db->get("condition_info","id",["condition_info"=>$data[14]]);
          $minor_category = $db->get("minor_category","id",["description"=>$data[12]]);
          $major_category = $db->get("major_category","id",["description"=>$data[11]]);
        //insert when its finally searched
					$propertyId = $db->insert("property", [
						"pcode" => $data[1],
						"sno" => $data[2],
						"description" => $data[3],
						"brand" => $data[4],
						"model" => $data[5],
						"minor_category" => $minor_category,
            "uom" => $data[6],
            "cost" => $data[7],
            "major_category" => $major_category,
            "date_acquired" => $data[8],
            "or_number" => $data[9]
					]);
          $db->insert("property_accountability", [
            "emp_id" => $emp_id,
            "property_id" => $propertyId,
            "qty" => $data[10],
            "location_id" => $location,
            "condition_id" => $condition
          ]);
			}
		}

    header("location:../../admin_accountabilities.php");
  }
?>
