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

$role_list = "";
foreach ($roles as $role) {
    $color = $role["color"];
    // color-less roles default to #000000, this is unreadable
    if ($color == "#000000") {
        $color = "white";
    }
    $role_list .= '<option value="'.$role["id"].'" style="background-color:'.$color.'">'.$role["rolename"].'</option>';
}


$site = new PanelTemplate("Command Management");

$content = <<<HTML


    <h1 class="title">Rosettes</h1>
    <p class="headingMd">Creating new custom command for: {$guild_info['namecache']}</p>
    <hr />
    <form method="POST" action="create_cmd.php">

        <p>
            <label for="name">Command</label><br/>
            <big>/ </big><input id="name" type="text" class="input" name="name" /><br/>
        </p>

        <p>
            <label for="name">Description</label><br/>
            <input id="description" type="text" class="input" name="description" /><br/>
        </p>

        <p>
            <label for="cmd_type">Type of command</label><br/>
            <select onchange="selectType()" class="input" name="cmd_type" id="cmd_type">
                <option selected value="0">Send message</option>
                <option value="1">Assign role</option>
            </select>
        </p>
        
        <div id="roleSelect" style="display: none">
            <p>"Assign role" commands will toggle the specified role when used.</p>
            <label for="role">Role to apply</label><br/>
            <select class="input" name="role_selector" id="role_selector">
                <option selected value="0">Select Role</option>
                {$role_list}
            </select>
        </div>
        
        <div id="messageEnter" style="display: block">
            <p>"Send message" commands will display the specified text when used.</p>
            <label for="message">Message to send</label]><br/>
            <textarea id="message" type="text" class="input" name="message" style="width:30rem;height:10rem">Hello, you have used a custom command.</textarea><br/>
        </div>

        <p>
            <label for="ephemeral">Ephemeral?</label>
            <input type="checkbox" name="ephemeral" style="width: 1.5rem; height: 1.5rem" id="ephemeral" />
            <br/><small>Ephemeral means the message will only be seen by the command user. If left unchecked, everyone will be able to see an user used this command.</small>
        </p>

        <input type="text" hidden value="{$GuildId}" name="guild"/>

        <button type="submit" class='button' style='width: 14rem; margin-top: 10px'>Create command</button>
    </form>
    <a href="commands?guild={$GuildId}"><button type="button" class='button' style='width: 14rem; margin: 10px'>Return</button></a>


    <script type="text/javascript">
        function selectType() {
            var checkType = document.getElementById("cmd_type").value;
        
            console.log(checkType);
        
            if (checkType == 0) {
                document.getElementById("roleSelect").style.display = "none";
                document.getElementById("messageEnter").style.display = "block";
            }
        
            if (checkType == 1) {
                document.getElementById("messageEnter").style.display = "none";
                document.getElementById("roleSelect").style.display = "block";
            }
        }
    </script>


HTML;

$site->render($content);