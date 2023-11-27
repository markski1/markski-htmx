<?php


class Template {
    private string $title;
    private string $content;
    private string $description;

    public function __construct($title) {
        $this->title = $title;
    }

    function set_content($content) {
        $sitelink_pattern = '/<sitelink to="([^"]*)">([^<]+)<\/sitelink>/';

        $this->content = preg_replace_callback(
            $sitelink_pattern,
            function ($matches) {
                $destination_url = $matches[1];
                $destination_text = $matches[2];

                return "<a href='{$destination_url}' hx-get='{$destination_url}' hx-push-url='true' hx-target='main'>{$destination_text}</a>";
            },
            $content
        );
    }

    function set_description($description) {
        $this->description = $description;
    }

    function render() {
        if (isset($_SERVER['HTTP_HX_REQUEST'])) {
            echo $this->content;
            echo "<script>
                      document.title = '{$this->title} - markski';
                  </script>";
            exit;
        }

        $site = file_get_contents("template/layout.html");

        // insert title and content into the template
        $site = str_replace("<!-- %%% SITE_TITLE %%% -->", $this->title, $site);
        $site = str_replace("<!-- %%% SITE_DESCRIPTION %%% -->", $this->description, $site);
        $site = str_replace("<!-- %%% SITE_CONTENT %%% -->", $this->content, $site);

        echo $site;
    }
}