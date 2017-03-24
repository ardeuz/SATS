<?php

  require_once('../../connection.php');
  date_default_timezone_set('Asia/Manila');
	$dateToday = date('M d, Y H:i:A');

  $ctrl_no = $_GET['ctrl_no'];
  $remarks = $db->get("borrow_request_history",["remarks","borrow_status"],["ctrl_no"=>$ctrl_no]);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Borrow Report</title>
  <link rel="icon" href="../../logo/logo.png" type="image/png" sizes="16x22">
  <link href="..//css/metro.css" rel="stylesheet">
  <link href="..//css/metro-icons.css" rel="stylesheet">
</head>
<body class="padding10" onload="window.print();">
  <br/>
  <img src="../img/stilogo.png" width="120" height="90"></img>
  <span class="text-light header"><b>Property Accountability Form</b></span>
  <div>
    <table style='width: 100%;'>
      <tbody>
        <tr>
          <td>
            <span class="text-light"><b>Control Number:</b> <?php echo $ctrl_no; ?></span>
            <br />
            <br />
            <span class="text-light"><b>Date:</b> <?php echo $dateToday; ?></span>
          </td>
          <td class="align-right">
            <br/>
            <br/>
            <span><b>Purpose:</b>&nbsp; <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $remarks['remarks'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> </span>
            <br/>
            <br/>
            <span></span>
            <br/>
          </td>
        </tr>
      </tbody>
    </table>
    <br />
    <div class="row no-margin-top">
      <div class="cell size12">
        <span class="text-light sub-header"><b>Borrow Details</b></span>
        <table class="table bordered text-light" style='width: 100%'>
          <thead>
            <tr>
              <th class="fg-black small">Property Code</th>
              <th class="fg-black small">Old Location</th>
              <th class="fg-black small">New Location</th>
              <th class="fg-black small">Property Type</th>
              <th class="fg-black small">Condition</th>
              <th class="fg-black small">Borrowed By</th>
              <th class="fg-black small">Released From</th>
              <?php
              if($remarks['borrow_status']=='borrowed'){
                echo '<th class="fg-black small">Date Borrowed</th>';
              }
              elseif($remarks['borrow_status']=='returned'){
                echo '<th class="fg-black small">Date Returned</th>';
              }
              ?>
              <th class="fg-black small">Remarks</th>
            </tr>
          </thead>
          <tbody class='small'>
          <?php

            $sql = "SELECT a.borrow_status, b.pcode,a.date_actual_returned, b.description, c.location as old_loc, d.location as new_loc, (SELECT major_category.description from major_category where major_category.id =  b.major_category) as property_type, e.condition_info, CONCAT(f.last_name,', ',f.first_name) as borrowed_to, CONCAT(g.last_name,', ',g.first_name) as Released_From, a.remarks , a.date_approved , a.date_returned FROM borrow_request_history AS a LEFT JOIN property AS b ON a.id = b.id LEFT JOIN location AS c ON a.old_loc_id = c.id LEFT JOIN location AS d ON a.new_loc_id = d.id LEFT JOIN condition_info AS e ON a.condition_id = e.id LEFT JOIN account_table AS f on a.borrowed_to = f.emp_id LEFT JOIN account_table AS g on a.released_from = g.emp_id WHERE a.ctrl_no= '$ctrl_no'";
            $transferReportDatas = $db->query($sql)->fetchAll();
            foreach ($transferReportDatas as $transferReportData) {

              $borrowdatas =  "
                <tr style='font-size: 12px'>
                  <td>".$transferReportData['pcode']."</td>
                  <td>".$transferReportData['old_loc']."</td>
                  <td>".$transferReportData['new_loc']."</td>
                  <td>".$transferReportData['property_type']."</td>
                  <td>".$transferReportData['condition_info']."</td>
                  <td>".$transferReportData['borrowed_to']."</td>
                  <td>".$transferReportData['Released_From']."</td>
                  ";
                  if($transferReportData['borrow_status']=="borrowed"){
                    $borrowdatas .= "  <td>".$transferReportData['date_approved']."</td>
                      <td>".$transferReportData['borrow_status']."</td>
                    </tr>
                    <tr>
                      <td colspan='8' style='font-size: 11px;'><span class='mif-arrow-down-right'></span>&nbsp;<b>Full Description:</b> ".$transferReportData['description']."</td>
                    </tr>
                      ";
                  }
                  elseif($transferReportData['borrow_status']=="returned"){
                    $borrowdatas .= "  <td>".date('M d, Y',strtotime($transferReportData['date_actual_returned']))."</td>
                      <td>".$transferReportData['borrow_status']."</td>
                    </tr>
                    <tr>
                      <td colspan='8' style='font-size: 11px;'><span class='mif-arrow-down-right'></span>&nbsp;<b>Full Description:</b> ".$transferReportData['description']."</td>
                    </tr>
                      ";
                  }
                  echo $borrowdatas;
            }
          ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <br />
  <div>
    <table style='width: 100%'>
      <tbody>
        <td>
          <span class="text-light"><b>Checked By:</b></span>
          <br/>
          <br/>
          <br/>
          <span>________________________________</span>
          <br/>
          <span>PAMO</span>
        </td>
        <td>
          <span class="text-light"><b>Approved By:</b></span>
          <br/>
          <br/>
          <br/>
          <span>________________________________</span>
          <br/>
          <span>M.C.I - School Admin</span>
        </td>
        <td>
          <span class="text-light"><b>Received By:</b></span>
          <br/>
          <br/>
          <br/>
          <span>________________________________</span>
          <br/>
          <br/>
        </td>
        <td class='align-right'>
          <span class="text-light"><b>*CONDITION-DESCRIPTION</b></span>
          <br/>
          <span class="text-light minor-header">GOOD - Functionaly Operational</span>
          <br/>
          <span class="text-light minor-header">FAIR - Limited repairs ncessary</span>
          <br/>
          <span class="text-light minor-header">POOR - Major repairs necessary</span>
          <br/>
          <span class="text-light minor-header">SCRAP - Item has no value</span>
          <br/>
        </td>
      </tbody>
    </table>
  </div>
</body>
</html>
