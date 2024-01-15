<?php
include 'template/engine.php';

$site = new Template("writar");
$site->set_description("free, open source and public document sharing.");

$content = /** @lang HTML */
    <<<HTML


    <h3>writar</h3>
    <hr>
    <div>
        <h4>about</h4>
        <p>free, open source and public document sharing. write documents with markdown, share them immediatly.</p>
        <p>written entirely in php and htmx.</p>
        <p><a href="https://writar.markski.ar">visit writar</a></p>
        <p><a href="https://github.com/markski1/writar">view on github</a></p>
    </div>

    
HTML;

$site->render($content);