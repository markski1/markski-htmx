<?php
include 'template/engine.php';

$site = new Template("home");
$site->set_description("markski's personal website.");

$content = /** @lang HTML */
    <<<EOD


    <h3>about</h3>
    <p>i am a computer science student from la plata, argentina.</br>
    fullstack developer as a hobby, backend developer for a living.</p>
    <h3>domains i work within:</h3>
    <ul>
        <li>backend development</li>
        <li>server administration</li>
        <li>database administration</li>
        <li>performance analysis</li>
        <li>system design</li>
        <li>automation</li>
    </ul>


    <h3>find me:</h3>
    <ul>
        <li>github: <a target="_blank" href="https://github.com/markski1">@markski1</a></li>
        <li>telegram: <a target="_blank" href="https://telegram.me/markski">@markski</a></li>
        <li>xitter: <a target="_blank" href="https://x.com/a_markski">@a_markski</a></li>
        <li>discord: <a href="discord://markski.ar">@markski.ar</a></li>
        <li>email: <a href="mailto:me@markski.ar">me@markski.ar</a>
    </ul>

    
EOD;

$site->render($content);