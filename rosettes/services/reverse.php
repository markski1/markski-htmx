<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("PHPImageWorkshop/ImageWorkshop.php");

require_once("GifCreator.php");
require_once("GifFrameExtractor.php");

$imagePath = "reverseCache/".$_GET['imageNum'].".gif";

if (GifFrameExtractor::isAnimatedGif($imagePath)) {
    $gfe = new GifFrameExtractor();
    $frames = $gfe->extract($imagePath);

    $retouchedFrames = array();

    for ($i = sizeof($frames) - 1; $i >= 0; $i--) {
        $retouchedFrames[] = $frames[$i]['image'];
    }

    header("Content-type: image/gif");
    $gc = new GifCreator();
    echo $gc->create($retouchedFrames, array_reverse($gfe->getFrameDurations()), 0);
}
else {
    exit('err');
}
?>