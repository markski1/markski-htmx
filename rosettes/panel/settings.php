<?php
    // Yet-unupgraded due to complexity
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
	$music_commands = $guild_info['settings'][1];
	$random_commands = $guild_info['settings'][2];
	$vc_monitor = $guild_info['settings'][5];
	$farm_commands = $guild_info['settings'][4];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rosettes - Settings</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<center>
			<h1 class="title">Rosettes</h1>
			<p class="headingMd">Guild: <?=$guild_info['namecache']?></p>
			<hr />
			<p class="headingMd"><b>Settings</b></p>
			<form method="POST" action="update_guild.php">
				<div class='headingContainer'>
					<p>Message parsing*<br/>
					<select class="input" name="message_processing">
						<option <?php if ($message_processing == 0) echo 'selected'; ?> value="0">Disabled</option>
						<option <?php if ($message_processing >= 1) echo 'selected'; ?> value="1">Enabled</option>
					</select></p>
					<p>Allow music commands<br/>
					<select class="input" name="music_commands">
						<option <?php if ($music_commands == 0) echo 'selected'; ?> value="0">Disabled</option>
						<option <?php if ($music_commands == 1) echo 'selected'; ?> value="1">Enabled</option>
					</select></p>
					<p>Allow random commands<br/>
					<select class="input" name="random_commands">
						<option <?php if ($random_commands == 0) echo 'selected'; ?> value="0">Disabled</option>
						<option <?php if ($random_commands == 1) echo 'selected'; ?> value="1">Enabled</option>
					</select></p>
					<p>Allow Farming/Fishing commands<br/>
					<select class="input" name="farm_commands">
						<option <?php if ($farm_commands == 0) echo 'selected'; ?> value="0">Disabled</option>
						<option <?php if ($farm_commands == 1) echo 'selected'; ?> value="1">Enabled</option>
					</select></p>
					<p>Monitor for voicechat joins and leaves<br/>
					<select class="input" name="vc_monitor">
						<option <?php if ($vc_monitor == 0) echo 'selected'; ?> value="0">Disabled</option>
						<option <?php if ($vc_monitor == 1) echo 'selected'; ?> value="1">Enabled</option>
					</select></p>
				</div>
				<input type="text" hidden value="<?=$GuildId?>" name="guild"/>
				<input type="submit" class="button" style="width: 10rem" value="Update settings" />
				<a href="panel"><button type="button" class='button' style='width: 12rem; margin: 10px'>Return</button></a>
				<?php
					if (isset($_GET['success'])) {
						echo "<p style='color: lightgreen'>Changes applied.</p>";
					}
					else if (isset($_GET['error'])) {
						echo "<p style='color: lightred'>Something went wrong.</p>";
					}
				?>
			</form>
			<p>Danger zone</p>
			<a href="nuke?guild=<?=$GuildId?>"><button class='button' style='width: 12rem; margin: 10px'>Forget this guild</button></a>
		</center>
			<p><small>* Message parsing means wether or not messages will be scanned for stuff like Steam or expiring links, to which Rosettes has replies to.<br/>
				In any case, messages are never logged, and their content is trashed after parsing.
			</small></p>
			
	</div>
</body>
</html>