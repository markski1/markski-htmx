<?php
include 'template/engine.php';

$site = new Template("samonitor");
$site->set_description("free, open source and public server browser, api and masterlist provider for sa-mp and open.mp.");

$content = /** @lang HTML */
    <<<EOD


    <h3>samonitor</h3>
    <hr>
    <div>
        <h4>about</h4>
        <p>free, open source and public server browser, api and masterlist provider for sa-mp and open.mp.</p>
        <p>it's backend is written entirely in ASP.NET 8. It runs 24/7, constantly querying and recording data of over a thousand server across the globe.</p>
        <p><a href="https://sam.markski.ar">visit samonitor</a></p>
        <p><a href="https://github.com/markski1/samonitor">view on github</a></p>
    </div>

    
EOD;

$site->render($content);