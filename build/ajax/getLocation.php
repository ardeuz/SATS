<?php
	require_once "../../connection.php";

	if (isset($_POST['transferRequest'])) {
		$locationDatas = $db->select("location",["id","location"]);
		echo "<option value='-1' selected disabled>Select a Location</option>";
		foreach ($locationDatas as $locationData) {
			echo "
			<option value='" . $locationData['id'] . "'>" . $locationData['location'] . "</option>";
		}
	}

?>
