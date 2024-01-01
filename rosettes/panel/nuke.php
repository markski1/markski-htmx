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
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rosettes - Nuke Guild</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<center>
			<h1 class="title">Rosettes</h1>
			<p class="headingMd"><b>Forget This Guild</b></p>
		</center>
			<hr />
			<p>You are about to make Rosettes forget about "<?=$guild_info['namecache']?>".<br/>Stats and settings will be lost.</p>
			<p>There are only two reasons to do this:</p>
			<ul>
				<li>
					<p>If you want to reset it's knoweldge about your guild.<br/>
					<small>Proceed, Rosettes will forget everything about the guild (settings included), but it'll show up again here after a few minutes.</small></p>
				</li>
				<li>
					<p>If you want Rosettes to no longer be in your guild.<br/>
					<small>Kick Rosettes out of your guild first, then proceed.</small></p>
				</li>
			</ul>
		<center>
			<p>Very well, then:</p>
			<p>
				<a href="nuke_it?guild=<?=$GuildId?>"><button class='button' style='width: 14rem; margin: 10px'>Yes, forget this guild</button></a>
				<a href="settings?guild=<?=$GuildId?>"><button class='button' style='width: 12rem; margin: 10px'>No, go back</button></a>
			</p>
		</center>
	</div>
</body>
</html>