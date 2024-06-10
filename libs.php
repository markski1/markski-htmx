<?php
include 'template/engine.php';

$site = new Template("Libraries");
$site->set_description("Miscelaneous libraries developed by me.");

$content = /** @lang HTML */
    <<<HTML

    
    <h3>Libraries</h3>
    <hr>
    
    <div>
        <h4>PSXU</h4>
        Single-file php script to upload files on your webserver through sharex for quick sharing.<br>
        <a href="https://github.com/markski1/PSXU" target="_blank">View on GitHub</a>
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
    
    
HTML;

$site->render($content);