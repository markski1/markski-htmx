<?php
include 'template/engine.php';

$site = new Template("wttk");
$site->set_description("wttk is a lightweight, free and open source windows tweaking tool");

$content = /** @lang HTML */
    <<<HTML


    <h3>WTTk</h3>
    <hr>
    <div>
        <h4>About</h4>
        <p>WTTk is a lightweight, free and open source windows tweaking tool</p>
        <ul>
            <li>Shortcuts to hidden or obscure windows native tools.</li>
            <li>Ability to change publicly unavailable desktop settings.</li>
            <li>Ability to change and disable many Windows behaviours which cannot be changed from any of windows' front-facing UI.</li>
            <li>A shutdown scheduler.</li>
        </ul>
        <img src="/images/wttk.png" alt="screenshot of the application" width="500">
        <p><a href="https://github.com/markski1/WinTweakTool/releases/latest" target="_blank">Download latest version</a> - <a href="https://github.com/markski1/WinTweakTool" target="_blank">View on GitHub</a></p>
        <p>Support development with a <sitelink to="donate">Donation</sitelink></p>
    </div>

    
HTML;

$site->render($content);