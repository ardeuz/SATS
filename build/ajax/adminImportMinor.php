<?php
  ini_set('max_execution_time', 300); //300 seconds = 5 minutes
  ini_set('memory_limit', '256M');
  set_time_limit(30);

  ob_start("ob_gzhandler");

  require_once("../../connection.php");
  $categoryValue = $_POST['categoryValue'];
  if (is_uploaded_file($_FILES['import_minor']['tmp_name'])) {
    //get the csv file
    $file = $_FILES['import_minor']['tmp_name'];
    $handle = fopen($file,"r");

    //loop through the csv file and insert into database
		while ($data = fgetcsv($handle,1000,",","'")) {
			if ($data[0]) {

					$propertyId = $db->insert("minor_category", [
						"id" => $data[0],
						"major_id" => $categoryValue,
						"description" => $data[1],
					]);
			}
		}

    header ("Location: ../../mainteMinor.php");
  }
?>
