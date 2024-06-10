<?php
include 'template/engine.php';

$site = new Template("Blog");
$site->set_description("Markski's blog.");

$content = <<<HTML


    <h3>Blog</h3>
    <hr>
    <div>
        <h3>Self-hosting with BSXU</h3>
        <p>Leverage sharex, backblaze b2 and your webserver to hold and serve your own files easily.</p>
        <p><sitelink to="blog/bsxu-b2-hosting">View post</sitelink></p>
    </div>
    <div>
        <h3>The principle of locality</h3>
        <p>Random access memory and how to use it is far less trivial than I once thougth.</p>
        <p><sitelink to="blog/principle-of-locality">View post</sitelink></p>
    </div>
    <div>
        <h3>Monitoring your projects' uptime is easier than you think</h3>
        <p>Once you're running a few hobby projects, you'll want to be the first to know when they fall.</p>
        <p><sitelink to="blog/monitoring-project-uptime">View post</sitelink></p>
    </div>
    <div>
        <h3>Fix linux failing to find your headset microphone</h3>
        <p>Audio issues on linux are rare nowadays. But when they show up, they are non-trivial.</p>
        <p><sitelink to="blog/linux-fix-headset-mic">View post</sitelink></p>
    </div>
    <div>
        <h3>Deploying a tes3mp server on a vps</h3>
        <p>Using a linux vps to easily host a morrowind multiplayer server.</p>
        <p><sitelink to="blog/tes3mp-server-linux">View post</sitelink></p>
    </div>
    <div>
        <h3>Hosting your own sharex screenshots with PSXU</h3>
        <p>[Legacy] Using a webserver as a personal content host to easily use with tools such as sharex.</p>
        <p><sitelink to="blog/sharex-self-host-with-psxu">View post</sitelink></p>
    </div>

    
HTML;

$site->render($content);
