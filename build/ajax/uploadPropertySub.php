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
        $parent_property_code = $data[0]; //parent property code, first column
        $sub_property_code = $data[1]; //sub propert code, second column

        //===========get the propety id from the property code uploaded=============//
        $parent_id = $db->get("property", "id", ["pcode" => $parent_property_code]);
        $sub_id = $db->get("property", "id", ["pcode" => $parent_property_code]);

        //if sub property and parent property exists (or same), do nothing. Otherwise, if the parent of the sub property is different, put it in the history, and upload the new relationship
			}
		}

    // header("location:../../admin_accountabilities.php");
  }
?>
