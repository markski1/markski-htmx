<?php
include '../template/engine.php';

$site = new Template("rosettes commands");
$site->set_description("commands for the Rosettes discord bot.");

$content = /** @lang HTML */
    <<<HTML


    <h3>Rosettes commands</h3>
    <hr>
    <p>The following is a somewhat-complete list of commands.</p>
    <div style="border-left: 2px #666666 solid; padding: .5rem; margin-bottom: 3rem">
        <h3>Utility commands</h3>
        
        <div>
            <h4>/getvideo <small>[media url]</small></h4>
            <p>Download the video of the given link. [twitter, instagram, tiktok, youtube, etc]</p>
        </div>
        <div>
            <h4>/alarm <small>[amount] [optional:time unit]</small></h4>
            <p>Sets an alarm.</p>
        </div>
        <div>
            <h4>/exportemoji</h4>
            <p>Download all custom server emoji in a .zip file.</p>
        </div>
        <div>
            <h4>/makepoll</h4>
            <p>Allows you to create a custom poll with up to 4 choices.</p>
        </div>
    </div>
    
    <div style="border-left: 2px #666666 solid; padding: .5rem; margin-bottom: 3rem">
        <h3>Image commands</h3>
        
        <div>
            <h4>/image saucenao <small>[artwork url]</small></h4>
            <p>Finds the source of a provided artwork.</p>
        </div>
        <div>
            <h4>/image content <small>[image url]</small></h4>
            <p>Convert image to a format of your choice.</p>
        </div>
        <div>
            <h4>/image reversegif [image url]</h4>
            <p>Reverse the given gif image.</p>
        </div>
        <div>
            <h4>/image throwbrick [emoji/username/url] [optional:reversed]</h4>
            <p>Creates a gif of the "throw brick" meme with the given image as it's subject.</p>
        </div>
    </div>
    
    <div style="border-left: 2px #666666 solid; padding: .5rem; margin-bottom: 3rem">
        <h3>search commands</h3>
        
        <div>
            <h4>/find wiki <small>[term]</small></h4>
            <p>Finds something in wikipedia.</p>
        </div>
        <div>
            <h4>/find urban <small>[term]</small></h4>
            <p>Finds something in urban dictionary.</p>
        </div>
        <div>
            <h4>/find pokemon <small>[name or id]</small></h4>
            <p>Finds information about a pokemon.</p>
        </div>
        <div>
            <h4>/find anime <small>[term]</small></h4>
            <p>Finds information about an anime.</p>
        </div>
        <div>
            <h4>/find manga <small>[term]</small></h4>
            <p>Finds information about a manga.</p>
        </div>
        <div>
            <h4>/find character <small>[term]</small></h4>
            <p>Finds information about a character from animated media.</p>
        </div>
    </div>
    
    <div style="border-left: 2px #666666 solid; padding: .5rem; margin-bottom: 3rem">
        <h3>chance commands</h3>
        
        <div>
            <h4>/dice <small>[faces] [optional:amount]</small></h4>
            <p>Rolls a specified amount of dice with a specified amount of faces each.</p>
        </div>
        <div>
            <h4>/coin</h4>
            <p>Throws a coin. can provide optional name for each face.</p>
        </div>
    </div>
    
    <div style="border-left: 2px #666666 solid; padding: .5rem; margin-bottom: 3rem">
        <h3>status commands</h3>
        
        <div>
            <h4>/status website <small>[url]</small></h4>
            <p>Check if a website is working.</p>
        </div>
        <div>
            <h4>/status ping <small>[hostname or ip address]</small></h4>
            <p>Attempts to ping the provided address.</p>
        </div>
        <div>
            <h4>/status minecraft <small>[hostname or ip address]</small></h4>
            <p>Checks the status of a minecraft server and fetches information.</p>
        </div>
        <div>
            <h4>/status csgo</h4>
            <p>Status of csgo matchmaking servers.</p>
        </div>
        <div>
            <h4>/status ffxiv [optional:datacenter]</h4>
            <p>Status of ffxiv servers.</p>
        </div>
    </div>
    
    <div style="border-left: 2px #666666 solid; padding: .5rem; margin-bottom: 3rem">
        <h3>minigame commands</h3>
        
        <div>
            <h4>/farm view</h4>
            <p>View your farm's status.</p>
        </div>
        <div>
            <h4>/farm inventory</h4>
            <p>See your inventory.</p>
        </div>
        <div>
            <h4>/farm fish</h4>
            <p>Attempt to catch a fish.</p>
        </div>
        <div>
            <h4>/farm give [item] [amount] [user]</h4>
            <p>Give items to another user.</p>
        </div>
        <div>
            <h4>/pet view</h4>
            <p>View your current pet.</p>
        </div>
        <div>
            <h4>/pet list</h4>
            <p>List all your pets.</p>
        </div>
    </div>
    
    <div style="border-left: 2px #666666 solid; padding: .5rem; margin-bottom: 3rem">
        <h3>miscelaneous commands</h3>
        
        <div>
            <h4>/serverinfo</h4>
            <p>Information about the current discord server.</p>
        </div>
        <div>
            <h4>/profile [optional:user]</h4>
            <p>Shows information about yourself or the provided user.</p>
        </div>
        <div>
            <h4>/eval [expression]</h4>
            <p>Evaluates the given matematical expression.</p>
        </div>
        <div>
            <h4>/makesweeper [emoji] [optional:difficulty]</h4>
            <p>Create a minesweeper where the mines are the given emoji.</p>
        </div>
    </div>
    
    <div style="border-left: 2px #666666 solid; padding: .5rem; margin-bottom: 3rem">
        <h3>system commands</h3>
        
        <div>
            <h4>/settings</h4>
            <p>Change the bot's behaviour.</p>
        </div>
        <div>
            <h4>/setlogchan [optional:disable]</h4>
            <p>Start showing join and leave messages in the channel where it's used.</p>
        </div>
        <div>
            <h4>/setfarmchan</h4>
            <p>Restrict minigame commands to the channel where it's used.</p>
        </div>
        <div>
            <h4>/feedback <small>[text]</small></h4>
            <p>Send feedback to the bot's developer.</p>
        </div>
        <div>
            <h4>/about</h4>
            <p>Bot's current status.</p>
        </div>
    </div>
    <div>
        <p>This list isn't always up to date. More functionality is available through the admin panel.</p>
    </div>

    
HTML;

$site->render($content);