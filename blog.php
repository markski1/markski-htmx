<?php
include 'template/engine.php';

$site = new Template("blog");
$site->set_description("markski's blog.");

$content = /** @lang HTML */
    <<<EOD


    <h3>blog</h3>
    <hr>
    <div>
        <h3>the principle of locality</h3>
        <p>random access memory and how to use it is far less trivial than i once thougth.</p>
        <p><sitelink to="blog/principle-of-locality">view post</sitelink></p>
    </div>
    <div>
        <h3>monitoring your projects' uptime is easier than you think</h3>
        <p>once you're running a few hobby projects, you'll want to be the first to know when they fall.</p>
        <p><sitelink to="blog/monitoring-project-uptime">view post</sitelink></p>
    </div>
    <div>
        <h3>fix linux failing to find your headset microphone</h3>
        <p>Audio issues on linux are rare nowadays. but when they show up, they are non-trivial.</p>
        <p><sitelink to="blog/linux-fix-headset-mic">view post</sitelink></p>
    </div>
    <div>
        <h3>deploying a tes3mp server on a vps</h3>
        <p>using a linux vps to easily host a morrowind multiplayer server.</p>
        <p><sitelink to="blog/tes3mp-server-linux">view post</sitelink></p>
    </div>
    <div>
        <h3>hosting your own sharex screenshots with psxu</h3>
        <p>using a webserver as a personal content host to easily use with tools such as sharex.</p>
        <p><sitelink to="blog/sharex-self-host-with-psxu">view post</sitelink></p>
    </div>

    
EOD;

$site->render($content);
