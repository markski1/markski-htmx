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

	$query = $db->prepare("SELECT * FROM custom_cmds WHERE guildid = ?");
    $query->bind_param("s", $GuildId);
    $query->execute();
    $result = $query->get_result();
	$customCmds = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rosettes - Command Management</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<center>
			<h1 class="title">Rosettes</h1>
			<p class="headingMd">Listing existing commands for: <?=$guild_info['namecache']?></p>
			<hr />
			<p class="headingMd"><b>Commands</b></p>
			<?php
				if (count($customCmds) == 0) {
					echo "<p>There are no custom commands registered in this guild.</p>";
				}
				else {
					foreach ($customCmds as $cmd) {
						echo "<div class='headingContainer' style='padding: 10px'>";
						echo "<p class='headingMd'><b>/".$cmd['name']."</b></br>";
						echo "".$cmd['description']."</p>";
						echo "<a href='delete_cmd?guild=$GuildId&name=".$cmd['name']."'><button class='button' style='width: 8rem; margin: 10px'>Delete</button></a>";
						echo "</div>";
					}
				}
			?>
			<a href="commands?guild=<?=$GuildId?>"><button type="button" class='button' style='width: 10rem; margin: 10px'>Return</button></a>
		</center>
	</div>
</body>
</html>