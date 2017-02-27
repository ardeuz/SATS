<?php
	require_once('../../connection.php');
	include "../../config.php";

	date_default_timezone_set('Asia/Manila');
	$dateToday = date('Y-m-d H:i:s');

	$request_code = $_POST['request_code'];

		//======generate ctrl no===========//
		$db->update("borrow_request_history", [
			"borrow_status" => "returned"
		],["request_code" => $request_code]); //insert things to history
	$db->delete("borrow_request",["request_code" => $request_code]);
	//deletions of borrows
	echo 1;
?>
