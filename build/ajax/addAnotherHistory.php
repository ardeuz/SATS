<?php

  require_once('../../connection.php');
  date_default_timezone_set('Asia/Manila');
  $audit_id = $_POST['audit_id'];
  $remarks = $_POST['remarks'];
  $recommendation = $_POST['recommendation'];
  $cost = $_POST['cost'];
  $dateToday = date('Y-m-d H:i:s');
  $historyDatas = $db->get("property",["pcode","brand","sno","description","uom","or_number"],["id"=>$audit_id]);
  $db->insert("audit_trail_condition",[
    "action"=>"admin added another remarks",
    "pcode"=>$historyDatas['pcode'],
    "sno"=> $historyDatas['sno'],
    "description"=> $historyDatas['description'],
    "actor"=>"admin",
    "cost"=> $cost,
    "date"=> $dateToday,
    "property_id"=> $audit_id,
    "remarks"=> $remarks,
    "recommendation"=> $recommendation,
    "brand"=> $historyDatas['brand'],
    "uom"=> $historyDatas['uom'],
    "po_number"=> $historyDatas['or_number']
  ],
  ["property_id"=>$audit_id]);
  echo 1;
?>
