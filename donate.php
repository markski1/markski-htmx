<?php
include 'template/engine.php';

$site = new Template("Donate");

$content = /** @lang HTML */
    <<<HTML


    <h3>Make a donation</h3>
    <hr>
    <p>I invest a significant amount of my time creating and maintaining the tools, services and documentation available both in this website and on my github page.</p>
    <p>Of course, this is not your problem. But if you find use or joy in anything I make and wish to support me, here's the place to do it.</p>
    <div>
        <h4>Methods</h4>
        <p>Argentine pesos: through <a href="https://www.cafecito.app/Markski" target="_blank">cafecito</a>, or to bank alias <span class="accent">markski</span>.</p>
        <p>US dollars: through <a href="https://www.ko-fi.com/Markski" target="_blank">ko-fi</a>.</p>
    </div>

    
HTML;

$site->render($content);