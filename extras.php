<?php
include 'template/engine.php';

$content = <<<EOD

    <h3>extras</h3>
    <hr>
    <p>this page largely contains things i can't imagine anyone caring about.</p>
    <p>it's my website, so might as well give them a space anyways. is this narcisism?</p>
    <div>
        <h4>miscelaneous waffling</h4>
        <ul>
             <li>most people's perception of php is 10+ years out of date.</li>
             <li>in my opinion, a bad language makes you make assumptions. requiring you to be explicit isn't inherently "demanding attention to the irrelevant"</li>
             <li>bad software is unethical.</li>
             <li>seriously. imagine the amount of unnecesary power usage in the world, across hundreds of millions of computers, caused by electron apps that could be native, or by javascript running in servers.</li>
             <li>i hate the joke about how programmers "only copy things from stack overflow". if you are a programmer, and you can relate to that sentence, please improve. don't be replaceable.</li>
        </ul>
    </div>
    <div>
        <h4>miscelaneous facts about i</h4>
        <ul>
             <li>i am 26 years old, and started coding at around 14.</li>
             <li>i don't think going to college helped me, but i don't regret it either.</li>
             <li>i had a lot of cats when i was younger but now i have none.</li>
             <li>i had severe career burnout at 20 and almost quit computing.</li>
             <li>i am very happy i didn't.</li>
        </ul>
    </div>
    <div>
        <h4>links i find interesting</h4>
        <ul>
            <li><a href="https://stallman.org/articles/destruction-certificate.txt" target="_blank">certificate of confusion</a> - richard m. stallman</li>
            <li><a href="https://datatracker.ietf.org/doc/html/rfc2795" target="_blank">the infinite monkey protocol suite</a> - network working group</li>
            <li><a href="http://www.paulgraham.com/identity.html" target="_blank">keep your identity small</a> - paul graham</li>
        </ul>
    </div>

    
EOD;

render_template("home", $content);