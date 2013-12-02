<?php

error_reporting(E_ALL);
ini_set('show_errors', 1);




define('APP_DIR', dirname(__FILE__));

//require_once APP_DIR.'/../ola/funcs.php';

$sPath = isset($_GET['path']) ? $_GET['path'] : '';

$sDir = APP_DIR.'/../goToNepal/media/photos/';
// echo $sDir;

$aContent = dir_content($sDir.$sPath);

// print_r($aContent);
// var_dump($aContent);

$aImages = $aContent;

sort($aImages);

unset($aImages[0]);

// print_r($aImages);

/*
print_r($aImages);

echo '<ul>';
foreach ($aContent as $items => $item) {
	echo '<li><a href="http://localhost/~ash/image-manipulator/index.php?path='.$sPath.'/'.$item.'">'.$item.'</a></li>';
}
echo '</ul>';

//$sFile = APP_DIR.'/../ola/ola-prace/niewiem/konstrukcja.jpg';

echo '<form>';
*/


    
    asort($aImages);


$sFile = isset($_GET['path']) ? APP_DIR.'/../ola/ola-prace/'.$_GET['path'] : APP_DIR.'/wall-1.jpg';

$iWidth = isset($_POST['image']['width']) ? (int)$_POST['image']['width'] : 160;
$iHeight = isset($_POST['image']['height']) ? (int)$_POST['image']['height'] : 120;

$bMargins = isset($_POST['image']['margins']) ? (int)$_POST['image']['margins'] : 120;
// $bMargins = (int)$_POST['image']['margins'];

$sHorCrop = isset($_POST['image']['width_crop']) ? (int)$_POST['image']['width_crop'].'%' : 'center';
$sVerCrop = isset($_POST['image']['height_crop']) ? (int)$_POST['image']['height_crop'].'%' : 'center';

$sScaledWidth = 640;
$sScaledHeight = 480;

$sSourceImage = '<img src="'.basename($sFile).'" width="'.$sScaledWidth.'" height="'.$sScaledHeight.'" />';


$sImg = 'WP_20130924_007.jpg';

$sFile = dirname(__DIR__) . '/goToNepal/media/photos/' . $sImg;
// $sFile = 'http://localhost/~ash/image-manipulator/'.'wall-1.jpg';

echo $sFile;


//if (isset($_POST['image'])) {
    require_once APP_DIR.'/ImageManipulator.php';

    $oImageManipulator = new ImageManipulator();

    $oImageManipulator->loadImage($sFile);

    //$oImageManipulator->resize(320, 200, false, 'center', 'top');
    $oImageManipulator->resize($iWidth, $iHeight, $bMargins, $sHorCrop, $sVerCrop);
    //$oImageManipulator->resize(320, 200, false, 'center', 'top');
    
    //$oImageManipulator->resize(200, 500, true, '10%', 'top');

    //$oImageManipulator->resize(600, 960);
    // $oImageManipulator->resize(960, 600);
    // $oImageManipulator->resize(120, 90);
    // $oImageManipulator->show();
    
    $sNewFile = APP_DIR.'/tmp/img-'.$iWidth.'-'.$iHeight.'.jpg';
    
    // $sNewFile = APP_DIR.'/tmp/'.(isset($_GET['image']['file']) ? $_GET['image']['file'] : 'result.jpg');
    // $oImageManipulator->save($_GET['file']);
    $oImageManipulator->save($sNewFile);
//}


//$oImageManipulator->resize(300, 300);
//$oImageManipulator->show();
//
// $oImageManipulator->resize(100, 300);
// $oImageManipulator->show();

//$oImageManipulator->debug();

/*
		$iWidth = imagesx($rImage);
		$iHeight = imagesy($rImage);
		
		$iDstWidth = 222;
		$iDstHeight = 111;

		$rDstImage = imagecreatetruecolor($iDstWidth, $iDstHeight);
		$rBackground = imagecolorallocate($rDstImage, 200, 55, 15);
		
		imagefill($rDstImage, 0, 0, $rBackground);
		imagecopyresampled($rDstImage, $rImage, 0, 0, 0, 0, $iDstWidth, $iDstHeight, $iWidth, $iHeight);
		
//		$this->_saveToFile($rImage, dirname(__FILE__).'/result.jpg');
//		$this->_saveToFile('result.jpg', $rImage);
//		$this->_sName = dirname(__FILE__).'/image.jpg';

		$sNewimage = dirname(__FILE__).'/image.jpg';
		
		imagejpeg($rDstImage, $sNewimage);
*/



// echo szablonu

// require_once APP_DIR.'/index.html';



function dir_content($sPath, $sExt = null) {
    $aContent = array();
	if ($handle = opendir($sPath)) {
		while (($file = readdir($handle)) !== false) {
			if ($file != '.' && $file != '..') {
			    //echo $file.'_';
//			    if (is_dir($sPath.'/'.$file)) {
//			        if ($bRecursive) {
////			            $aItems = dir_content($sPath.'/'.$file);
////			            sort($aItems);
////        			    $aContent[$file] = $aItems;
//						$aContent[$file] = dir_content($sPath.'/'.$file);
//    			    } else {
//    			        $aContent[] = $file;
//    			    }
//			    } else {
			    	//if ($sExt)
    				$aContent[] = $file;
//				}
			}
		}
		closedir($handle);
	}
	
	return $aContent;
}



