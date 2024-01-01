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

	if (isset($_POST['default_role'])) {
		if ($_POST['default_role'] >= 0 && ctype_alnum($_POST['default_role'])) {
			$defaultRole = $_POST['default_role'];
		}
		else {
			Header('Location: roles?guild=$GuildId&error');
			exit;
		}
	}

	$query = $db->prepare("UPDATE guilds SET defaultrole = ? WHERE id = ?");
    $query->bind_param("ss", $defaultRole, $GuildId);
	$success = $query->execute();
	
	if ($success) {
		Header('Location: roles?guild='.$GuildId.'&success');
	}
	else {
		Header('Location: roles?guild='.$GuildId.'&error');
	}
	exit;