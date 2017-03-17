<?php
  require_once('../../connection.php');
  $dateTo = $_GET['dateTo'];
  $dateFrom = $_GET['dateFrom'];
  $sql = "SELECT
              property.pcode AS property_code,
              property.sno AS serial_number,
              property.description AS property_description,
              major_category.description AS major_description,
              minor_category.description AS minor_description,
              a.location as old_location,
              b.location as new_location,
              CONCAT(account_table.emp_id,' - ', last_name,', ', first_name) AS accountability_of
            FROM
              property
              INNER JOIN transfer_request_history ON property.id = transfer_request_history.id
              INNER JOIN account_table ON transfer_request_history.transfer_to = account_table.emp_id
              INNER JOIN minor_category ON property.minor_category = minor_category.id
              INNER JOIN major_category ON property.major_category = major_category.id
              INNER JOIN location as a ON transfer_request_history.old_loc_id = a.id
              INNER JOIN location as b ON transfer_request_history.new_loc_id = b.id
              INNER JOIN condition_info ON transfer_request_history.condition_id = condition_info.id
            WHERE transfer_request_history.date_approved between '$dateFrom 00:00:00' and '$dateTo 23:59:59'";
            // -- property.brand,
            // -- property.model,
            // -- property.uom,
            // -- property.cost,
            // -- property.or_number AS po_number,
            // -- property.date_acquired,
            // -- location.location as current_location,
            // -- condition_info.condition_info as current_condition,
            // -- property_accountability.qty as quantity,
            // -- property_accountability.remarks
  $rec = mysqli_query($conn, $sql);

  $num_fields = mysqli_num_fields($rec);
  $header = "";
  $data = "";

  for($i = 0; $i < $num_fields; $i++ ) {
    $header .= mysqli_fetch_field_direct($rec,$i)->name . "\t";
  }

  while($row = mysqli_fetch_row($rec)) {
    $line = '';

    foreach($row as $value) {
      if((!isset($value)) || ($value == "")) {
        $value = "\t";
      } else {
        $value = str_replace( '"' , '""' , $value);
        $value = '"' . $value . '"' . "\t";
      }

      $line .= $value;
    }

    $data .= trim( $line ) . "\n";
  }

  $data = str_replace("\r" , "" , $data);

  if ($data == "") {
    $data = "\n No Record Found!\n";
  }

  header("Content-type: application/xls");
  header("Content-Disposition: attachment; filename=transfer_history_from_".$dateFrom."_to_".$dateTo.".xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  print "$header\n$data";
?>
