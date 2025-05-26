<?php
include 'template/engine.php';

$site = new Template("SAMonitor");
$site->set_description("Free, open source and public server browser, API and masterlist provider for SA-MP and open.mp.");

$content = /** @lang HTML */
    <<<HTML


    <h3>SAMonitor</h3>
    <hr>
    <div>
        <h4>About</h4>
        <p>Free, open source and public server browser, API and masterlist provider for SA-MP and open.mp.</p>
        <p>Its backend is written entirely in ASP.NET 8. It runs 24/7, constantly querying and recording data of over a thousand server across the globe.</p>
        <p>Notably, it's recently reached 90 days of continuous, 100% uptime.</p>
        <p><a href="https://sam.markski.ar">Visit SAMonitor</a></p>
        <p><a href="https://github.com/markski1/samonitor">View on GitHub</a></p>
    </div>

    
HTML;

$site->render($content);