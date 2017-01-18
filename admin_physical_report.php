<?php
  ob_start("ob_gzhandler");
  session_start();
  require_once('connection.php');
  include('config.php');
  include('validatePage.php');

  $emp_id = $_POST['emp_id']; //employee to compare his/her accountability

  //upload the physical count CSV report
  if (is_uploaded_file($_FILES['physical_count_csv']['tmp_name'])) {
    $db->delete("temp_property_accountability", []);

    //get the csv file
    $file = $_FILES['physical_count_csv']['tmp_name'];
    $handle = fopen($file,"r");

    //loop through the csv file and insert into database
		while ($data = fgetcsv($handle,1000,",","'")) {
			if ($data[0]) {
					$db->insert("temp_property_accountability", [
						"pcode" => $data[0]
					]);
			}
		}
  } else {
    header ("Location: admin_accountability_property.php?emp_id=$emp_id");
    die();
  }

  //get his/her accountability
  $propertyAccountabilityDatas = $db->select("property", [
    "[>]property_accountability" => ["id" => "property_id"]
  ],
    "property.pcode"
  , [
    "property_accountability.emp_id" => $emp_id
  ]);

  //get the uploaded physical count
  $physicalCountDatas = $db->select("temp_property_accountability", "pcode");

  //compare now
  foreach ($propertyAccountabilityDatas as $key => $propertyAccountabilityData) {
    foreach ($physicalCountDatas as $key2 => $physicalCountData) { //loop to his properties
      if ($propertyAccountabilityData == $physicalCountData) { //if property found

        //delete them
        array_splice($propertyAccountabilityDatas, $key, 1); //remove array
        array_splice($physicalCountDatas, $key2, 1); //remove array

      }
    }
  }
  ?>
  <link href="build/css/metro.css" rel="stylesheet">

  <div class="flex-grid container">
    <div class="row">
      <h1 class='cell colspan12 padding20'>Physical Count Report</h1>
    </div>
    <div class="row">
      <div class='cell colspan12 row'>
  <?php
  ?>

      <div class="cell colspan6 padding20">
        <h2>Items not found</h2>
        <table class="table">
          <thead>
            <th>Property Code</th>
            <th>Description</th>
          </thead>
          <tbody>

  <?php
  //items not found || mga hndi naphysical count
  foreach ($propertyAccountabilityDatas as $propertyAccountabilityData) {
    $propertyDesc = $db->get("property", "description", ["pcode" => $propertyAccountabilityData]);
        echo "
        <tr>
          <td>$propertyAccountabilityData</td>
          <td>$propertyDesc</td>
        </tr>";
  }
  ?>
          </tbody>
       </table>
      </div>
      <div class="cell colspan6 padding20">
        <h2>Items not on the employee's accountability</h2>
        <table class="table">
          <thead>
            <th>Property Code</th>
            <th>Description</th>
          </thead>
          <tbody>
  <?php

  //items that must not be at his accountabilities || hindi sa knya
  foreach ($physicalCountDatas as $physicalCountData) {
    $propertyDesc = $db->get("property", "description", ["pcode" => $physicalCountData]);
    echo "
    <tr>
    <td>$physicalCountData</td>
    <td>$propertyDesc</td>
    </tr>";
  }
  ?>
        </div>
      </div>
    </div>
  </div>
  <?php
?>
