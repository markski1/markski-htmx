<?php
	include_once("funcs.php");
	$db = db_connect();

	if (!CheckSession($db, $namecache, $id)) {
		Header('Location: index');
		exit;
	}

	// Obtain the guilds Rosettes is in which are owned by the user, if any.

	$query = $db->prepare("SELECT id, namecache FROM guilds WHERE ownerid = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
	$guilds = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rosettes - Panel</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<center>
			<h1 class="title">Rosettes</h1>
			<p class="headingMd">Hello, <?=$namecache?></p>
			<hr />
			<h3>Your guilds</h3>
			<?php
				if (count($guilds) == 0) {
					echo "<p>Rosettes doesn't yet know of any guild owned by you.</p>";
				}
				else {
					foreach ($guilds as $guild) {
						echo "<div class='headingContainer'>";
						echo "<p class='headingMd'><b>".$guild['namecache']."</b></p>";
						echo "<a href='settings?guild=".$guild['id']."'><button class='button' style='width: 8rem; margin: 10px'>Settings</button></a><a href='roles?guild=".$guild['id']."'><button class='button' style='width: 8rem; margin: 10px'>Roles</button></a><a href='commands?guild=".$guild['id']."'><button class='button' style='width: 8rem; margin: 10px'>Commands</button></a>";
						echo "</div>";
					}
				}
			?>
			<p>Rosettes is a work in progress.<br/>If you need help, or find a bug/error either on the web panel or the bot itself, don't hesitate to contact me through any of the methods listed <a href="https://markski.ar">here</a>.<br/>&nbsp;</p>
			<p>
			<a href="action/logout.php"><button class='button' style='width: 8rem; margin: 10px'>Log out</button></a></p>
		</center>
	</div>
</body>
</html>