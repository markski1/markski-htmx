<?php
include 'template/engine.php';

$content = <<<EOD

    <h3>blog</h3>
    <hr>
    <div>
        <h4>Fresh start</h4>
        <p>
            I've always enjoyed running a personal website - having a centralized place to display my projects and stuff. I have run it since I started coding, at around 14 or so. Never did analytics on it, for all I know, no one has ever seen it. But I enjoy it, so, here we are.
        </p>
        <p>
            My latest iteration of it was in early 2022, when I decided to port it to Next.JS, just to be one of the React cool kids with the build step and the deployments and whatever. I was also focused in frontend development and wanted to present myself as such.
        </p>
        <p>
            Finding myself delusioned with the state of modern frontend development, and given that that my current professional position is largely on the server side, I have decided to rewrite my personal site in a much simpler stack. PHP for the server logic, and HTMX for presentation.
        </p>
        <p>
            I'll port over the old blog posts and other "missing" stuff eventually.
        </p>
    </div>

    
EOD;

render_template("blog", $content);