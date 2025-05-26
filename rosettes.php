<?php
include 'template/engine.php';

$site = new Template("Rosettes");
$site->set_description("Rosettes is a simple, free and open source Discord bot.");

$content = /** @lang HTML */
    <<<HTML


    <h3>Rosettes</h3>
    <hr>
    <div>
        <h4>About</h4>
        <img alt="rosettes logo" src="/images/rosettes.png" width="20%" style="float: right"/>
        <p>Rosettes is a simple, free and open source discord bot.</p>
        <p>Its objectives are:</p>
        <ul>
            <li>To be simple to set up.</li>
            <li>To be as straightforwards as possible in all its functions.</li>
            <li>To collect as little user and guild data as possible.</li>
            <li>To collect absolutely no message data, ever.</li>
        </ul>
        
        <div class="margin">        
            <a class="no-decor" href="https://discord.com/api/oauth2/authorize?client_id=970176524110147605&permissions=275149548624&scope=bot" target="_blank">
                <button class="menubtn brighter">
                    Add to server
                </button>
            </a>
            <a class="no-decor" href="https://rosettes.markski.ar">
                <button class="menubtn brighter">
                    Admin panel
                </button>
            </a>
            <a class="no-decor" href="https://github.com/markski1/RosettesDiscord" target="_blank">
                <button class="menubtn brighter">
                    GitHub
                </button>
            </a>
        </div>
    </div>
    <div>
        <h4>Functions</h4>
        <p>Rosettes brings many features to your servers, useful to admins and users alike.</p>
        <p>You may toggle functionality at a whim with <span class="accent">/settings</span>.</p>
        <ul>
            <li>
                <b>Downloading videos</b>
                <br>Can download videos from Twitter, TikTok, Streamable, and others with <span class="accent">/getvideo</span>.
            </li>
            <li>
                <b>Searching</b>
                <br>Quickly get information from Wikipedia, UrbanDictionary, Pokepedia, Anime/Manga sites, etc. with <span class="accent">/find</span>.
            </li>
            <li>
                <b>Role management</b>
                <br>Create AutoRoles for users to automatically assign themselves roles.
            </li>
            <li>
                <b>Chatting</b>
                <br>Rosettes can answer to questions and keep basic conversations with <span class="accent">/ask</span>.
            </li>
            <li>
                <b>Image functions</b>
                <br>SauceNAO to find artwork sources with the <span class="accent">/image saucenao</span> command.
            </li>
            <li>
                <b>Polls</b>
                <br>Easily create polls where people can anonymously vote with <span class="accent">/makepoll</span>.
            </li>
            <li>
                <b>Reminders</b>
                <br>Let users set reminder alarms for themselves, even in DMs, with <span class="accent">/alarm</span>.
            </li>
            <li>
                <b>Minigames</b>
                <br>- Farming and fishing system, with shop, inventory and the expected stuff with <span class="accent">/farm</span>
                <br>- A pet ownership and interaction system with <span class="accent">/pet</span>
            </li>
            <li>
                <b>Miscelaneous</b>
                <br>- Display who joins and leaves the server
                <br>- Provide status information for certain games with <span class="accent">/status</span>
                <br>- Luck: You can <span class="accent">/roll</span> dice and throw <span class="accent">/coin</span>s
                <br>- More stuff.
            </li>
            <li>
                <b>What else would you like?</b>
                <br>If Rosettes lacks a feature you want, use <span class="accent">/feedback</span>, or contact me directly.
                <br>I am always adding new things, and welcoming new ideas.
            </li>
        </ul>
    </div>

    
HTML;

$site->render($content);