<?php
include 'template/engine.php';

$content = /** @lang HTML */
    <<<EOD

    
    <h3>software & services</h3>
    <hr>
    <div>
        <h4>Rosettes</h4>
        simple, free, open source discord bot.<br />
        <sitelink to="rosettes">learn more</sitelink> - <a href="https://github.com/markski1/RosettesDiscord" target="_blank">github</a>
    </div>
    <div>
        <h4>SAMonitor</h4>
        server monitoring for sa-mp and openmultiplayer.<br />
        <sitelink to="samonitor">learn more</sitelink> - <a href="https://github.com/markski1/SAMonitor" target="_blank">github</a>
    </div>
    <div>
        <h4>WTTk</h4>
        enables tweaking hidden windows settings.<br />
        <sitelink to="wttk">learn more</sitelink> - <a href="http://github.com/markski1/WTTk" target="_blank">github</a>
    </div>
    <div>
        <h4>Calculando Argentina</h4>
        web app with calculators relevant to argentina.<br />
        <sitelink to="calculando">learn more</sitelink> - <a href="https://github.com/markski1/Calculadoras" target="_blank">github</a>
    </div>
    
    
EOD;

$site = new Template("software & services");
$site->set_description("rosettes is a simple, free, open source discord bot");
$site->set_content($content);
$site->render();