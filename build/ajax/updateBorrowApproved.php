<?php
	require_once('../../connection.php');
	include "../../config.php";

	date_default_timezone_set('Asia/Manila');
	$dateToday = date('Y-m-d H:i:s');

	$request_code = $_POST['request_code'];

	$db->update("borrow_request", ["date_approved" => $dateToday], ["request_code" => $request_code]);

	echo 1;
?>
