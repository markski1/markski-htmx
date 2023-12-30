<?php

$imagePath = "convertQueue/".$_GET['fileName'].".image";

$type = mime_content_type($imagePath);

switch (strtolower($type)) {
	case "image/png":
		$image = imagecreatefrompng($imagePath);
		break;
	case "image/jpg":
		$image = imagecreatefromjpeg($imagePath);
		break;
	case "image/jpeg":
		$image = imagecreatefromjpeg($imagePath);
		break;
	case "image/gif":
		$image = imagecreatefromgif($imagePath);
		break;
	case "image/webp":
		$image = imagecreatefromwebp($imagePath);
		break;
	case "image/bmp":
		$image = imagecreatefrombmp($imagePath);
		break;
	case "image/tga":
		$image = imagecreatefromtga($imagePath);
		break;
	default:
		exit("err1");
		break;
}

switch ($_GET['format']) {
	case "png":
		header("Content-type: image/png");
		imagepng($image);
		break;
	case "jpg":
		header("Content-type: image/jpg");
		imagejpeg($image);
		break;
	case "jpeg":
		header("Content-type: image/jpeg");
		imagejpeg($image);
		break;
	case "gif":
		header("Content-type: image/gif");
		imagegif($image);
		break;
	case "webp":
		header("Content-type: image/webp");
		imagewebp($image);
		break;
	case "bmp":
		header("Content-type: image/bmp");
		imagebmp($image);
		break;
	default:
		exit("err22");
		break;
}


?>