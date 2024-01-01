<?php
include_once("funcs.php");
$db = db_connect();

if (!CheckSession($db, $namecache, $id)) {
    Header('Location: index');
    exit;
}

$GuildId = $_GET['guild'] ?? -1;
$guild_info = GetGuildInfo($db, $GuildId);

$query = $db->prepare("SELECT * FROM custom_cmds WHERE guildid = ?");
$query->bind_param("s", $GuildId);
$query->execute();
$result = $query->get_result();
$customCmds = $result->fetch_all(MYSQLI_ASSOC);


if (count($customCmds) == 0) {
    $cmd_list = "<p>There are no custom commands registered in this guild.</p>";
}
else {
    $cmd_list = "";
    foreach ($customCmds as $cmd) {
        $cmd_list .= "<div class='headingContainer' style='padding: 10px'>";
        $cmd_list .= "<p class='headingMd'><b>/".$cmd['name']."</b></br>";
        $cmd_list .= "".$cmd['description']."</p>";
        $cmd_list .= "<a href='delete_cmd?guild=$GuildId&name=".$cmd['name']."'><button class='button' style='width: 8rem; margin: 10px'>Delete</button></a>";
        $cmd_list .= "</div>";
    }
}


$site = new PanelTemplate("Browsing Commands");

$content = /** @lang HTML */
<<<EOD
      
      
    <h1 class="title">Rosettes</h1>
    <p class="headingMd">Listing existing commands for: {$guild_info['namecache']}</p>
    <hr />
    <p class="headingMd"><b>Commands</b></p>
    {$cmd_list}
    <a href="commands?guild={$GuildId}"><button type="button" class='button' style='width: 10rem; margin: 10px'>Return</button></a>


EOD;

$site->render($content);