<?php
include 'template/engine.php';

$site = new Template("libraries");
$site->set_description("miscelaneous libraries developed by me.");

$content = /** @lang HTML */
    <<<EOD

    
    <h3>libraries</h3>
    <hr>
    
    <div>
        <h4>PSXU</h4>
        single-file php script to upload files on your webserver through sharex for quick sharing.<br>
        <a href="https://github.com/markski1/PSXU" target="_blank">view on github</a>
    </div>
    
    <div>
        <h4>ez-steam-api.php</h4>
        object-oriented php interface for easily and quickly requesting data from the steam api.<br>
        <a href="https://github.com/markski1/ez-steam-api.php" target="_blank">view on github</a>
    </div>
    
    <div>
        <h4>tireFuncs</h4>
        functions and callbacks for easily handling vehicle tires in sa-mp.<br>
        <a href="https://github.com/markski1/SAMP-tireFuncs" target="_blank">view on github</a>
    </div>
    
    <div>
        <h4>vModData</h4>
        library to obtain information about vehicle components in sa-mp.<br>
        <a href="https://github.com/markski1/SAMP-vModData" target="_blank">view on github</a>
    </div>
    
    <style>
        
    </style>
    
    
EOD;

$site->render($content);