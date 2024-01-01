<?php
	include_once("funcs.php");
	$db = db_connect();

	if (!CheckSession($db, $namecache, $id)) {
		Header('Location: index');
		exit;
	}

	if (!isset($_POST['guild'])) {
		Header('Location: panel');
		exit;
	}

	if (!ctype_alnum($_POST['guild'])) {
		Header('Location: panel');
		exit;
	}

	$GuildId = $_POST['guild'];
	
	// Update the guild

	$settings = '1111111111';

	if (isset($_POST['message_processing'])) {
		if (strlen($_POST['message_processing']) == 1 && $_POST['message_processing'] >= 0 && $_POST['message_processing'] <= 2) {
			$settings[0] = $_POST['message_processing'];
		}
		else {
			Header('Location: settings?guild=$GuildId&error');
			exit;
		}
	}

	if (isset($_POST['music_commands'])) {
		if (strlen($_POST['music_commands']) == 1 && $_POST['music_commands'] >= 0 && $_POST['music_commands'] <= 1) {
			$settings[1] = $_POST['music_commands'];
		}
		else {
			Header('Location: settings?guild=$GuildId&error');
			exit;
		}
	}

	if (isset($_POST['random_commands'])) {
		if (strlen($_POST['random_commands']) == 1 && $_POST['random_commands'] >= 0 && $_POST['random_commands'] <= 1) {
			$settings[2] = $_POST['random_commands'];
		}
		else {
			Header('Location: settings?guild=$GuildId&error');
			exit;
		}
	}

	if (isset($_POST['vc_monitor'])) {
		if (strlen($_POST['vc_monitor']) == 1 && $_POST['vc_monitor'] >= 0 && $_POST['vc_monitor'] <= 1) {
			$settings[5] = $_POST['vc_monitor'];
		}
		else {
			Header('Location: settings?guild=$GuildId&error');
			exit;
		}
	}

	if (isset($_POST['farm_commands'])) {
		if (strlen($_POST['farm_commands']) == 1 && $_POST['farm_commands'] >= 0 && $_POST['farm_commands'] <= 1) {
			$settings[4] = $_POST['farm_commands'];
		}
		else {
			Header('Location: settings?guild=$GuildId&error');
			exit;
		}
	}

	$query = $db->prepare("INSERT INTO requests (requesttype, relevantguild, relevantvalue) VALUES(1, ?, 0)");
    $query->bind_param("s", $GuildId);
    $query->execute();

	$query = $db->prepare("UPDATE guilds SET settings = ? WHERE id = ?");
    $query->bind_param("ss", $settings, $GuildId);
	$result = $query->execute();

	if ($result) {
		Header('Location: settings?guild='.$GuildId.'&success');
	}
	else {
		Header('Location: settings?guild='.$GuildId.'&error');
	}
	exit;