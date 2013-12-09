<?php

$start = microtime(true);

error_reporting(E_ALL);
ini_set('show_errors', 1);

define('APP_DIR', dirname(__FILE__));

// require_once APP_DIR.'/ImageManipulator.php';
// require_once APP_DIR.'/image.php';

$sDir = APP_DIR.'/../goToNepal/media/photos/';

$aParams = array();

if (isset($_GET['img'])) {
	$sImageName = strip_tags($_GET['img']);
}
$aParams['path'] = $sDir . $sImageName;

if (isset($_GET['size'])) {
	$aParts = explode('x', strip_tags($_GET['size']));
	$aParams['width'] = (int)$aParts[0];
	$aParams['height'] = (int)$aParts[1];
}

if (isset($_GET['margins'])) {
	$aParams['margins'] = strip_tags($_GET['margins']);
}


// $aParams['width'] = 320;
// $aParams['height'] = 240;

// execution
$sUrl = getImageUrl($sImageName, $aParams);

header('Content-type: image/jpg');
echo file_get_contents(APP_DIR . '/' . $sUrl);

function getImageUrl($sImageName, $aParams) {

	$sOriginImage = $aParams['path'];

	$iWidth = isset($aParams['width']) ? $aParams['width'] : 320;
	$iHeight = isset($aParams['height']) ? $aParams['height'] : 240;
	$bMargins = isset($aParams['margins']) ? $aParams['margins'] : true;

	$sFileHash = md5_file($sOriginImage);
	//$sFileName = $sFileHash.'-'.$iWidth.'-'.$iHeight.'-'.$bMargins.'.jpg';
	$sFileName = $sFileHash.'-'.$iWidth.'-'.$iHeight.'.jpg';
	$sFilePath = APP_DIR.'/tmp/'.$sFileName;

	if (file_exists($sFilePath)) {
		// echo 'file exists';
	} else {
		//Console.log 'file does not exists';
		require_once APP_DIR.'/php/ImageManipulator.php';

		$oImageManipulator = new ImageManipulator();

		$oImageManipulator->loadImage($sOriginImage);

		$oImageManipulator->resize($iWidth, $iHeight, $bMargins);

		$oImageManipulator->save($sFilePath);
	}

	// image source
	return 'tmp/'.$sFileName;
}

$total = microtime(true) - $start;
// echo (int)($total * 1000).'ms';