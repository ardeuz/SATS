<?php
  session_start();
  require_once('connection.php');
  include('config.php');
  include('validatePage.php');
  $thisPage="Admin";
?>
<html>
<head>
  <title>Admin</title>
  <link rel="icon" href="logo/logo.png" type="image/png" sizes="16x22">
  <link href="build/css/metro.css" rel="stylesheet">
  <link href="build/css/backend.css" rel="stylesheet">
  <link href="build/css/admin.css" rel="stylesheet">
  <link href="build/css/metro-icons.css" rel="stylesheet">
  <link href="build/css/metro-responsive.css" rel="stylesheet">
  <link href="build/css/metro-schemes.min.css" rel="stylesheet">
  <link href="build/css/metro-colors.min.css" rel="stylesheet">
  <script src="build/js/jquery-2-1-3.min.js"></script>
  <script src="build/js/metro.js"></script>
</head>

  <body>
    <div class="contaner flex-grid no-responsive-feature" style="height:100%;overflow:hidden;">
      <div class="row" style="height:100%:">
        <?php require_once 'admin_navigation.php'; ?>
        <div class="cell auto-size padding10 no-margin-left grid container place-right" style="margin-top:45px;overflow-x:hidden;margin-right:1%;">
          <h1 class="text-light" style="font-weight:10px;">Admin's Dashboard</h1>
          <br/>
          <br/>
          <br/>
              <div class="row">
                <div class="cell size3 padding10">
                    <div class="tile full-size" onCLick="window.location.href = 'admin_transfer_request.php';">
                        <div class="tile-content slide-left-2 bg-dark">
                            <span class="tile-label fg-white">Transfer Request</span>
                            <span class="tile-badge fg-white bg-dark">
                              <?php
                                $transferCounts = $db->count("transfer_request",["emp_approval"=>1]);
                                echo $transferCounts;
                              ?>
                            </span>
                          <div class="slide">
                          </div>
                            <div class="slide-over bg-darkRed fg-white">
                              <div class="padding10">
                              <span class="text-light">In this module you can see all the Transfer Request</span>
                              </div>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="cell size3 padding10">
                    <div class="tile full-size bg-dark">
                        <div class="tile-content slide-down-2" onCLick="window.location.href = 'admin_borrow_request.php';">
                            <span class="tile-label fg-white">Borrow Requests</span>
                            <span class="tile-badge fg-white bg-dark">
                              <?php
                                $borrowsCounts = $db->count("borrow_request",["emp_approval"=>1]);
                                echo $borrowsCounts;
                              ?>
                            </span>
                            <div class="slide">
                            </div>
                            <div class="slide-over bg-darkBlue fg-white">
                              <div class="padding10">
                              <span class="text-light">In this module you can see all the Borrow Request</span>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell size3 padding10">
                    <div class="tile full-size bg-dark" onCLick="window.location.href = 'admin_accountabilities.php';">
                        <div class="tile-content slide-up-2">
                            <span class="tile-label fg-white">Property With Accountability</span>
                            <div class="slide">
                            </div>
                            <div class="slide-over bg-darkIndigo fg-white">
                              <div class="padding10">
                              <span class="text-light">In this module you can see the property that has Account Holders</span>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell size3 padding10">
                    <div class="tile full-size bg-dark" onCLick="window.location.href = 'admin_account_manage.php';">
                        <div class="tile-content slide-right-2">
                          <span class="tile-label fg-white">Accounts</span>
                            <div class="slide">
                            </div>
                            <div class="slide-over bg-darkGreen fg-white">
                              <div class="padding10">
                                <span class="text-light">In this module you can see <br/> the list of Accounts</span>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="cell size6 padding10">
                  <div class="tile full-size">
                      <div class="tile-content slide-up-2 bg-dark"   onCLick="window.location.href = 'admin_accountabilities_not.php';">
                          <span class="tile-label fg-white">Property Without Accountability</span>
                          <div class="slide">
                          </div>
                          <div class="slide-over bg-darkTeal fg-white">
                            <div class="padding10">
                              <span class="text-light">In this module you can see  the property that has no Account Holders </span>
                            </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="cell size6 padding10">
                  <div class="tile full-size">
                      <div class="tile-content slide-down-2 bg-dark" onCLick="window.location.href = 'accountability_repair.php';">
                          <span class="tile-label fg-white">Repair</span>
                          <div class="slide">
                          </div>
                          <div class="slide-over bg-darkEmerald fg-white">
                            <div class="padding10">
                              <span class="text-light">In this module can see the Repair History</span>
                            </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="cell size3 padding10" style="padding-top:0;padding-bottom:0;">
                  <div class="tile full-size tile-wide">
                      <div class="tile-content slide-up-2 bg-dark"  onCLick="window.location.href = 'mainteProperty.php';">
                          <span class="tile-label fg-white">Property Maintenance</span>
                          <div class="slide">

                          </div>
                          <div class="slide-over bg-darkCrimson fg-white">
                            <div class="padding10">
                              <span class="text-light">Maintenance for Property</span>
                            </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="cell size3 padding10" style="padding-top:0;padding-bottom:0;">
                  <div class="tile full-size tile-wide">
                      <div class="tile-content slide-left-2 bg-dark"  onCLick="window.location.href = 'mainteLocation.php';">
                          <span class="tile-label fg-white">Location Maintenance</span>
                          <div class="slide">

                          </div>
                          <div class="slide-over bg-darkBrown fg-white">
                            <div class="padding10">
                              <span class="text-light">Maintenance for Location</span>
                            </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="cell size3 padding10" style="padding-top:0;padding-bottom:0;">
                  <div class="tile full-size tile-wide">
                      <div class="tile-content slide-right-2 bg-dark"  onCLick="window.location.href = 'mainteMinor.php';">
                          <span class="tile-label fg-white">Minor Category Maintenance</span>
                          <div class="slide">

                          </div>
                          <div class="slide-over bg-lightBlue fg-white">
                            <div class="padding10">
                              <span class="text-light">Maitenance for Minor Category<span>
                            </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="cell size3 padding10" style="padding-top:0;padding-bottom:0;">
                  <div class="tile full-size tile-wide">
                      <div class="tile-content slide-down-2 bg-dark"  onCLick="window.location.href = 'mainteMajor.php';">
                          <span class="tile-label fg-white">Major Category <br/>Maintenance</span>
                          <div class="slide">

                          </div>
                          <div class="slide-over bg-lightRed fg-white">
                            <div class="padding10">
                              <span class="text-light">Maintenance for <br/>Major Category<span>
                            </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
