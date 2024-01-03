<?php
// Due to it's complexity this page is yet to be moved to the new templating thing.
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

$script_role_list = "";
$last = array_pop($roles);
array_push($roles, $last);
foreach ($roles as $role) {
    $script_role_list .= '{roleName:"'.$role["rolename"].'", roleId:"'.$role["id"].'"}';
    if ($role != $last) $script_role_list .= ',';
}

$site = new PanelTemplate("Role Management");

$content = /** @lang HTML */
    <<<EOD


    <h1 class="title">Rosettes</h1>
    <p class="headingMd">Creating new AutoRole for: {$guild_info['namecache']}</p>
    <hr />
    <p class="headingMd"><b>AutoRole Maker</b></p>
    <p>Select emoji and role, then add.</p>
    <button type="button" id="select-emoji" class='button' style='width: 10rem;margin: 10px'>Select Emoji</button>
    <select onchange="selectRole()" class="input" id="role_selector">
        <option selected value="0">Select Role</option>
        {$role_list}
    </select>
    <p>When user clicks <span id="emoji_preview">__</span> they get "<b><span id="role_preview">______</span>"</b>
    <button type="button" class='button' style='width: 5rem;margin: 10px' onclick="addSelection()">Add</button></p>
    <div id="RoleEmojiListContainer">
        <hr style="margin-top: 30px;"/>
        <p><big>AutoRole entries:</big><p>
        <span id="RoleEmojiList">

        </span>
        <p><small>You have <span id="SlotLeftCount">15</span> slots left.</small></p>
    </div>
    <form method="POST" action="create_autoroles.php" id="ConfirmAutoRoles" style="display: none" onsubmit="return CheckRoleForm()">
        <hr />
        <input type="text" hidden value="{$GuildId}" name="guild"/>
        <div id="DynamicForm" style="display: none">
        </div>
        <p>Enter a name<br/>
        <small>Example: Colors, Notifications, Interests, etc.<br/>Only letters, numbers, exclamation/question and punctuation symbols allowed.</small></p>
        <input type="text" class="input" name="name" /><br/>
        <button type="submit" class='button' style='width: 14rem; margin-top: 10px'>Create new AutoRole</button>
    </form>
    <a href="roles?guild={$GuildId}"><button type="button" class='button' style='width: 10rem; margin: 10px'>Return</button></a>
	
    <script type="text/javascript" src="js/fgEmojiPicker.js"></script>
    <script type="text/javascript">
        
        new FgEmojiPicker({
            trigger: ['#select-emoji'],
            postion: ['bottom'],
            emit(obj, triggerElement) {
                const emoji = obj.emoji;
                selectEmoji(emoji);
            }
        });
        
        
        var selectedEmoji = "__";
        var selectedRoleId = 0;
        var selectedRoleName = "______";
        
        const ListAddedRoles = [];
        
        const maxEntries = 15;
        var count = 0;
        
        const ListRoles = [
            {$script_role_list}
        ];
        
        function selectEmoji(emoji) {
            document.getElementById("emoji_preview").innerHTML = emoji;
            selectedEmoji = emoji;
        }
        
        function selectRole() {
            var checkRole = document.getElementById("role_selector").value;
            if (checkRole == 0) return;
        
            ListRoles.forEach(setSelectedRole)
        }
        
        function setSelectedRole(item, index) {
            var checkRole = document.getElementById("role_selector").value;
            if (checkRole == item.roleId) {
                selectedRoleId = item.roleId;
                selectedRoleName = item.roleName;
                document.getElementById("role_preview").innerHTML = item.roleName;
            }
        }
        
        function addSelection() {
            if (selectedEmoji == "__") {
                alert("You must select a valid emoji.");
                return 0;
            }
            if (selectedRoleId == 0) {
                alert("You must select a valid role.");
                return 0;
            }
            if (count == maxEntries) {
                alert("Sorry, you cannot add more than " + maxEntries + " role selections to AutoRoles.");
                return 0;
            }
            ListAddedRoles.push({roleName: selectedRoleName, roleId: selectedRoleId, roleEmoji: selectedEmoji});
            selectedEmoji = "__";
            selectedRoleId = 0;
            selectedRoleName = "______";
            document.getElementById("role_preview").innerHTML = selectedRoleName;
            document.getElementById("emoji_preview").innerHTML = selectedEmoji;
            document.getElementById("role_selector").value = 0;
            document.getElementById("RoleEmojiList").innerHTML = "";
            document.getElementById("ConfirmAutoRoles").style.display = "block";
            document.getElementById("DynamicForm").innerHTML = "";
        
            count++;
            document.getElementById("SlotLeftCount").innerHTML = maxEntries - count;
        
            ListAddedRoles.forEach(printRoleEntry);
        }
        
        function printRoleEntry(item, index) {
            document.getElementById("RoleEmojiList").innerHTML += "<p>When user clicks " + item.roleEmoji + " they get \"<b>" + item.roleName + "</b>\".</p>";
            var form1 = document.createElement("input");
            form1.type = "text";
            form1.name = "roleEntry[" + index + "][emoji]";
            form1.value = item.roleEmoji;
            var form2 = document.createElement("input");
            form2.type = "text";
            form2.name = "roleEntry[" + index + "][roleid]";
            form2.value = item.roleId;
            document.getElementById("DynamicForm").appendChild(form1);
            document.getElementById("DynamicForm").appendChild(form2);
        }
        
        function CheckRoleForm() {
            if (count == 0) {
                alert("You've not added any roles!");
                return false;
            }
            if (count > maxEntries) {
                alert("SUS! You've more roles than the panel should allow!!!");
                return false;
            }
            return true;
        }
        
    </script>


EOD;

$site->render($content);