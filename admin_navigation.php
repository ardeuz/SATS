<?php
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
    <li class="<?php if($thisPage =='TransferRequest' || $thisPage=='BorrowRequest'){echo 'active';} ?>">
        <a href="#" class="dropdown-toggle"><span class="mif-sd-card <?php if($db->has('transfer_request',
          [
            'emp_approval' => 1
          ]
        ) || $db->has('borrow_request',
          [
            'emp_approval' => 1
          ]
        )){
          echo 'mif-ani-heartbeat mif-ani-fast';
        }?> icon"></span> Request </a>
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
              <li class="<?php if($thisPage=='BorrowRequest'){echo 'active';} ?>"><a href="admin_borrow_request.php"><span class="mif-image icon"></span> Borrow Request
                <?php

                if($db->has("borrow_request",
                  [
                    "emp_approval" => 1
                  ]
                ))
                {
                  $borrowRequestCounted = $db->count("borrow_request",
                    [
                      "emp_approval" => 1
                    ]
                  );
                  {
                    echo "<small class='super mif-ani-flash fg-white'>&nbsp;".$borrowRequestCounted."</small>";
                  }
                }
                ?></a></li>
            </div>
        </ul>
    </li>

      <li  class="<?php if($thisPage=='PropertyAccountability' || $thisPage == 'NotPropertyAccountability'){echo 'active';} ?>">
        <a href="#"  class="dropdown-toggle"><span class="mif-file-text icon"></span>Property List </a>
        <ul class="d-menu shadow"  data-role="dropdown">
            <li class="menu-title">List of Accounts</li>
            <li class="<?php if($thisPage=='PropertyAccountability'){echo 'active';} ?>"><a href="admin_accountabilities.php"><span class="mif-file-text icon"></span> With Accountability</a></li>
            <li class="<?php if($thisPage=='NotPropertyAccountability'){echo 'active';} ?>"><a href="admin_accountabilities_not.php"><span class="mif-file-text icon"></span> Without Accountability</a></li>

        </ul>
      </li>
      <li class="<?php if($thisPage == $_GET['emp_id']){echo 'active';}?>">
        <a href="#"  class="dropdown-toggle"><span class="mif-file-text icon"></span>Accountabilities Of</a>
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
        <li  class="<?php if($thisPage=='ViewAccounts'){echo 'active';} ?>"><a href="admin_account_manage.php"><span class="mif-user icon"></span> Accounts</a></li>
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
              <li class="<?php if($thisPage == 'EditSubProperty'){echo 'active'; } ?>"><a href="mainteSubProperty.php"><span class="mif-arrow-right icon"></span> Sub Property</a></li>
              <li class="<?php if($thisPage == 'EditLocation'){echo 'active'; } ?>"><a href="mainteLocation.php"><span class="mif-arrow-right icon"></span> Location</a></li>
              <li class="<?php if($thisPage == 'EditMajorCat'){echo 'active'; } ?>"><a href="mainteMajor.php"><span class="mif-arrow-right icon"></span> Major Category</a></li>
              <li class="<?php if($thisPage == 'EditMinorCat'){echo 'active'; } ?>"><a href="mainteMinor.php"><span class="mif-arrow-right icon"></span> Minor Category</a></li>
            </div>
        </ul>

    </li>
    <li  class="<?php if($thisPage=='Repair'){echo 'active';} ?>"><a href="accountability_repair.php"><span class="mif-wrench icon"></span> Repair</a></li>
    <li class="menu-title">Settings</li>
    <li><a href="#"><span class="mif-cog icon"></span> Account Settings</a></li>
    <li><a href="?logout=1"><span class="mif-exit icon"></span> Logout</a></li>
    <li class="divider"></li>
    <li class="menu-title"></<li>

  </ul>
</div>

<div data-role="dialog" data-overlay="true" data-overlay-color="op-dark"data-width="30%" data-overlay-click-close="true" id="addNewUser" data-close-button="true" class="padding10">
  <h1 class="text-light">Add new User</h1>
  <div class="input-control full-size">
    <input type="text" id="emp_id" placeholder="Employee ID"/>
  </div>
  <div class="input-control full-size">
    <input type="text" id="first_name" placeholder="First Name"/>
  </div>
  <div class="input-control full-size">
    <input type="text" id="middle_name" placeholder="Middle Name"/>
  </div>
  <div class="input-control full-size">
    <input type="text" id="last_name" placeholder="Last Name"/>
  </div>
  <div class="input-control full-size">
    <input type="text" id="department" placeholder="Department"/>
  </div>
  <div class="input-control password full-size" data-role="input">
    <input type="text" id="password" placeholder="Password"/>
  </div>
  <button class="button warning" onClick="addNewUser()">Add New User</button>
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
  <div class="input-control full-size" data-role="select" id="showSelectMinor">
  </div>
  <div class="input-control full-size" data-role="input">
    <input type="text" id="newMinor" placeholder="Minor Category"/>
  </div>
  <button class="button warning" onclick="addNewMinor()">Add Minor Category</button>
</div>
