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
$commands = $result->fetch_all(MYSQLI_ASSOC);


$query = $db->prepare("SELECT * FROM requests WHERE requesttype = 4 AND relevantguild = ?");
$query->bind_param("s", $GuildId);
$query->execute();
$result = $query->get_result();
$queued_cmds = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_GET['success'])) {
    $message = "<p style='color: lightgreen'>Changes applied.</p>";
}
else if (isset($_GET['error'])) {
    $message = "<p style='color: lightred'>Something went wrong.</p>";
} else {
    $message = '';
}

$cmd_state = "";

if (count($commands) == 0)
    $cmd_state = "<p>You do not have any custom commands in this guild.</p>";
else {
    $cmd_state = "<p>There are currently {count($commands)} custom command/s in this guild.</p>
                <a href='browse_cmds?guild={$GuildId}'><button type='button' class='button' style='width: 15rem; margin: 10px'>Browse existing Commands</button></a><br/>";
}

$site = new PanelTemplate("Commands");

$content = /** @lang HTML */
<<<EOD
    
    
    <h1 class="title">Rosettes</h1>
    <p class="headingMd">Custom commands for: {$guild_info['namecache']}</p>
    <hr />
    {$message}
    <p class="headingMd"><b>Custom commands</b></p>
    <div class='headingContainer'>
        
        {$cmd_state}
        <a href="new_cmd?guild={$GuildId}"><button type="button" class='button' style='width: 13rem; margin: 10px'>Create new command</button></a>

    </div>
    <a href="panel"><button type="button" class='button' style='width: 12rem; margin: 10px'>Return</button></a>
			
			
EOD;

$site->render($content);