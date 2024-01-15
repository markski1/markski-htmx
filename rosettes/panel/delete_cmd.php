<?php
include_once("funcs.php");
$db = db_connect();

if (!CheckSession($db, $namecache, $id)) {
    Header('Location: index');
    exit;
}

if (!isset($_GET['guild'])) {
    Header('Location: panel');
    exit;
}

if (!ctype_alnum($_GET['guild']) ) {
    Header('Location: panel');
    exit;
}

if (!ctype_alnum($_GET['name'])) {
    Header('Location: panel');
    exit;
}

$cmd_name = $_GET['name'];

$GuildId = $_GET['guild'];

// if user doesn't own the guild, quietly fail.
if (!UserOwnsGuild($db, $GuildId, $id)) {
    Header('Location: panel');
    exit;
}

$query = $db->prepare("DELETE FROM custom_cmds WHERE guildid = ? AND name = ?");
$query->bind_param("ss", $GuildId, $cmd_name);
$query->execute();

$query = $db->prepare("INSERT INTO requests (requesttype, relevantguild) VALUES(4, ?)");
$query->bind_param("s", $GuildId);
$query->execute();

$site = new PanelTemplate("Command Management");

$content = <<<HTML


    <h1 class="title">Rosettes</h1>
    <p class="headingMd"><b>Command deleted.</b></p>
    <hr />
    <p>Custom command removed.</p>
    <a href="browse_cmds?guild={$GuildId}"><button type="button" class='button' style='width: 10rem; margin: 10px'>Return</button></a>


HTML;

$site->render($content);