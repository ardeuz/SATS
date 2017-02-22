<?php
  if(isset($_GET['logout']))
  {
      session_destroy();
      header("location:index.php");
      exit();
  }

?>
<div class="app-bar fixed-top darcula" data-role="appbar" style="align:center;">
  <span class="app-bar-element branding"><?php echo $_SESSION['account']['department'];?></span>

  <ul class="app-bar-menu">
    <li <?php if ($thisPage == "accountabilities") {echo "class='active'";} ?>>
      <a href="accountabilities.php">Accountabilities</a>
    </li>
    <li <?php if($thisPage == "borrow" || $thisPage == "transfer") {echo "class='active'";}?>>
      <a hreaf="" class="dropdown-toggle"> Request For</a>
      <ul class="d-menu" data-role="dropdown">
        <li <?php if ($thisPage == "transfer") {echo "class='active'";} ?> >
          <a href="transfer.php">Transfer</a>
        </li>
        <li <?php if ($thisPage == "borrow") {echo "class='active'";} ?> >
          <a href="borrow.php">Borrow</a>
        </li>
      </ul>
    </li>
  </ul>


  <div class="app-bar-element place-right">
    <div class="app-bar-menu ">
      <span class="dropdown-toggle"> <?php echo $_SESSION['account']['last_name'].', '. $_SESSION['account']['first_name']; ?></span>
      <div class="app-bar-drop-container bg-white padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 320px">
        <ul class="unstyled-list fg-dark ">
          <li onClick="showMetroDialog('#helperDialog')" class="fg-white2 fg-hover-grayLight" data-hotkey="alt+1" >Help</li>
          <li onClick="showMetroDialog('#changePassword')" class="fg-white2 fg-hover-grayLight" data-hotkey="alt+2">Change Password</li>
          <li class="fg-white2 fg-hover-grayLight place-right"><a href="?logout=1" class="fg-white2 fg-hover-grayLight text-light padding0" style="border:0 transparent;background:transparent">Log Out</a></li>
        </ul>
      </div>
    </div>
  </div>
  <ul class="app-bar-menu place-right">
    <li class="<?php if ($thisPage == "TransferRequest" ||  $thisPage == "Borrow Request" || $thisPage == "Issuance Request") {echo "active";} ?> place-right" >
      <a  href="" class="dropdown-toggle"> Notification <?php

      if($db->has("transfer_request",
      ["AND" =>
        [
          "released_from" => $_SESSION['account']['emp_id'],
          "emp_approval" => 0
        ]
      ]))
      {
        echo "<span class='super mif-notification mif-ani-flash mif-ani-fast'></span>";

      }
      elseif($db->has("borrow_request",
      ["AND" =>
        [
          "released_from" => $_SESSION['account']['emp_id'],
          "emp_approval" => 0
        ]
      ]))
      {
        echo "<span class='super mif-notification mif-ani-flash mif-ani-fast'></span>";

      }
      elseif($db->has("issuance_request",
      ["AND" =>
        [
          "released_from" => $_SESSION['account']['emp_id'],
          "emp_approval" => 0
        ]
      ]))
      {
        echo "<span class='super mif-notification mif-ani-flash mif-ani-fast'></span>";
      }
      elseif($db->has("issuance_request",
      ["AND" =>
        [
          "transfer_to" => $_SESSION['account']['emp_id'],
          "emp_approval" => 1
        ]
      ]))
      {
        echo "<span class='super mif-notification mif-ani-flash mif-ani-fast'></span>";
      }
      ?>  </a>
      <ul class="d-menu" data-role="dropdown">
        <li <?php if ($thisPage == "TransferRequest") {echo "class='active'";} ?>>
          <a href="TransferRequest.php">Transfer Request
            <?php

            if($db->has("transfer_request",
            ["AND" =>
              [
                "released_from" => $_SESSION['account']['emp_id'],
                "emp_approval" => 0
              ]
            ]))
            {
              $transferRequestCount = $db->count("transfer_request",
              ["AND" =>
                [
                  "released_from" => $_SESSION['account']['emp_id'],
                  "emp_approval" => 0
                ]
              ]);
              echo '<span class="mif-ani-flash mif-ani-fast fg-red">'.$transferRequestCount.'</span>';
            }

            ?>
          </a>
        </li>
        <li class="divider"></li>
        <li <?php if ($thisPage == "Borrow Request") {echo "class='active'";} ?>>
          <a href="BorrowRequest.php">Borrow Request    <?php

            if($db->has("borrow_request",
            ["AND" =>
              [
                "released_from" => $_SESSION['account']['emp_id'],
                "emp_approval" => 0
              ]
            ]))
            {
              $borrowRequestCount = $db->count("borrow_request",
              ["AND" =>
                [
                  "released_from" => $_SESSION['account']['emp_id'],
                  "emp_approval" => 0
                ]
              ]);
              echo '<span class="mif-ani-flash mif-ani-fast fg-red">'.$borrowRequestCount.'</span>';
            }

            ?></a>
          <li class="divider"></li>

        </li>
        <li class="divider"></li>
        <li <?php if ($thisPage == "Issuance Request") {echo "class='active'";} ?>>
          <a href="issuanceRequest.php"> Issuance Request  <?php

            if($db->has("issuance_request",
            ["AND" =>
              [
                "request_to" => $_SESSION['account']['emp_id'],
                "emp_approval" => 0
              ]
            ]))
            {
              $borrowRequestCount = $db->count("issuance_request",
              ["AND" =>
                [
                  "request_to" => $_SESSION['account']['emp_id'],
                  "emp_approval" => 0
                ]
              ]);
              echo '<span class="mif-ani-flash mif-ani-fast fg-red">'.$borrowRequestCount.'</span>';
            }
            elseif($db->has("issuance_request",
            ["AND" =>
              [
                "transfer_to" => $_SESSION['account']['emp_id'],
                "emp_approval" => 1
              ]
            ]))
            {
              $borrowRequestCount = $db->count("issuance_request",
              ["AND" =>
                [
                  "transfer_to" => $_SESSION['account']['emp_id'],
                  "emp_approval" => 1
                ]
              ]);
              echo '<span class="mif-ani-flash mif-ani-fast fg-darkTeal">'.$borrowRequestCount.'</span>';
            }

            ?></a>
          <li class="divider"></li>

        </li>
      </ul>
      <li <?php if ($thisPage == "Owner Request") {echo "class='active'";} ?>>
        <a href="OwnRequest.php">My Request</a>
      </li>
    </li>
  </ul>
</div>
<div data-role="dialog" data-overlay="true" data-width="30%" data-height="50%" class="padding20" data-overlay-color="op-dark" data-overlay-click-close="true" id="helperDialog" data-close-button="true" style="overflow-y:scroll;">
  <h4 class="text-light">&nbsp; <b>How to Transfer?</b></h4>
  <p class="text-light">First, select what property do you want to transfer then click the add button. <br> <br> Next, fill out the needed information about the property do you want to transfer. <br> <br> Lastly, click the "add to transfer list" button. And after that you will see the property/s you borrowed. <br> <br> <small> You can also remove your request for borrow through clicking the "Cancel" button. </small></p>
  <br/>
  <h4 class="text-light">&nbsp; <b>How to Borrow?</b></h4>
  <p class="text-light">First, select what property do you want to borrow then click the add button. <br> <br> Next, fill out the needed information about the property do you want to borrow. <br> <br> Lastly, click the "add to borrow list" button. And after that you will see the property/s you transferred. <br> <br> <small> You can also remove your request for transfer through clicking the "Cancel" button. </small> <br> <br> <small>* You can also see the full information about the property do you want to transfer or borrow through clicking the button with an eye icon or simply the view button.</small>  </p>

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
  $.post("build/ajax/changePasswordUsers.php", { OldPass:OldPass, NewPass:NewPass}, function(data){
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
          content: "An error Occured(Please check your old password)",
          icon: "<span class='mif-cross icon'></span>",
          type: "alert"
      });
    }
  });
}
</script>
