<?php
  require_once('../../connection.php');

  $sql = "SELECT
            CONCAT(account_table.emp_id,' - ', last_name,', ', first_name) AS accountability_of,
            property.pcode AS property_code,
            property.sno AS serial_number,
            property.description AS property_description,
            b.description AS major_description,
            a.description AS minor_description,
            property.brand,
            property.model,
            property.uom,
            property.cost,
            property.or_number AS po_number,
            property.date_acquired,
            location.location as current_location,
            condition_info.condition_info as current_condition,
            property_accountability.qty as quantity,
            property_accountability.remarks
            FROM
            property
            INNER JOIN property_accountability ON property.id = property_accountability.property_id
            INNER JOIN account_table ON property_accountability.emp_id = account_table.emp_id
            INNER JOIN minor_category as a ON property.minor_category = a.id
            INNER JOIN major_category as b ON property.major_category = b.id
            INNER JOIN location ON property_accountability.location_id = location.id
            INNER JOIN condition_info ON property_accountability.condition_id = condition_info.id";
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
  header("Content-Disposition: attachment; filename=property_list.xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  print "$header\n$data";
?>
