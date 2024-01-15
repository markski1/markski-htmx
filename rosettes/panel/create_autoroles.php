<?php
	include_once("funcs.php");
    include_once("emoji/Emoji.php");

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

	// if inputs look sus, quietly fail.
	foreach ($_POST['roleEntry'] as $role) {
		if (!Emoji\is_single_emoji($role['emoji']) || !ctype_alnum($role['roleid'])) {
			Header('Location: panel');
			exit;
		}
	}

	$name = preg_replace("/[^a-zA-Zá-úÁ-Ú0-9 .,!?]+/", "", $_POST['name']);

	// first: clear old guild autoroles
	$query = $db->prepare("INSERT INTO autorole_groups (guildid, messageid, name) VALUES(?, 0, ?)");
    $query->bind_param("ss", $GuildId, $name);
	$query->execute();

    $GroupId = $db->insert_id;

	// second: get cracking
	foreach ($_POST['roleEntry'] as $role) {
		$query = $db->prepare("INSERT INTO autorole_entries (guildid, emote, roleid, rolegroupid) VALUES(?, ?, ?, ?)");
        $query->bind_param("ssss", $GuildId, $role['emoji'], $role['roleid'], $GroupId);
		$query->execute();
	}

$site = new PanelTemplate("AutoRole Created");

$content = <<<HTML


    <h1 class="title">Rosettes</h1>
    <p class="headingMd"><b>AutoRoles saved</b></p>
    <hr />
    <div class='headingContainer'>
        <p><big>You're almost done!</big></p>
        <p>A new AutoRole group has been created.</p>
        <p>All that's left is to use "<b>/setautorole {$GroupId}</b>" in the desired channel.</p>
        <p>If you don't want to do it now, you can do it anytime you want.</p>
    </div>
    
    <a href="roles?guild={$GuildId}"><button type="button" class='button' style='width: 10rem; margin: 10px'>Return</button></a>


HTML;

$site->render($content);