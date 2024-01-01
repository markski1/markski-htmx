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

if (!ctype_alnum($_GET['guild'])) {
    Header('Location: panel');
    exit;
}

if (!is_numeric($_GET['id'])) {
    Header('Location: panel');
    exit;
}

$group_id = $_GET['id'];

$GuildId = $_GET['guild'];

// if user doesn't own the guild, quietly fail.
if (!UserOwnsGuild($db, $GuildId, $id)) {
    Header('Location: panel');
    exit;
}

$query = "SELECT guildid FROM autorole_groups WHERE id = ? AND guildid = ? LIMIT 1";
$query->bind_param("ss", $group_id, $GuildId);
$query->execute();
$result = $query->get_result();
$result = $result->fetch_all(MYSQLI_ASSOC);

if (count($result) == 0) {
    Header('Location: panel');
    exit;
}

$query = $db->prepare("DELETE FROM autorole_groups WHERE id = ?");
$query->bind_param("s", $group_id);
$query->execute();

$site = new PanelTemplate("Role Management");

$content = /** @lang HTML */
<<<EOD


    <h1 class="title">Rosettes</h1>
    <p class="headingMd"><b>AutoRole deleted.</b></p>
    <hr />
    <p>Please be sure to delete it's message in Discord, if applicable.</p>
    <a href="browse_autoroles?guild={$GuildId}"><button type="button" class='button' style='width: 10rem; margin: 10px'>Return</button></a>


EOD;

$site->render($content);