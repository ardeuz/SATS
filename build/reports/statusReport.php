<?php

  require_once('../../connection.php');
  date_default_timezone_set('Asia/Manila');
	$dateToday = date('M d, Y');
  $propertyId = $_GET['propertyId'];
  $statusReportData = $db->get("property","*",["id"=>$propertyId]);
  $statusReportDatas = $db->get("property_accountability","*",["property_id"=>$statusReportData['id']]);
  $statusReportLocationData = $db->get("location",["location"],["id"=>$statusReportDatas['location_id']]);
  // echo $statusReportData['id'];
  // echo $statusReportLocationData['location'];
  // return;
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
  <img src="../img/stilogo.png" width="120" height="90"></img>
  <span class="text-ligh "><b>STATUS REPORT FORM</b></span>
  <span class="text-light place-right"><b>Date:</b><u>&nbsp;&nbsp;&nbsp; <?php echo $dateToday; ?></u></span>

  <div>
    <table style='width: 100%;'>
      <tbody>
        <tr>
            <span class="text-light" colspan="3"><b>CLASSIFICATION</b></span>
          <td>
            <label class="input-control checkbox">
                <input type="checkbox">
                <span class="check"></span>
                <span class="caption">Office / School Equipment</span>
            </label><br/>
            <label class="input-control checkbox checkbox">
                <input type="checkbox">
                <span class="check"></span>
                <span class="caption">Office  Furniture / Fixture</span>
            </label>

          </td>
          <td>
            <label class="input-control checkbox checkbox ">
                <input type="checkbox">
                <span class="check"></span>
                <span class="caption">School Furniture / Fixture</span>
            </label><br/>
            <label class="input-control checkbox checkbox">
                <input type="checkbox">
                <span class="check"></span>
                <span class="caption">Computer Equipment</span>
            </label>
          </td>
          <td>

            <label class="input-control checkbox checkbox ">
                <input type="checkbox">
                <span class="check"></span>
                <span class="caption">Leasehold</span>
            </label><br/>
            <label class="input-control checkbox checkbox ">
                <input type="checkbox">
                <span class="check"></span>
                <span class="caption">Others (Pls. Specify): ______________________</span>
            </label>
          </td>
        </tr>
      </tbody>
    </table>
    <br />
    <div class="row no-margin-top">
      <div class="cell size12">
        <span class="text-light"><b>DESCRIPTION : </b><u>&nbsp;&nbsp;&nbsp;<?php echo $statusReportData['description'];?>&nbsp;&nbsp;&nbsp;</u></span><br/>
        <table style="width:100%;">
          <tr>
            <td>
              <b>PROPERTY CODE </b>
            </td>
            <td>
              <b> : </b>
            </td>
            <td>
              <u>&nbsp;&nbsp;&nbsp;<?php echo $statusReportData['pcode']?>&nbsp;&nbsp;&nbsp;</u>
            </td>
            <td>
              <b>SERIAL NO.</b>
            </td>
            <td>
              <b> : </b>
            </td>
            <td>
              <u>&nbsp;&nbsp;&nbsp;<?php echo $statusReportData['sno']?>&nbsp;&nbsp;&nbsp;</u>
            </td>
          </tr>
          <tr>
            <td>
              <b>LOCATION</b>
            </td>
            <td>
              <b> : </b>
            </td>
            <td>
              <u>&nbsp;&nbsp;&nbsp;
                <?php echo $statusReportLocationData['location']?>
                &nbsp;&nbsp;&nbsp;</u>
            </td>
            <td>
              <b>AREA/RM NO.</b>
            </td>
            <td>
              <b> : </b>
            </td>
            <td>
              <u>&nbsp;&nbsp;&nbsp;AREA HERE&nbsp;&nbsp;&nbsp;</u>
            </td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td><b>DETAIL OF PROBLEM</b></td>
            <td><b> : </b></td>
            <td><b><u>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_GET['remarks']?>&nbsp;&nbsp;&nbsp;&nbsp;</u></b></td>
          </tr>
          <tr><td></td><td></td><td></td></tr>
          <tr>
            <td><b>RECOMMENDATION</b></td>
            <td><b> : </b></td>
            <td>_____________________________________________________________________________________________</td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td><b>ACTION TAKEN</b></td>
            <td><b> : </b></td>
            <td>_______________________________________________</td>
            <td><b>DATE</b></td>
            <td><b> : </b></td>
            <td>______________________________________</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <br />
  <div>
    <table style='width: 100%'>
      <tbody>
        <td>
          <span class="text-light"><b>Prepared By:</b></span>
          <br/>
          <br/>
          <span>________________________________</span>
          <br/>
          <span>PAMO</span>
        </td>
        <td>
          <span class="text-light"><b>Checked By:</b></span>
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
          <span>________________________________</span>
          <br/>
          <span><?php $accountDatas=$db->get("borrow_request_history",["[><]account_table"=>["borrowed_to"=>"emp_id"]],["last_name","first_name"]);
          echo $accountDatas['last_name'].', '. $accountDatas['first_name'];?></span>
        </td>
      </tbody>
    </table>
  </div>
</body>
</html>
