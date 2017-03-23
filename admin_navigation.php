<?php
  date_default_timezone_set('Asia/Manila');
  if(isset($_GET['logout']))
  {
    session_destroy();
    header("location:index.php");
    exit();
  }

?>
<div class="cell size-x200 place-left bg-grayDarker"  id="cell-sidebar" >
  <div class="padding10 no-margin-top">
    <h4 class="align-center fg-white"><img src="logo/logo.png"/></h4>
  </div>
  <ul class="v-menu darcula no-margin-top">

    <li class="menu-title">Admin</li>

    <li class="<?php if($thisPage == 'Admin'){echo 'active';}?>"><a href="admin.php"><span class="mif-home icon"></span> Home</a></li>
    <li class="divider"></li>
    <li class="menu-title">Viewing</li>
    <!-- <li class=""> <a href="admin_history.php"><span class="mif-stack3 icon"></span> History</a></li> -->
    <li class="<?php if($thisPage =='TransferRequest' || $thisPage=='BorrowRequest' || $thisPage == 'issueanceProperty'){echo 'active';} ?>">
        <a href="#" class="dropdown-toggle"><span class="mif-layers <?php if($db->has('transfer_request',
          [
            'emp_approval' => 1
          ]
        )){
          echo 'mif-ani-heartbeat mif-ani-fast';
        }?> icon"></span> Transaction </a>
        <ul class="d-menu shadow"  data-role="dropdown">
            <li class="menu-title">List of Adding</li>
            <div>
              <li class="<?php if($thisPage=='TransferRequest'){echo 'active';} ?>"><a href="admin_transfer_request.php"><span class="mif-file-text icon"></span> Transfer Request
                <?php

                if($db->has("transfer_request",
                  [
                    "emp_approval" => 1
                  ]
                ))

                {
                  $transferRequestCounted = $db->count("transfer_request",
                    [
                      "emp_approval" => 1
                    ]
                    );
                  echo "<small class='super mif-ani-flash fg-white'>&nbsp;".$transferRequestCounted."</small>";
                }
                ?></a></li>
              <li class="<?php if($thisPage=='BorrowRequest'){echo 'active';} ?>"><a href="admin_borrow_request.php"><span class="mif-file-text icon"></span> Borrow Request</a></li>
              <li class="<?php if($thisPage=='issueanceProperty'){echo 'active';} ?>"><a href="admin_property_issuance.php"><span class="mif-file-text icon"></span> Property Issuance</a></li>
            </div>
        </ul>
    </li>

      <li  class="<?php if($thisPage=='PropertyAccountability' || $thisPage == 'NotPropertyAccountability'){echo 'active';} ?>">
        <a href="#"  class="dropdown-toggle"><span class="mif-stack icon"></span>Property List </a>
        <ul class="d-menu shadow"  data-role="dropdown">
            <li class="menu-title">List of Accounts</li>
            <li class="<?php if($thisPage=='PropertyAccountability'){echo 'active';} ?>"><a href="admin_accountabilities.php"><span class="mif-file-text icon"></span> With Accountability</a></li>
            <li class="<?php if($thisPage=='NotPropertyAccountability'){echo 'active';} ?>"><a href="admin_accountabilities_not.php"><span class="mif-file-text icon"></span> Without Accountability</a></li>
            <li class="<?php if($thisPage=='EquipmentRental'){echo 'active';} ?>"><a href="admin_equipment_rental.php"><span class="mif-file-text icon"></span> Equipment Rental</a></li>

        </ul>
      </li>
      <li class="<?php if($thisPage == $_GET['emp_id']){echo 'active';}?>">
        <a href="#"  class="dropdown-toggle"><span class="mif-user icon"></span>Accountabilities Of</a>
        <ul class="d-menu shadow"  data-role="dropdown">
            <li class="menu-title ">List of Accounts</li>
            <div style="height:250px;overflow-y:scroll;overflow-x: hidden;" id="style-4">
              <?php
                $accountDatas = $db->select("account_table", ["emp_id", "first_name", "last_name", "department"], ["ORDER" => "last_name"]);

                foreach ($accountDatas as $accountData) {
                  $full_name = $accountData['last_name'] . ", " . $accountData['first_name'];
                  echo "
                  <li class='" ;

                  if($thisPage == $accountData['emp_id'])
                  {
                    echo 'active';
                  }

                  echo
                    "'>
                    <a href='admin_accountability_property.php?emp_id=". $accountData['emp_id']. "'> <span class='mif-file-text icon'></span>
                      <div>
                        $full_name
                      </div>
                      <small>" . $accountData['department'] . " Department</small><br/>
                      <small>Employee ID: " . $accountData['emp_id'] . "</small>
                    </a>
                  </li>";
                }
              ?>
            </div>
        </ul>
        <li  class="<?php if($thisPage=='ViewAccounts'){echo 'active';} ?>"><a href="admin_account_manage.php"><span class="mif-users icon"></span> Accounts</a></li>
      </li>
    <li class="divider"></li>
    <li class="menu-title">Maintenance</li>
    <!-- <li>
        <a href="#" class="dropdown-toggle"><span class="mif-plus icon"></span> Add</a>
        <ul class="d-menu shadow"  data-role="dropdown">
            <div style="height:150px;overflow-y:scroll;" id="style-4">
              <li></li>
              <li><a href="#" onclick="showMetroDialog('#addNewLocation')"><span class="mif-arrow-right icon"></span> Location</a></li>
              <li><a href="#" onclick="showMetroDialog('#addNewMajorCategory')"><span class="mif-arrow-right icon"></span> Major Category</a></li>
              <li><a href="#" onclick="showMetroDialog('#addNewMinorCategory')"><span class="mif-arrow-right icon"></span> Minor Category</a></li>
            </div>
        </ul>
    </li> -->
    <li class="<?php if($thisPage == 'EditProperty' || $thisPage == 'EditUser' || $thisPage == 'EditLocation' || $thisPage == 'EditMajorCat' || $thisPage == 'EditMinorCat' ){echo 'active';  }?>">
      <a href="#" class="dropdown-toggle"><span class="mif-pencil icon"></span> Maintenance</a>
        <ul class="d-menu shadow"  data-role="dropdown">
            <div style="height:150px;overflow-y:scroll;" id="style-4">
              <li class="<?php if($thisPage == 'EditProperty'){echo 'active'; } ?>"><a href="mainteProperty.php"><span class="mif-arrow-right icon"></span> Property</a></li>
              <li class="<?php if($thisPage == 'EditSupplier'){echo 'active'; } ?>"><a href="mainteSupplier.php"><span class="mif-arrow-right icon"></span> Supplier</a></li>
              <li class="<?php if($thisPage == 'EditLocation'){echo 'active'; } ?>"><a href="mainteLocation.php"><span class="mif-arrow-right icon"></span> Location</a></li>
              <li class="<?php if($thisPage == 'EditMajorCat'){echo 'active'; } ?>"><a href="mainteMajor.php"><span class="mif-arrow-right icon"></span> Major Category</a></li>
              <li class="<?php if($thisPage == 'EditMinorCat'){echo 'active'; } ?>"><a href="mainteMinor.php"><span class="mif-arrow-right icon"></span> Minor Category</a></li>
            </div>
        </ul>

    </li>
    <li  class="<?php if($thisPage=='Repair'){echo 'active';} ?>"><a href="accountability_repair.php"><span class="mif-wrench icon"></span> Repair</a></li>


    <li class="menu-title">Settings</li>
    <li class="<?php if($thisPage=='BackupAndRestor'){echo 'active';}?>"><a href="exportDatabase.php"><span class="mif-database icon"></span> Backup and Restore</a></li>
    <li><a href="#" onClick="showMetroDialog('#changeSchoolYear')"><span class="mif-calendar icon"></span> Change Schoolyear</a></li>
    <li><a href="#" class="dropdown-toggle"><span class="mif-cogs icon"></span> Account</a>
        <ul class="d-menu shadow"  data-role="dropdown">
            <li class="menu-title">Account Setting</li>
            <div>
              <li><a href="#" onclick="showMetroDialog('#changePassword')"><span class="mif-cog icon"></span> Change Password</a></li>
              <?php
              if($db->has("admin",["sub_id"=>$_SESSION['account']['emp_id']])) {
                echo'<li><a href="accountabilities.php"><span class="mif-switch icon"></span> Switch  Account</a></li>';
              } elseif($db->has("account_table",["emp_id"=>$_SESSION['account']['sub_id']])) {
                $_SESSION['account']['emp_id']=$_SESSION['account']['sub_id'];
                echo'<li><a href="accountabilities.php"><span class="mif-switch icon"></span> Switch  Account</a></li>';
              }
              ?>
            </div>
        </ul>
    </li>
    <li><a href="?logout=1"><span class="mif-exit icon"></span> Logout</a></li>
    <li class="divider"></li>
    <li class="menu-title"></<li>

  </ul>
</div>


<div data-role="dialog" data-overlay="true" data-overlay-color="op-dark"data-width="30%" data-overlay-click-close="true" id="addNewLocation" data-close-button="true" class="padding10">
  <h1>Add new Location</h1>
  <div class="input-control full-size" data-role="input">
    <input type="text" id="newLoc" placeholder="Location Name"/>
  </div>
  <button class="button warning" onclick="addNewLocation()">Add new Location</button>
</div>
<div data-role="dialog" data-overlay="true" data-overlay-color="op-dark"data-width="30%" data-overlay-click-close="true" id="addNewMajorCategory" data-close-button="true" class="padding10">
  <h1>Add new Major Category</h1>
  <div class="input-control full-size" data-role="input">
    <input type="text" id="newMaj" placeholder="Major Category"/>
  </div>
  <div class="input-control full-size" data-role="input">
    <input type="text" id="depYear" placeholder="Depreciate Year"/>
  </div>
  <button class="button warning" onclick="addNewMajor()">Add Major Category</button>
</div>
<div data-role="dialog" data-overlay="true" data-overlay-color="op-dark"data-width="30%" data-overlay-click-close="true" id="addNewMinorCategory" data-close-button="true" class="padding10">
  <h1>Add new Minor Category</h1>
  <div class="input-control full-size" data-role="input">
    <input type="text" id="newMinor" placeholder="Minor Category"/>
  </div>
  <button class="button warning" onclick="addNewMinor()">Add Minor Category</button>
</div>
<div data-role="dialog" data-overlay="true" data-overlay-color="op-dark"data-width="30%" data-overlay-click-close="true" id="changeSchoolYear" data-close-button="true" class="padding10">
  <h1>Change School Year</h1>
    <div class="input-control full-size" data-role="input">

      <!-- <input type="text" id="newMinor" placeholder="Minor Category"/> -->
      <select id='changeSY'>
      <?php
        $year = intval(date("Y"));
        $yearValue = intval(date('y'));
        $firstVal = ($year -1)." - ".($year);
        $secondVal = ($year)." - ".($year + 1);
        echo '<option value='.($yearValue-1).$yearValue.'>'.$firstVal.'</option>';
        echo '<option value='.$yearValue.($yearValue+1).'>'.$secondVal.'</option>';
      ?>
      </select>
    </div>
    <button class="button warning" type="submit" onClick="changeSY()">Change</button>
</div>
<div data-role="dialog" data-overlay="true" data-width="30%" data-height="40%" class="padding20" data-overlay-color="op-dark" data-overlay-click-close="true" id="changePassword" data-close-button="true">
  <h4 class="text-light">Change Password</h4>
  <div class="input-control password full-size">
      <input type="password" id="OldPass" placeholder="Old Password">
  </div>
  <div class="input-control password full-size">
      <input type="password" id="NewPass" placeholder="New Password">
  </div>
  <div class="input-control full-size password">
      <input type="password" onChange = "checkPass()" id="ConfirmPass" placeholder="Confirm Password">
  </div>
  <button class="button primary place-right" onClick="changePassword()" id="changePasswordButton" disabled>Change Password</button>

</div>
<script>
function changeSY(){
  var changeSY = $("#changeSY").val();
  $.post('build/ajax/updateSY.php',{changeSY , changeSY}, function(data){
    $.Notify({
        caption: "School Year Changed",
        content: "Changing of School Year Completed",
        icon: "<span class='mif-checkmark icon'></span>",
        type: "success"
    });
    hideMetroDialog("#changeSchoolYear");
  });
}
function checkPass(){
      if($('#NewPass').val() != $('#ConfirmPass').val()){
        $('#ConfirmPass').addClass('bd-lightRed');
        $('#ConfirmPass').removeClass('bd-green');
        $("#changePasswordButton").prop("disabled",true);
      }
      else if($('#NewPass').val() == $('#ConfirmPass').val()) {
        $('#ConfirmPass').addClass('bd-green');
        $('#ConfirmPass').removeClass('bd-lightRed');
        $("#changePasswordButton").prop("disabled",false);
      }
      if($('#ConfirmPass').val() == ""){
        $('#ConfirmPass').removeClass('bd-green');
        $('#ConfirmPass').removeClass('bd-lightRed');
        $("#changePasswordButton").prop("disabled",true);
      }
  }
function changePassword(){
  var OldPass = $("#OldPass").val();
  var NewPass = $("#NewPass").val();
  $.post("build/ajax/changePasswordAdmin.php", { OldPass:OldPass, NewPass:NewPass}, function(data){
    var result = parseInt(data);
    if(result == 1){
      $.Notify({
          caption: "Change Password",
          content: "Changing of Password Completed",
          icon: "<span class='mif-checkmark icon'></span>",
          type: "success"
      });
      $('#OldPass').val('');
      $('#NewPass').val('');
      $("#ConfirmPass").val("");
      hideMetroDialog("#changePassword");
    }
    else if(result == 2){
      $.Notify({
          caption: "Changing of Password failed",
          content: "An error occured(Please check your old password)",
          icon: "<span class='mif-cross icon'></span>",
          type: "alert"
      });
    }
  });
}
</script>
