<?php

function render_template($title, $content): void
{
    // convert "sitelinks" to proper htmx urls

    $sitelink_pattern = '/<sitelink to="([^"]*)">([^<]+)<\/sitelink>/';

    $content = preg_replace_callback(
        $sitelink_pattern,
        function ($matches) {
            $destination_url = $matches[1];
            $destination_text = $matches[2];

            return "<a href='{$destination_url}' hx-get='{$destination_url}' hx-push-url='true' hx-target='main'>{$destination_text}</a>";
        },
        $content
    );

    if (isset($_SERVER['HTTP_HX_REQUEST'])) {
        echo $content;
        echo "<script>
                document.title = '{$title} - markski';
            </script>";
        exit;
    }

    $template = file_get_contents("template/layout.html");

    // insert title and content into the template
    $site = str_replace("<!-- %%% SITE_TITLE %%% -->", $title, $template);
    $site = str_replace("<!-- %%% SITE_CONTENT %%% -->", $content, $site);

    echo $site;
}