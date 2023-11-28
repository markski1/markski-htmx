<?php
include 'template/engine.php';
include 'template/parsedown.php';

$path = "./posts/{$_GET['id']}.md";

if (!file_exists($path)) {
    // TODO: Actual fix the routing bug which this "fixes".
    echo "<script>window.location.replace('/{$_GET['id']}');</script>";
    exit;
}

$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true);

$linecount = 0;
$post_content = "";

foreach(file($path) as $line) {
    if ($linecount > 5) {
        $post_content .= $line;
        continue;
    }
    if ($linecount == 0) $title = $line;
    if ($linecount == 1) $date = $line;
    if ($linecount == 2) $description = $line;

    $linecount++;
}

if (!isset($title) || !isset($date) || !isset($description)) {
    exit("an error ocurred.");
}

$post_content = $Parsedown->text($post_content);

$content = /** @lang HTML */
    <<<EOD


    <h1>{$title}</h1>
    <small style="color: #999999">{$date}</small>
    <hr>
    <div>
        {$post_content}
    </div>

    
EOD;

$site = new Template($title);
$site->set_description($description);
$site->set_content($content);
$site->render();