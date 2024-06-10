<?php
include 'template/engine.php';

$site = new Template("Calculando");
$site->set_description("Open source progressive web application (PWA), providing common calculations relevant to the argentine republic.");

$content = /** @lang HTML */
    <<<HTML


    <h3>Calculando argentina</h3>
    <hr>
    <div>
        <h4>About</h4>
        <p>Open source progressive web application (PWA), providing common calculations relevant to the argentine republic.</p>
        <p>It provides a simple and lightweight user interface, responsive across device sizes and form factors, and functions entirely client-side.</p>
        <p>It is written in typescript, with next.js for presentation</p>
        <p><a href="https://calc.markski.ar">Visit calculando argentina</a></p>
        <p><a href="https://github.com/markski1/calculadoras">View on GitHub</a></p>
    </div>

    
HTML;

$site->render($content);