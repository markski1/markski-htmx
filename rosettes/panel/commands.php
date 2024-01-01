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
	$commands = $result->fetch_all(MYSQLI_ASSOC);


	$query = $db->prepare("SELECT * FROM requests WHERE requesttype = 4 AND relevantguild = ?");
    $query->bind_param("s", $GuildId);
    $query->execute();
    $result = $query->get_result();
	$queued_cmds = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rosettes - Custom Commands</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<center>
			<h1 class="title">Rosettes</h1>
			<p class="headingMd">Custom commands for: <?=$guild_info['namecache']?></p>
			<hr />
			<?php
				if (isset($_GET['success'])) {
					echo "<p style='color: lightgreen'>Changes applied.</p>";
				}
				else if (isset($_GET['error'])) {
					echo "<p style='color: lightred'>Something went wrong.</p>";
				}
			?>

			
			<p class="headingMd"><b>Custom commands</b></p>
			<div class='headingContainer'>
				
					<?php if (count($commands) == 0) {?>

						<p>You do not have any custom commands in this guild.</p>

					<?php } else { ?>

						<p>There are currently <?=count($commands)?> custom command/s in this guild.</p>
						<a href="browse_cmds?guild=<?=$GuildId?>"><button type="button" class='button' style='width: 15rem; margin: 10px'>Browse existing Commands</button></a><br/>
					
					<?php }?>

					<a href="new_cmd?guild=<?=$GuildId?>"><button type="button" class='button' style='width: 13rem; margin: 10px'>Create new command</button></a>

			</div>

			<a href="panel"><button type="button" class='button' style='width: 12rem; margin: 10px'>Return</button></a>
			
			
		</center>
			
	</div>
</body>
</html>