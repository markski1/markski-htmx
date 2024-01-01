<?php

	include_once("../funcs.php");

	$db = db_connect();

	$key = $_POST['rosettes_key'];

	if (!ctype_alnum($key)) {
		Header('Location: index?error=1');
		exit;
	}

	$query = $db->prepare("SELECT * FROM login_keys WHERE BINARY login_key = ?");
    $query->bind_param("s", $key);
    $query->execute();
    $result = $query->get_result();

	$result = $result->fetch_all(MYSQLI_ASSOC);

	if (count($result) < 1) {
		Header('Location: ../index?error=2');
		exit;
	}

	// literally impossible, but...
	if (count($result) > 1) {
		Header('Location: ../index?error=999');
		exit;
	}

	setcookie("rosettes_key", $key, time() + (86400 * 30), "/");

	Header('Location: ../panel');
	exit;
