<?php
  require_once('../../connection.php');
  $emp_id = $_GET['emp_id'];
  $sql = "SELECT pcode, description, sno, brand, model, uom, cost, date_acquired, or_number FROM property left join property_accountability on property.id = property_accountability.property_id where emp_id='$emp_id'";
  $rec = mysqli_query($conn, $sql);
  $accountNames = $db->get("account_table",["last_name","first_name"],["emp_id"=>$emp_id]);

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
 $propertyAccountable = $accountNames['last_name'].'_'.$accountNames['first_name'];
  echo $propertyAccountable;
  header("Content-Disposition: attachment; filename=propertyListOf=$propertyAccountable.xls");
  header("Content-type: application/xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  print "$header\n$data";
?>
