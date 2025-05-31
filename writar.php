<?php
include 'template/engine.php';

$site = new Template("Writar");
$site->set_description("Free, open source and public document sharing.");

$content = /** @lang HTML */
    <<<HTML


    <h3>Writar</h3>
    <hr>
    <div>
        <h4>About</h4>
        <p>Free, open source and public document sharing. write documents with markdown, share them immediatly.</p>
        <p>Largely abandoned but kept online since it costs nothing.</p>
        <p>Written in php and htmx.</p>
        <p><a href="https://writar.markski.ar">Visit Writar</a></p>
        <p><a href="https://github.com/markski1/writar">View on GitHub</a></p>
    </div>

    
HTML;

$site->render($content);