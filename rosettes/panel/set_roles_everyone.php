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

    // if user doesn't own the guild, quietly fail.
    if (!UserOwnsGuild($db, $GuildId, $id)) {
        Header('Location: panel');
        exit;
    }
	
	// Update the guild

	if (isset($_POST['role_set'])) {
		if ($_POST['role_set'] > 0 && ctype_alnum($_POST['role_set'])) {
			$setRole = $_POST['role_set'];
		}
		else {
			Header('Location: roles?guild=$GuildId&error');
			exit;
		}
	}

	$query = $db->prepare("INSERT INTO requests (requesttype, relevantguild, relevantvalue) VALUES(0, ?, ?)");
    $query->bind_param("ss", $GuildId, $setRole);
	$success = $query->execute();
	
	if ($success) {
		Header('Location: roles?guild='.$GuildId.'&success');
	}
	else {
		Header('Location: roles?guild='.$GuildId.'&error');
	}
	exit;
