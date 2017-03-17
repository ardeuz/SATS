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
        // get all datas in the CSV
        $or_number = $data[0];
        $date_acquired = $data[1];
        $pcode = $data[2];
        $description = $data[3];
        $brand = $data[4];
        $model = $data[5];
        $serial_no = $data[6];
        $major_category = $data[7];
        $minor_category = $data[8];
        $qty = $data[9];
        $uom = $data[10];
        $cost = $data[11];
        $location = $data[12];
        $condition = $data[13];
        $remarks = $data[14];
        $emp_id = $data[15];

        //select first the id's of account location condition minor and major category
        $location = $db->get("location", "id", ["location" => $location]);
        $condition = $db->get("condition_info", "id", ["condition_info" => $condition]);
        $minor_category = $db->get("minor_category", "id", ["description" => $minor_category]);
        $major_category = $db->get("major_category", "id", ["description" => $major_category]);
        //insert when its finally searched
				$propertyId = $db->insert("property", [
					"pcode" => $pcode,
					"sno" => $serial_no,
					"description" => $description,
	        "brand" => $brand,
					"model" => $model,
					"minor_category" => $minor_category,
          "uom" => $uom,
          "cost" => $cost,
          "major_category" => $major_category,
          "date_acquired" => $date_acquired,
          "or_number" => $or_number
				]);

        $db->insert("property_accountability", [
          "emp_id" => $emp_id,
          "property_id" => $propertyId,
          "qty" => $qty,
          "location_id" => $location,
          "condition_id" => $condition,
          "remarks" => $remarks
        ]);
			}
		}

    header("location:../../admin_accountabilities.php");
  }
?>
