<?php
	if (isset($_SESSION['propertyTransferList'])) {
		$propertyTransferList = $_SESSION['propertyTransferList'];

		//===========count employees to be get=============//
		$employeeList = array();
		for ($i = 0; $i < count($propertyTransferList); $i ++) {
			if (count($employeeList) <= 0) { //if there's still no employee, add it default
				$employee = new stdClass();

				$employee->{'emp_id'} = $propertyTransferList[$i]->{'property'}['emp_id'];
				$employee->{'first_name'} = $propertyTransferList[$i]->{'property'}['first_name'];
				$employee->{'last_name'} = $propertyTransferList[$i]->{'property'}['last_name'];
				$employee->{'department'} = $propertyTransferList[$i]->{'property'}['department'];

				array_push($employeeList, $employee);
			} else {

				$hasEmployee = false;

				for ($j = 0; $j < count($employeeList); $j ++) { //loop to check employee is already on the array
					if ($employeeList[$j]->{'emp_id'} == $propertyTransferList[$i]->{'property'}['emp_id']) { //condition of it is already there
						$hasEmployee = true;
					}
				}

				if (!$hasEmployee) { //if not there, add the employee
					$employee = new stdClass();

					$employee->{'emp_id'} = $propertyTransferList[$i]->{'property'}['emp_id'];
					$employee->{'first_name'} = $propertyTransferList[$i]->{'property'}['first_name'];
					$employee->{'last_name'} = $propertyTransferList[$i]->{'property'}['last_name'];
					$employee->{'department'} = $propertyTransferList[$i]->{'property'}['department'];

					array_push($employeeList, $employee);
				}
			}
		}

		//============make the card=================//
		echo "<div class='row cells3'>";
		$cardCount = 1;
		for ($i = 0; $i < count($employeeList); $i ++) {
			echo "
			<div class='cell padding20 shadow'>
		        	<small>Accountabilities of</small>
		        	<button onclick='removeEmployee(\"" . $employeeList[$i]->{'emp_id'} . "\")' class='button small-button danger cycle-button shadow place-right'><span class='mif-cross'></span></button>
		        	<br />
		            <span class='sub-header'>" . $employeeList[$i]->{'first_name'} . " " . $employeeList[$i]->{'last_name'}
		            . "</span>
		            <p><small>" . $employeeList[$i]->{'department'}  . " Department</small></p>
		            <hr class='thin' />";

		            echo "<div style='overflow-y: scroll; height: 200px'>";
		            for ($j = 0; $j < count($propertyTransferList); $j ++) {

		            	if ($propertyTransferList[$j]->{'property'}['emp_id'] == $employeeList[$i]->{'emp_id'}) {
		            		echo "
		            		<div class='hv-active' onclick='removeProperty(" . $propertyTransferList[$j]->{'property'}['id'] . ", " . $propertyTransferList[$j]->{'property'}['location_id'] . ")'>
		                	<b>" . $propertyTransferList[$j]->{'property'}['property_description'] . "</b>
		                	<p><small>x
		                	" . $propertyTransferList[$j]->{'qty'} . " "
		                	. $propertyTransferList[$j]->{'property'}['uom'] . "</small></p>

		                	<p><small><b>Condition:</b> " . $propertyTransferList[$j]->{'property'}['condition_info'] . "</small></p>";
											$location_string = $db->get("location", "location", ["id" => $propertyTransferList[$j]->{'location'}]);

		                	echo "
		                	<span><b>From:</b> " . $propertyTransferList[$j]->{'property'}['location'] . "</span>
		                	<br />
		            		<span><b>To:</b> " . $location_string . "</span>";

		                	echo "<hr class='thin bg-grayLighter'>
		                	</div>";
		            	}
		            }

		            echo "
		            </div>
		            <hr class='thin' />
		            <button onclick='requestTransfer(\"" . $employeeList[$i]->{'emp_id'} . "\")' class='button place-right'>
		            	<span class='mif-truck mif-ani-pass mif-ani-slow'></span>
		            	Request Transfer
		        	</button>
		    </div>";

		    if ($cardCount == 3) {
		    	echo "</div>";

		    	echo "<div class='row cells3'>";
				$cardCount = 1;
		    }

		    $cardCount++;
		}

		if ($cardCount != 3) {
			echo "</div>";
		}

		if (count($propertyTransferList) <= 0) {
			echo "<h2>You have no any transfer request.</h2>
			<small>Choose property on the list to request for transfer to your accountability.</small>";
		}

	} else {
		echo "<h2>You have no any transfer request.</h2>
		<small>Choose property on the list to request for transfer to your accountability.</small>";
	}

?>
