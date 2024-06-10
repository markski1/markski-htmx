<?php
include 'template/engine.php';

$site = new Template("404");
$site->set_description("Site not found.");

$content = /** @lang HTML */
    <<<HTML


    <h3>Four. Oh. Four.</h3>
    <p>I don't have whatever it is you want.</a>
    </ul>


HTML;

$site->render($content);