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

	$query = $db->prepare("SELECT * FROM autorole_groups WHERE guildid = ?");
    $query->bind_param("s", $GuildId);
    $query->execute();
    $result = $query->get_result();
	$roleGroups = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rosettes - Role Management</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<center>
			<h1 class="title">Rosettes</h1>
			<p class="headingMd">Listing existing AutoRoles for: <?=$guild_info['namecache']?></p>
			<hr />
			<p class="headingMd"><b>AutoRoles</b></p>
			<?php
				if (count($roleGroups) == 0) {
					echo "<p>There are no AutoRoles registered in this guild.</p>";
				}
				else {
					foreach ($roleGroups as $rolegr) {
						echo "<div class='headingContainer' style='padding: 10px'>";
						echo "<p class='headingMd'><b>".$rolegr['name']."</b></p>";
						echo "<p>To place this AutoRole in a channel, you may use \"<b>/setautorole ".$rolegr['id']."</b>\".<br/>Only one instance will work, so if you place it again, delete the old one.</p>";
						echo "<a href='delete_autorole?guild=$GuildId&id=".$rolegr['id']."'><button class='button' style='width: 8rem; margin: 10px'>Delete</button></a>";
						echo "</div>";
					}
				}
			?>
			<a href="roles?guild=<?=$GuildId?>"><button type="button" class='button' style='width: 10rem; margin: 10px'>Return</button></a>
		</center>
	</div>
</body>
</html>