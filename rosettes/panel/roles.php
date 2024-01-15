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

$guild_info = GetGuildInfo($db, $GuildId);

$query = $db->prepare("SELECT * FROM roles WHERE guildid = ?");
$query->bind_param("s", $GuildId);
$query->execute();
$result = $query->get_result();
$roles = $result->fetch_all(MYSQLI_ASSOC);

$query = $db->prepare("SELECT id FROM autorole_groups WHERE guildid = ?");
$query->bind_param("s", $GuildId);
$query->execute();
$result = $query->get_result();
$rolegroups = $result->fetch_all(MYSQLI_ASSOC);

$query = $db->prepare("SELECT * FROM requests WHERE requesttype=0 AND relevantguild = ?");
$query->bind_param("s", $GuildId);
$query->execute();
$result = $query->get_result();
$queued_roles = $result->fetch_all(MYSQLI_ASSOC);

$default_select =  match ($guild_info['defaultrole']) {
    1 => "selected",
    default => ""
};

$default_choices = "";

foreach ($roles as $role) {
    $color = $role["color"];
    // color-less roles default to #000000, this is unreadable
    if ($color == "#000000") {
        $color = "white";
    }
    $selected = "";
    if ($guild_info['defaultrole'] == $role["id"]) {
        $selected = "selected";
    }
    $default_choices .= '<option '.$selected.' value="'.$role["id"].'" style="background-color:'.$color.'">'.$role["rolename"].'</option>';
}

$role_choices = "";
foreach ($roles as $role) {
    $color = $role["color"];
    // color-less roles default to #000000, this is unreadable
    if ($color == "#000000") {
        $color = "white";
    }
    $role_choices .= '<option value="'.$role["id"].'" style="background-color:'.$color.'">'.$role["rolename"].'</option>';
}

$queued_role_list = "";

if (count($queued_roles) > 0) {
    $queued_role_list .= '<hr style="margin-top: 1.5rem;" />';
    $queued_role_list .= '<p>These roles are queued and will soon be assigned to everyone in the guild:</p>';
    foreach ($queued_roles as $role) {
        foreach ($roles as $seekRole) {
            if ($role['relevantvalue'] == $seekRole['id']) {
                $foundRole = $seekRole;
                break;
            }
        }
        if (isset($foundRole)) {
            $queued_role_list .= '<span style="color: '.$foundRole['color'].'">'.$foundRole['rolename'].'</span><br/>';
        }
    }
}

if (isset($_GET['success'])) {
    $action_message = "<p style='color: lightgreen'>Changes applied.</p>";
}
else if (isset($_GET['error'])) {
    $action_message = "<p style='color: lightred'>Something went wrong.</p>";
}
else {
    $action_message = "";
}

if (count($rolegroups) == 0) {
    $autoroles_msg = "<p>You do not have any AutoRoles set up for your guild.</p>";
} else {
    $rolecount = count($rolegroups);
    $autoroles_msg = "<p>There are currently {$rolecount} AutoRoles set up in this guild.</p>
                      <a href='browse_autoroles?guild={$GuildId}'><button type='button' class='button' style='width: 15rem; margin: 10px'>Browse existing AutoRoles</button></a><br/>";
}


$site = new PanelTemplate("Role Management");

$content = <<<HTML
    
    
    <h1 class="title">Rosettes</h1>
    <p class="headingMd">Role management for: {$guild_info['namecache']}</p>
    <hr />
    {$action_message}

    <p class="headingMd"><b>Join Role</b></p>
    <div class='headingContainer'>
        <form method="POST" action="set_default_role.php">
            <p>When a user joins, automatically give them the role:</p>
            <select class="input" name="default_role">
                <option {$default_select} value="0">None</option>
                {$default_choices}
            </select>
            <input type="text" hidden value="{$GuildId}" name="guild"/>
            <input type="submit" class="button" style="width: 10rem" value="Apply" />
        </form>
    </div>
    <p class="headingMd"><b>Assign Global Role</b></p>
    <div class='headingContainer'>
        <form method="POST" action="set_roles_everyone.php">
            <p>Give the following role to every single user currently in the guild</p>
            <select class="input" name="role_set">
                <option selected value="0">None</option>
                {$role_choices}
            </select>
            <input type="text" hidden value="{$GuildId}" name="guild"/>
            <input type="submit" class="button" style="width: 10rem" value="Do it" />
            {$queued_role_list}
        </form>
    </div>
    <p class="headingMd"><b>AutoRoles</b></p>
    <div class='headingContainer'>
        <p>AutoRoles let your users self-assign roles by reacting to a message.</p>
            
        {$autoroles_msg}

        <a href="new_autorole?guild={$GuildId}"><button type="button" class='button' style='width: 13rem; margin: 10px'>Create new AutoRole</button></a>
    </div>

    <a href="panel"><button type="button" class='button' style='width: 12rem; margin: 10px'>Return</button></a>


HTML;

$site->render($content);