<?php
  require "../db2.php";

  $sql = "SELECT name, SUM(qty) AS qty_released, SUM(qty * price) AS total_price
  FROM proware_claim AS a LEFT JOIN proware AS b ON a.proware_id=b.id GROUP BY name";
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
  header("Content-Disposition: attachment; filename=per_item_report.xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  print "$header\n$data";
?>
