<?php
include 'template/engine.php';

$site = new Template("donate");

$content = /** @lang HTML */
    <<<EOD


    <h3>make a donation</h3>
    <hr>
    <p>i invest a significant amount of my time creating and maintaining the tools, services and documentation available both in this website and on my github page.</p>
    <p>of course, this is not your problem. but if you find use or joy in anything i make and wish to support me, here's the place to do it.</p>
    <div>
        <h4>methods</h4>
        <p>argentine pesos: through <a href="https://www.cafecito.app/Markski" target="_blank">cafecito</a>, or to bank alias <span class="accent">markski</span>.</p>
        <p>us dollars: through <a href="https://www.ko-fi.com/Markski" target="_blank">ko-fi</a>.</p>
    </div>

    
EOD;

$site->render($content);