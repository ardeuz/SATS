<?php
  ini_set('max_execution_time', 300); //300 seconds = 5 minutes
  ini_set('memory_limit', '256M');
  set_time_limit(30);

  ob_start("ob_gzhandler");

  require_once("../../connection.php");
  if (is_uploaded_file($_FILES['physical']['tmp_name'])) {
    //get the csv file
    $file = $_FILES['physical']['tmp_name'];
    $handle = fopen($file,"r");

    //loop through the csv file and insert into database
		while ($data = fgetcsv($handle,1000,",","'")) {
			if ($data[0]) {

					$propertyId = $db->insert("property", [
						"pcode" => $data[0],
						"sno" => $data[1],
						"description" => $data[2],
						"brand" => $data[3],
						"model" => $data[4],
						"minor_category" => $_POST['minorcategory'],
            "uom" => $data[5],
            "cost" => $data[6],
            "date_acquired" => $data[7],
            "or_number" => $data[8]
					]);
          $db->insert("property_accountability", [
            "emp_id" => $_POST['accountability'],
            "property_id" => $propertyId,
            "qty" => $data[9],
            "location_id" => $_POST['location'],
            "condition_id" => $_POST['condition']
          ]);
			}
		}

    header("location:../../admin_accountabilities.php");
  }
?>
