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

	if (!is_numeric($_POST['cmd_type'])) {
		exit("Sorry, there was an internal error.");
	}

	$cmd_type = intval($_POST['cmd_type']);

	$name = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['name']);

	$description = preg_replace("/[^a-zA-Z0-9 ]+/", "", $_POST['description']);

	if ($cmd_type == 0) {
		$invalid_characters = array("$", "%", "#", "<", ">", "|", "'");
		$value = str_replace($invalid_characters, "", $_POST['message']);
	}
	else {
		$value = intval($_POST['role_selector']);
	}

	if (isset($_POST['ephemeral'])) {
		$ephemeral = 1;
	}
	else {
		$ephemeral = 0;
	}

	$query = $db->prepare("INSERT INTO custom_cmds (guildid, name, description, ephemeral, action, value) VALUES(?, ?, ?, ?, ?, ?)");
    $query->prepare("ssssss", $GuildId, $name, $description, $ephemeral, $cmd_type, $value);
	try {
		$query->execute();
        $result = $query->get_result();
	}
	catch (Exception $e) {
		$result = false;
	}

	$query = $db->prepare("INSERT INTO requests (requesttype, relevantguild) VALUES(4, ?)");
    $query->bind_param("s", $GuildId);
    $query->execute();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rosettes - Role Management</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<center>
			<h1 class="title">Rosettes</h1>
			<p class="headingMd"><b>Custom command created</b></p>
			<hr />
			<div class='headingContainer'>
				<?php if ($result) { ?>
					<p><big>Command added.</big></p>
					<p>Your new command will be usable in your server soon.</p>
				<?php } else { ?>
					<p><big>Command not added.</big></p>
					<p>There was an error adding your command. <br/>Please go back and check you filled in everything.<br/>Please make sure you don't already have a command with this name.</p>
				<?php } ?>
			</div>

			<a href="commands?guild=<?=$GuildId?>"><button type="button" class='button' style='width: 10rem; margin: 10px'>Return</button></a>
		</center>
	</div>
</body>
</html>