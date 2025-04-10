<?php
include 'template/engine.php';

$site = new Template("Home");
$site->set_description("Markski's personal website.");

$content = <<<HTML


    <h3>About</h3>
    <hr>
    <p>Software developer from La Plata, Argentina. CompSci student.</p>
    <small>Latest blog post: <sitelink to="blog/bsxu-b2-hosting">Self-hosting with BSXU</sitelink></small>
    <h3>Areas of work:</h3>
    <ul>
        <li>Backend development</li>
        <li>Server administration</li>
        <li>Database administration</li>
        <li>Performance analysis</li>
        <li>System design</li>
        <li>Automation</li>
    </ul>


    <h3>Find me:</h3>
    <ul>
        <li>Github: <a target="_blank" href="https://github.com/markski1">@markski1</a></li>
        <li>Telegram: <a target="_blank" href="https://telegram.me/markski">@markski</a></li>
        <li>Discord: <a href="discord://markski.ar">@markski.ar</a></li>
        <li>Email: <a href="mailto:me@markski.ar">me@markski.ar</a>
    </ul>

    
HTML;

$site->render($content);