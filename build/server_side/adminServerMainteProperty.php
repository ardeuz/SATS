<?php
  require( '../dataTables/ssp.php' );
  $table = "propertyMainteView";
  $pkey = "id";
  $column = array(

    //id sno pcode qty
    array('db' => '`u`.`brand`', 'dt' => 0,'field' => "brand"),
    array('db' => '`u`.`description`', 'dt' => 0,'field' => "description"),
    array('db' => '`u`.`model`', 'dt' => 0,'field' => "model"),
    array('db' => '`u`.`or_number`', 'dt' => 0,'field' => "or_number"),
    array('db' => '`u`.`uom`', 'dt' => 0,'field' => "uom"),
    array('db' => '`u`.`cost`', 'dt' => 0,'field' => "cost"),
    array('db' => '`u`.`minor_category`', 'dt' => 0,'field' => "minor_category"),
    array('db' => '`u`.`id`', 'dt' => 0,'field'=> 'id' ,'formatter' => function($id,$row)
      {
        $ids = $row['id'];
        $sno = $row['sno'];
        $pcode = $row['pcode'];
        $qty = $row['qty'];
        $brand = $row['brand'];
        $description = $row['description'];
        $model = $row['model'];
        $orNo = $row['or_number'];
        $uom = $row['uom'];
        $cost = $row['cost'];
        $minorCat = $row['minor_category'];
        $maintenance = '
        <div class="toolbar"><button class="toolbar-button button primary adminView" onclick="showMetroDialog(\'#adminAccountabilityDialog\'); ViewProperty('.$ids.');"><span class="mif-eye icon"></span></button>
        <button class="toolbar-button button primary adminView" onclick="showMetroDialog(\'#editPropertyDialog\'); EditProperty(\''.$ids.'\', \''.$pcode.'\',\''.$sno.'\',\''.trim($description).'\',\''.trim($brand).'\',\''.$model.'\',\''.$orNo.'\',\''.$uom.'\' ,'.$cost.','.$minorCat.');"><span class="mif-pencil icon"></span></button>
          <button class="toolbar-button button primary adminView" onclick="showMetroDialog(\'#deletePropertyDialog\'); DeletePropertyValidation(\''.$ids.'\',\''.$pcode.'\');"><span class="mif-bin icon"></span></button></div>';
        return $maintenance;
      }),
    array('db' => '`u`.`pcode`', 'dt' => 1,'field' => "pcode"),
    array('db' => '`u`.`sno`', 'dt' => 2,'field'=> 'sno'),
    array('db' => '`u`.`description`', 'dt' => 3,'field'=> 'description'),
    array('db' => '`u`.`qty`', 'dt' => 4,'field'=> 'qty')

  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `propertyMainteView` AS `u`";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $column, $joinQuery )
  );
  return;
?>
