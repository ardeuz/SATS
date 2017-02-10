<?php
  require_once('../../connection.php');

  $sql = "SELECT account_table.emp_id, last_name, first_name, pcode, description, sno, brand, model, uom, cost, date_acquired, or_number FROM property inner join property_accountability on property.id = property_accountability.property_id inner join account_table on property_accountability.emp_id = account_table.emp_id where ";
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
