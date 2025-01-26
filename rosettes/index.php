<?php
include '../template/engine.php';

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
        <p>It's objectives are:</p>
        <ul>
            <li>To be simple to set up.</li>
            <li>To be as straightforwards as possible in all it's functions.</li>
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
            <button class="menubtn brighter" hx-get="/rosettes/commands.php" hx-target="#main-content" hx-push-url="true">
                Command list
            </button>
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
                <b>Role management</b>
                <br>Create AutoRoles for users to automatically assign themselves roles.
            </li>
            <li>
                <b>Image functions</b>
                <br>SauceNAO to find artwork sources.
            </li>
            <li>
                <b>Downloading videos</b>
                <br>Can download videos from Twitter, TikTok, Streamable, and others.
            </li>
            <li>
                <b>Polls</b>
                <br>Easily create polls where people can anonymously vote.
            </li>
            <li>
                <b>Reminders</b>
                <br>Let users set reminder alarms for themselves, even in DM's.
            </li>
            <li>
                <b>Searching</b>
                <br>Quickly get information from Wikipedia, UrbanDictionary, Pokepedia, Anime/Manga sites, etc.
            </li>
            <li>
                <b>Minigames</b>
                <br>- Farming and fishing system, with shop, inventory and the expected stuff.
                <br>- A pet ownership and interaction system.
            </li>
            <li>
                <b>Miscelaneous</b>
                <br>- Display who joins and leaves the server
                <br>- Provide status information for certain games
                <br>- Throwing dice and coins
                <br>- Expression evaluator
                <br>- Even more.
            </li>
            <li>
                <b>What else would you like?</b>
                <br>If Rosettes lacks a feature you want, use <span class="accent">/feedback</span>, or contact me directly.
                <br>I am always adding new things, and welcoming new ideas.
            </li>
        </ul>
        <p>For a list of commands, <sitelink to="rosettes/commands">click here</sitelink>.</p>
    </div>

    
HTML;

$site->render($content);