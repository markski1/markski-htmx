<?php
	if (isset($_COOKIE['rosettes_key']) && $_COOKIE['rosettes_key'] != "_"){
		Header('Location: panel');
		exit;
	}

	if (isset($_GET['error'])) {
        $error = match ($_GET['error']) {
            1 => "The entered key is invalid.",
            2 => "The entered key is not associated to any discord account.",
            3 => "Your session has been forcibly closed. Your Rosettes key might've changed.",
            default => "An error has ocurred.",
        };
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rosettes - Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<center>
			<h1 class="title">Rosettes</h1>
			<p class="headingMd">Web panel login</p>
			<hr />
			<form method="POST" action="action/login.php">
				<input class="input" style="width: 50%;" name="rosettes_key" placeholder="Rosettes ID key" />
				<button class="button" style="width: 25%" type="submit">Login</button>
			</form>
			<p>
				<?php
					if (isset($_GET['error'])) echo $error;
					else echo '<p>To obtain your Rosettes ID key, send a private message to Rosettes in discord with the command <span class="money">/keygen</span>.</p>';
				?>
			</p>
		</center>
	</div>
</body>
</html>