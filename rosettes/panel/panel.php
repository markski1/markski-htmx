<?php
include_once("funcs.php");
$db = db_connect();

if (!CheckSession($db, $namecache, $id)) {
    Header('Location: index');
    exit;
}

// Obtain the guilds Rosettes is in which are owned by the user, if any.

$query = $db->prepare("SELECT id, namecache FROM guilds WHERE ownerid = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$guilds = $result->fetch_all(MYSQLI_ASSOC);


if (count($guilds) == 0) {
    $guild_list = "<p>Rosettes doesn't yet know of any guild owned by you.</p>";
}
else {
    $guild_list = "";
    foreach ($guilds as $guild) {
        $guild_list .= "<div class='headingContainer'>";
        $guild_list .= "<p class='headingMd'><b>".$guild['namecache']."</b></p>";
        $guild_list .= "<a href='settings?guild=".$guild['id']."'><button class='button' style='width: 8rem; margin: 10px'>Settings</button></a><a href='roles?guild=".$guild['id']."'><button class='button' style='width: 8rem; margin: 10px'>Roles</button></a><a href='commands?guild=".$guild['id']."'><button class='button' style='width: 8rem; margin: 10px'>Commands</button></a>";
        $guild_list .= "</div>";
    }
}


$site = new PanelTemplate("Panel");

$content = <<<HTML
    <h1 class="title">Rosettes</h1>
    <p class="headingMd">Hello, <?=$namecache?></p>
    <hr />
    <h3>Your guilds</h3>
    {$guild_list}
    <p>Rosettes is a work in progress.<br/>If you need help, or find a bug/error either on the web panel or the bot itself, don't hesitate to contact me through any of the methods listed <a href="https://markski.ar">here</a>.<br/>&nbsp;</p>
    <p>
    <a href="action/logout.php"><button class='button' style='width: 8rem; margin: 10px'>Log out</button></a></p>


HTML;

$site->render($content);