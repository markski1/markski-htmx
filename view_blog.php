<?php
include 'template/engine.php';
include 'template/parsedown.php';

$path = "./posts/{$_GET['id']}.md";

if (!file_exists($path)) {
    $site = new Template("post not found");
    $site->render("<p>this post doesn't seem to exist!</p>");
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

$site = new Template($title);
$site->set_description($description);

$content = /** @lang HTML */
    <<<EOD


    <h1>{$title}</h1>
    <small style="color: #999999">{$date}</small>
    <hr>
    <div>
        {$Parsedown->text($post_content)}
    </div>

    
EOD;

$site->render($content);