<?php
  require_once('../../connection.php');

  $sql = "SELECT emp_id , first_name , middle_name , last_name, department from account_table";
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
  header("Content-Disposition: attachment; filename=account_list.xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  print "$header\n$data";
?>
