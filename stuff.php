<?php
include 'template/engine.php';

$content = /** @lang HTML */
    <<<HTML

    
    <h3>Stuff</h3>
    <small>Little tools and hobby projects</small>
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
        <h4>Writar</h4>
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
    
    <iframe src="https://status.markski.ar/badge?theme=dark" style="border: 0; width: 250px; height: 32px; margin-top: 2rem;"></iframe>
    
    <h3>Lesser stuff</h3>
    <hr>

    <div>
        <h4>BlockLog</h4>
        In-development Minecraft plugin to log actions and events on the map. Aims to be more lightweight than the current standard options.<br>
        <a href="https://github.com/markski1/blocklog" target="_blank">View on GitHub</a>
    </div>
    <div>
        <h4>ez-steam-api.php</h4>
        Object-oriented php interface for easily and quickly requesting data from the steam api.<br>
        <a href="https://github.com/markski1/ez-steam-api.php" target="_blank">View on GitHub</a>
    </div>
    
    <div>
        <h4>tireFuncs</h4>
        Functions and callbacks for easily handling vehicle tires in sa-mp.<br>
        <a href="https://github.com/markski1/SAMP-tireFuncs" target="_blank">View on GitHub</a>
    </div>
    
    <div>
        <h4>vModData</h4>
        Library to obtain information about vehicle components in sa-mp.<br>
        <a href="https://github.com/markski1/SAMP-vModData" target="_blank">View on GitHub</a>
    </div>
    
    <div>
        <h4>PSXU [unmaintained, consider BSXU]</h4>
        Simple program to easily upload and share images using your PHP web server, through ShareX.<br>
        <a href="https://github.com/markski1/PSXU" target="_blank">View on GitHub</a>
    </div>
    
    
HTML;

$site = new Template("Stuff");
$site->set_description("Stuff made by me.");
$site->render($content);