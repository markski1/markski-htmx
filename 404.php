<?php
include 'template/engine.php';

$site = new Template("404");
$site->set_description("site not found.");

$content = /** @lang HTML */
    <<<EOD


    <h3>four. oh. four.</h3>
    <p>i don't have whatever it is you want.</a>
    </ul>

    
EOD;

$site->render($content);