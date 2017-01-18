<?php
	require_once("../../connection.php");

	$request_code = $_POST['confirmation_id'];

	$db->update("borrow_request", ["emp_approval" => 1], ["request_code" => $request_code]);

	echo 1;
?>
