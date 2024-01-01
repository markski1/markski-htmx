<?php

include '.env.php';

function db_connect(): mysqli
{
    get_db_auth($db_host, $db_user, $db_password, $db_name);

    $mysqli = mysqli_init();
    if ($mysqli->real_connect($db_host, $db_user, $db_password, $db_name))
        return $mysqli;
    else
        exit("Cannot connect to database.");
}


function CheckSession($db, &$namecache, &$id): bool
{
	if (isset($_COOKIE['rosettes_key']) && ctype_alnum($_COOKIE['rosettes_key'])) {
		$tempSession = htmlspecialchars($_COOKIE['rosettes_key']);
		$query = $db->prepare("SELECT login_keys.*, users.namecache FROM login_keys INNER JOIN users ON login_keys.id = users.id WHERE BINARY login_key = ?");
        $query->bind_param("s", $tempSession);
        $query->execute();
        $result = $query->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);

		if (count($result) == 1) {
			$id = $result[0]['id'];
			$namecache = $result[0]['namecache'];
			return true;
		}
	}
	setcookie("rosettes_key", "_", time() - 3600, "/");
	unset($_COOKIE['rosettes_key']);
	return false;
}

function GetGuildInfo($db, $GuildId) {
    $query = $db->prepare("SELECT * FROM guilds WHERE id = ?");
    $query->bind_param("s", $GuildId);
    $query->execute();
    $result = $query->get_result();
    $result = $result->fetch_all(MYSQLI_ASSOC);

    if (count($result) != 1) {
        Header('Location: panel');
        exit;
    }

    return $result[0];
}

function UserOwnsGuild($db, $GuildId, $id) {
    $query = $db->prepare("SELECT * FROM guilds WHERE id = ? AND ownerid = ?");
    $query->bind_param("ss", $GuildId, $id);
    $query->execute();
    $result = $query->get_result();
    $result = $result->fetch_all(MYSQLI_ASSOC);

    if (count($result) == 0) return false;
    return true;
}


class PanelTemplate
{
    private string $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    function render($content)
    {
        $sitelink_pattern = '/<sitelink to="([^"]*)">([^<]+)<\/sitelink>/';

        $content = preg_replace_callback(
            $sitelink_pattern,
            function ($matches) {
                $destination_url = $matches[1];
                $destination_text = $matches[2];

                return "<a href='../{$destination_url}' hx-get='../{$destination_url}' hx-push-url='true' hx-target='main'>{$destination_text}</a>";
            },
            $content
        );

        if (isset($_SERVER['HTTP_HX_REQUEST'])) {
            echo $content;
            echo "<script>
                      document.title = 'Rosettes - {$this->title}';
                  </script>";
            exit;
        }

        $site = @file_get_contents("deps/panel_layout.html");

        if (!$site) $site = @file_get_contents("../template/layout.html");

        // insert title and content into the template
        $site = str_replace("<!-- %%% SITE_TITLE %%% -->", $this->title, $site);
        $site = str_replace("<!-- %%% SITE_CONTENT %%% -->", $content, $site);

        echo $site;
    }
}