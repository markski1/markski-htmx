<?php
include_once("funcs.php");
$db = db_connect();

if (!CheckSession($db, $namecache, $id)) {
    Header('Location: index');
    exit;
}

$GuildId = $_GET['guild'] ?? -1;
$guild_info = GetGuildInfo($db, $GuildId);

$query = $db->prepare("SELECT * FROM autorole_groups WHERE guildid = ?");
$query->bind_param("s", $GuildId);
$query->execute();
$result = $query->get_result();
$roleGroups = $result->fetch_all(MYSQLI_ASSOC);

if (count($roleGroups) == 0) {
    $role_list = "<p>There are no AutoRoles registered in this guild.</p>";
}
else {
    $role_list = "";
    foreach ($roleGroups as $rolegr) {
        $role_list .= "<div class='headingContainer' style='padding: 10px'>";
        $role_list .= "<p class='headingMd'><b>".$rolegr['name']."</b></p>";
        $role_list .= "<p>To place this AutoRole in a channel, you may use \"<b>/setautorole ".$rolegr['id']."</b>\".<br/>Only one instance will work, so if you place it again, delete the old one.</p>";
        $role_list .= "<a href='delete_autorole?guild=$GuildId&id=".$rolegr['id']."'><button class='button' style='width: 8rem; margin: 10px'>Delete</button></a>";
        $role_list .= "</div>";
    }
}

$site = new PanelTemplate("Browsing Autoroles");

$content = <<<HTML


    <h1 class="title">Rosettes</h1>
    <p class="headingMd">Listing existing AutoRoles for: {$guild_info['namecache']}</p>
    <hr />
    <p class="headingMd"><b>AutoRoles</b></p>
    {$role_list}
    <a href="roles?guild={$GuildId}"><button type="button" class='button' style='width: 10rem; margin: 10px'>Return</button></a>


HTML;

$site->render($content);