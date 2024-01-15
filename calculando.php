<?php
include 'template/engine.php';

$site = new Template("calculando");
$site->set_description("open source progressive web application (pwa), providing common calculations relevant to the argentine republic.");

$content = /** @lang HTML */
    <<<HTML


    <h3>calculando argentina</h3>
    <hr>
    <div>
        <h4>about</h4>
        <p>open source progressive web application (pwa), providing common calculations relevant to the argentine republic.</p>
        <p>it provides a simple and lightweight user interface, responsive across device sizes and form factors, and functions entirely client-side.</p>
        <p>it is written in typescript, with next.js for presentation</p>
        <p><a href="https://calc.markski.ar">visit calculando argentina</a></p>
        <p><a href="https://github.com/markski1/calculadoras">view on github</a></p>
    </div>

    
HTML;

$site->render($content);