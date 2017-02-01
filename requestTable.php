<?php
    require_once('connection.php');
    session_start();
if(isset($_POST['showTable']))
    {
        $id=$_SESSION['username'];
        $prowarequery=$connection->query("SELECT * from property_view where emp_id !='$id'");
    ?>
                    <table class="dataTable border bordered hovered" id="showRequestTable">
                        <thead>
                        <tr>
                            <td class="auto size"></td>
                            <td class="sortable-column">Property Code</td>
                            <td class="sortable-column">Serial Number</td>
                            <td class="sortable-column">Description</td>
                            <td class="sortable-column">Location</td>
                            <td class="sortable-column">Condition</td>
                            <td class="sortable-column">Quantity</td>
                            <td>Department</td>
                            <td class="auto size">Confirmation </td>
                        </tr>
                        </thead>
                         <tbody>
                    <?php
                            while($r = $prowarequery->fetch())
                            {
                    ?>

                        <tr>
                            </td>
                            <td>
                                <div class="toolbar"><button class="toolbar-button button primary requestView" onclick="showMetroDialog('#requestInformation')" idRv="<?php echo $r['id']?>"><span class="mif-eye icon"></span></button>
                                </div>


                            </td>
                            <td><?php echo $r['pcode']?></td>
                            <td><?php echo $r['sno']?></td>
                            <td><?php echo $r['description']?></td>
                            <td><?php echo $r['location']?></td>
                            <td><?php echo $r['condition_info']; ?></td>
                            <td><?php echo $r['qty']?></td>
                            <td><?php echo $r['department']?></td>
                            <td>
                                <div class="toolbar"><button class="toolbar-button button success " onclick="showMetroDialog('#confirmYes'); "><span class="mif-checkmark icon"></span></button>
                                <button class="toolbar-button button danger " onclick="showMetroDialog('#confirmNo');"><span class="mif-cross icon"></span></button></div>


                            </td>
                        </tr>
                    <?php
                                }
                    ?>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        $("table").dataTable({
                            'searching' : true,
                            'paging' : true,
                            'lengthChange' : false
                        });
                    </script>
            <?php
        exit();

    }
if(isset($_POST['showInformation']))
    {

        $prowarequery=$connection->prepare("SELECT * from property_information_view where id = :id");
        $prowarequery->execute(
            array(
                'id'=>$_POST['prowareID']
                ));
    ?>
                    <table class="table border bordered striped" style="overflow-y:hidden; " style="height:50%;">
                     <tbody>
                    <?php
                            while($row = $prowarequery->fetch())
                            {
                    ?>
                       <tr>
                            <td style="text-align:center;"><h4>Specifications</h4></td>
                            <td style="text-align:center;"><h4>Value</h4></td>
                        </tr>
                          <tr>
                            <td>Property Code</td>
                            <td><?php echo $row['pcode'];?></td>
                        </tr>
                        <tr>
                            <td>Serial Number</td>
                            <td><?php echo $row['sno'];?></td>
                        </tr>
                        <tr>
                            <td>Property Description</td>
                            <td><?php echo $row['property_description'];?></td>
                        </tr>
                        <tr>
                            <td>Brand</td>
                            <td><?php echo $row['brand'];?></td>
                        </tr>
                        <tr>
                            <td>Model</td>
                            <td><?php echo $row['model'];?></td>
                        </tr>
                        <tr>
                            <td>Minor Description</td>
                            <td><?php echo $row['minor_description'];?></td>
                        </tr>
                        <tr>
                            <td>Major Description</td>
                            <td><?php echo $row['major_description'];?></td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td><?php echo $row['qty'];?></td>
                        </tr>
                        <tr>
                            <td>Unit of Measurement</td>
                            <td><?php echo $row['uom'];?></td>
                        </tr>
                        <tr>
                            <td>Condition</td>
                            <td><?php echo $row['condition_info'];?></td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td><?php echo $row['location'];?></td>
                        </tr>
                        <tr>
                            <td>Cost</td>
                            <td><?php echo $row['cost'];?></td>
                        </tr>
                    <?php
                                }
                    ?>
                        </tbody>
                    </table>

            <?php
        exit();

    }
if(isset($_POST['showQuantity']))
{
    echo $_POST['transferID'];
}

?>
