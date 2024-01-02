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

$GuildId = $_GET['guild'];

// Obtain the guild's settings

$guild_info = GetGuildInfo($db, $GuildId);

$message_processing = $guild_info['settings'][0];
$random_commands = $guild_info['settings'][2];
$vcmon = $guild_info['settings'][5];
$minigame_commands = $guild_info['settings'][4];

$select_message_enabled = ($message_processing >= 1) ? 'selected' : '';
$select_random_enabled = ($random_commands >= 1) ? 'selected' : '';
$select_minigame_enabled = ($minigame_commands >= 1) ? 'selected' : '';
$select_vcmon_enabled = ($vcmon >= 1) ? 'selected' : '';

if (isset($_GET['success'])) {
    $message = "<p style='color: lightgreen'>Changes applied.</p>";
}
else if (isset($_GET['error'])) {
    $message = "<p style='color: lightred'>Something went wrong.</p>";
}
else {
    $message = '';
}

$site = new PanelTemplate("Settings");

$content = /** @lang HTML */
<<<EOD
    
    
    <h1 class="title">Rosettes</h1>
    <p class="headingMd">Guild: {$guild_info['namecache']}</p>
    <hr />
    <p class="headingMd"><b>Settings</b></p>
    <form method="POST" action="update_guild.php">
        <div class='headingContainer'>
            <p>Message parsing*<br/>
            <select class="input" name="message_processing">
                <option value="0">Disabled</option>
                <option {$select_message_enabled} value="1">Enabled</option>
            </select></p>
            <p>Allow random commands<br/>
            <select class="input" name="random_commands">
                <option value="0">Disabled</option>
                <option {$select_random_enabled} value="1">Enabled</option>
            </select></p>
            <p>Allow Farming/Fishing commands<br/>
            <select class="input" name="minigame_commands">
                <option value="0">Disabled</option>
                <option {$select_minigame_enabled} value="1">Enabled</option>
            </select></p>
            <p>Monitor for voicechat joins and leaves<br/>
            <select class="input" name="vc_monitor">
                <option value="0">Disabled</option>
                <option {$select_vcmon_enabled} value="1">Enabled</option>
            </select></p>
        </div>
        <input type="text" hidden value="{$GuildId}" name="guild"/>
        <input type="submit" class="button" style="width: 10rem" value="Update settings" />
        <a href="panel"><button type="button" class='button' style='width: 12rem; margin: 10px'>Return</button></a>
        {$message}
    </form>
    <p>Danger zone</p>
    <a href="nuke?guild={$GuildId}"><button class='button' style='width: 12rem; margin: 10px'>Forget this guild</button></a>
    <p><small>* Message parsing means wether or not messages will be scanned for stuff like Steam or expiring links, to which Rosettes has replies to.<br/>
        In any case, messages are never logged, and their content is trashed after parsing.
    </small></p>


EOD;

$site->render($content);