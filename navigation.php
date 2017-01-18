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
    <li <?php if ($thisPage == "transfer") {echo "class='active'";} ?> >
      <a href="transfer.php">Transfer</a>
    </li>
    <li <?php if ($thisPage == "borrow") {echo "class='active'";} ?> >
      <a href="borrow.php">Borrow</a>
    </li>
    <li <?php if ($thisPage == "TransferRequest" ||  $thisPage == "Borrow Request" || $thisPage == "Own Request") {echo "class='active'";} ?> >
      <a  href="" class="dropdown-toggle"> Request <?php

      if($db->has("transfer_request",
      ["AND" =>
        [
          "released_from" => $_SESSION['account']['emp_id'],
          "emp_approval" => 0
        ]
      ]))
      {
        echo "<span class='mif-mail mif-ani-ring mif-ani-shuttle fg-lightOrange'></span>";
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
              echo "<span class='super mif-mail mif-ani-ring mif-ani-shuttle fg-lightOrange'></span>";
            }

            ?>
          </a>
        </li>
        <li class="divider"></li>
        <li <?php if ($thisPage == "Borrow Request") {echo "class='active'";} ?>>
          <a href="BorrowRequest.php">Borrow Request</a>
          <li class="divider"></li>
          <li <?php if ($thisPage == "Owner Request") {echo "class='active'";} ?>>
            <a href="OwnRequest.php">My Request</a>
          </li>
        </li>
      </ul>
    </li>
  </ul>

  <div class="app-bar-element place-right">
    <div class="app-bar-menu ">
      <span class="dropdown-toggle"><span class="mif-cog"></span> <?php echo $_SESSION['account']['last_name'].', '. $_SESSION['account']['first_name']; ?></span>
      <div class="app-bar-drop-container bg-white padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 320px">
        <ul class="unstyled-list fg-dark ">
          <!-- <li onClick="edit('#dialog1')" class="fg-white2 fg-hover-grayLight" data-hotkey="alt+1">My Account</li>
          <li onClick="edit('#dialogs')" class="fg-white2 fg-hover-grayLight">Change Password</li> -->
          <li class="fg-white2 fg-hover-grayLight place-right"><a href="?logout=1" class="fg-white2 fg-hover-grayLight text-light padding0" style="border:0 transparent;background:transparent">Log Out</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
