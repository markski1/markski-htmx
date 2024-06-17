<?php
include 'template/engine.php';

$content = /** @lang HTML */
    <<<HTML

    
    <h3>Software & stuff</h3>
    <hr>
    <div>
        <h4>Rosettes</h4>
        Simple, free, open source discord bot.<br />
        <sitelink to="rosettes">Learn more</sitelink> - <a href="https://github.com/markski1/RosettesDiscord" target="_blank">GitHub</a>
    </div>
    <div>
        <h4>SAMonitor</h4>
        Server monitoring for SA-MP and openmultiplayer.<br />
        <sitelink to="samonitor">Learn more</sitelink> - <a href="https://github.com/markski1/SAMonitor" target="_blank">GitHub</a>
    </div>
    <div>
        <h4>writar</h4>
        Free and hassle-free document sharing.<br />
        <sitelink to="writar">Learn more</sitelink> - <a href="https://github.com/markski1/writar" target="_blank">GitHub</a>
    </div>
    <div>
        <h4>WTTk</h4>
        Enables tweaking hidden windows settings.<br />
        <sitelink to="wttk">Learn more</sitelink> - <a href="https://github.com/markski1/WinTweakTool" target="_blank">GitHub</a>
    </div>
    <div>
        <h4>BSXU</h4>
        Custom uploader for self-hosting files. Sharex compatible. Backs up files up to Backblaze B2<br>
        <sitelink to="blog/bsxu-b2-hosting">View post</sitelink> - <a href="https://github.com/markski1/BSXU" target="_blank">GitHub</a>
    </div>
    <div>
        <h4>Calculando Argentina</h4>
        Web app with calculators relevant to argentina.<br />
        <sitelink to="calculando">Learn more</sitelink> - <a href="https://github.com/markski1/Calculadoras" target="_blank">GitHub</a>
    </div>
    
    <iframe src="https://status.markski.ar/badge?theme=dark" style="border: 0; width: 250px; height: 32px; margin-top: 2rem;"></iframe>
    
    
HTML;

$site = new Template("Software & stuff");
$site->set_description("Software and stuff made by me.");
$site->render($content);