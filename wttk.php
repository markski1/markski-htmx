<?php
include 'template/engine.php';

$content = <<<EOD

    <h3>wttk</h3>
    <hr>
    <div>
        <h4>about</h4>
        <p>wttk is a lightweight, free and open source windows tweaking tool</p>
        <ul>
            <li>shortcuts to hidden or obscure windows native tools.</li>
            <li>ability to change publicly unavailable desktop settings.</li>
            <li>ability to change and disable many Windows behaviours which cannot be changed from any of windows' front-facing UI.</li>
            <li>a shutdown scheduler.</li>
        </ul>
        <img src="/assets/images/wttk.png" alt="screenshot of the application" width="500">
        <p><a href="https://github.com/markski1/WinTweakTool/releases/latest" target="_blank">download latest version</a> - <a href="https://github.com/markski1/WinTweakTool" target="_blank">view on github</a></p>
        <p>support development with a <sitelink to="donate">donation</sitelink></p>
    </div>

    
EOD;

render_template("wttk", $content);