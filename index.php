<?php
include 'template/engine.php';

$site = new Template("Home");
$site->set_description("Markski's personal website.");

$content = <<<HTML


    <h3>About</h3>
    <hr>
    <p>Computer science, software development.</p>
    <small>Latest blog post: <sitelink to="blog/blame-vs-accountability">Who's to blame and when does it matter</sitelink></small>
    
    <h4>Work:</h4>
    <ul>
        <li>Backend development</li>
        <li>Database administration</li>
        <li>Performance analysis</li>
        <li>Systems design</li>
    </ul>

    <h4>Talk:</h4>
    <ul>
        <li>Github: <a target="_blank" href="https://github.com/markski1">@markski1</a></li>
        <li>Telegram: <a target="_blank" href="https://telegram.me/markski">@markski</a></li>
        <li>Email: <a href="mailto:me@markski.ar">me@markski.ar</a>
    </ul>

    
HTML;

$site->render($content);