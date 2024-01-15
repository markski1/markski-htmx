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

// if user doesn't own the guild, quietly fail.
if (!UserOwnsGuild($db, $GuildId, $id)) {
    Header('Location: panel');
    exit;
}

$query = $db->prepare("DELETE FROM guilds WHERE id = ?");
$query->bind_param("s", $GuildId);
$success = $query->execute();

if ($success) {
    $message = "Gone, AND forgotten.";
    $after_message = "<p>Rosettes no longer knows about your guild.</p>
            <p>If Rosettes is still in your guild, it'll learn about it again after a few minutes.</p>
            <p>If Rosettes is no longer in your guild, then you're done here.</p>";
}
else {
    $message = "Error.";
    $after_message = "<p>It seems there was an error trying to forget your guild.</p>
            <p>Please return to the panel. If the guild is still there, try again in a while.<br/>
            If it keeps failing, contact me directly and I'll gladly manually remove it. Sorry for the inconvenience.</p>";
}

$site = new PanelTemplate("Guild Nuked");

$content = <<<HTML
    
    
    <h1 class="title">Rosettes</h1>
    <p class="headingMd"><b>{$message}</b></p>
    {message}
    <hr />
    <div style="text-align: left">
        {$after_message}
        <a href="panel"><button class='button' style='width: 10rem; margin: 10px'>Back to panel</button></a>
    </div>


HTML;

$site->render($content);