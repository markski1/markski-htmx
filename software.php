<?php
include 'template/engine.php';

$content = /** @lang HTML */
    <<<HTML

    
    <h3>software & stuff</h3>
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
        <h4>writar</h4>
        free and hassle-free document sharing.<br />
        <sitelink to="writar">learn more</sitelink> - <a href="https://github.com/markski1/writar" target="_blank">github</a>
    </div>
    <div>
        <h4>WTTk</h4>
        enables tweaking hidden windows settings.<br />
        <sitelink to="wttk">learn more</sitelink> - <a href="https://github.com/markski1/WTTk" target="_blank">github</a>
    </div>
    <div>
        <h4>Calculando Argentina</h4>
        web app with calculators relevant to argentina.<br />
        <sitelink to="calculando">learn more</sitelink> - <a href="https://github.com/markski1/Calculadoras" target="_blank">github</a>
    </div>
    
    <iframe src="https://status.markski.ar/badge?theme=dark" style="border: 0; width: 250px; height: 32px; margin-top: 2rem;"></iframe>
    
    
HTML;

$site = new Template("software & stuff");
$site->set_description("software and stuff made by me.");
$site->render($content);