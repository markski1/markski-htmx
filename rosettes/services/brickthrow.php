<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("PHPImageWorkshop/ImageWorkshop.php");

require_once("GifCreator.php");
require_once("GifFrameExtractor.php");

$emojiPath = "emojiCache/".$_GET['emojiNum'].".png";
$basePath = "basenew.gif";

function CloneToBuffer(int $i, $resizedEmoji, &$fileName, &$frame, &$buffer): void
{
    $fileName = "frames/frame_" . sprintf("%02d", $i) . "_delay-0.04s.png";
    $frame = imagecreatefrompng($fileName);
    $buffer = imagecreatefrompng($fileName);
    if ($i < 42) {
        imagecopy($buffer, $resizedEmoji, 110, 240, 0, 0, 64, 64);
        imagecopy($buffer, $frame, 0, 0, 0, 0, 299, 299);
    }
}

if (GifFrameExtractor::isAnimatedGif($basePath)) {
    $gfe = new GifFrameExtractor();
    $frames = $gfe->extract($basePath);

    $type = mime_content_type($emojiPath);

    switch (strtolower($type)) {
        case "image/png":
            $emoji = imagecreatefrompng($emojiPath);
            break;
        case "image/jpeg":
        case "image/jpg":
            $emoji = imagecreatefromjpeg($emojiPath);
            break;
        case "image/gif":
            $emoji = imagecreatefromgif($emojiPath);
            break;
        case "image/webp":
            $emoji = imagecreatefromwebp($emojiPath);
            break;
        default:
            exit("err");
    }
    
    list($width, $height) = getimagesize($emojiPath);

    $properEmoji = imagecreatetruecolor($width, $height);

    $resizedEmoji = imagecreatetruecolor(64, 64);

    imagecopyresized($resizedEmoji, $emoji, 0, 0, 0, 0, 64, 64, $width, $height);

    $background = imagecolorallocate($resizedEmoji , 0, 0, 0);
    imagecolortransparent($resizedEmoji, $background);
    imagealphablending($resizedEmoji, false);
    imagesavealpha($resizedEmoji, true);

    $retouchedFrames = array();
    
    // For each frame, we add a watermark and we resize it
    if (isset($_GET['parry'])) {
        for ($i = 1; $i < 44; $i++) {
            CloneToBuffer($i, $resizedEmoji, $fileName, $frame, $buffer);
            if ($i == 43) {
                $blankFrame = imagecreatefrompng("blank.png");
                imagecopy($buffer, $blankFrame, 0, 0, 0, 0, 299, 299);
            }

            $retouchedFrames[] = $buffer;
        }
        for ($i = 44; $i > 0; $i--) {
            CloneToBuffer($i, $resizedEmoji, $fileName, $frame, $buffer);
            if ($i == 44) {
                $blankFrame = imagecreatefrompng("blank.png");
                imagecopy($buffer, $blankFrame, 0, 0, 0, 0, 299, 299);
            }
            
            $retouchedFrames[] = $buffer;
        }
        $timingArr = array_merge($gfe->getFrameDurations(), array_reverse($gfe->getFrameDurations()));
        $timingArr[43] = 4;
        $timingArr[44] = 4;
    }
    else if (isset($_GET['reverse'])) {
        for ($i = 44; $i > 0; $i--) {
            CloneToBuffer($i, $resizedEmoji, $fileName, $frame, $buffer);
            $retouchedFrames[] = $buffer;
        }
        $timingArr = array_reverse($gfe->getFrameDurations());
    } else {
        for ($i = 1; $i < 45; $i++) {
            CloneToBuffer($i, $resizedEmoji, $fileName, $frame, $buffer);
            $retouchedFrames[] = $buffer;
        }
        $timingArr = $gfe->getFrameDurations();
    }

    $gc = new GifCreator();
    $gc->create($retouchedFrames, $timingArr);

    // Set the content-type

    header("Content-type: image/gif");
    echo $gc->getGif();
}