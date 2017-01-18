<?php
  require "../db2.php";

  $sql = "SELECT is_no, reserve_code, a.stud_no, CONCAT(c.fname, ' ', c.lname) AS stud_name, course, name, price, qty, (price * qty) AS total_price,
  DATE_FORMAT(date,'%m-%d-%Y') AS date_released, or_no, DATE_FORMAT(or_date,'%m-%d-%Y') AS or_date FROM proware_claim_history AS a
  LEFT JOIN proware ON proware_id=id LEFT JOIN student_info AS c ON a.stud_no=c.stud_no";
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
  header("Content-Disposition: attachment; filename=history_reservation.xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  print "$header\n$data";
?>
