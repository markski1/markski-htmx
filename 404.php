<?php
include 'template/engine.php';

$content = <<<EOD

    <h3>four. oh. four.</h3>
    <p>i don't have whatever it is you want.</a>
    </ul>

    
EOD;

render_template("home", $content);