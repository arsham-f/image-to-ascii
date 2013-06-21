<?php
//test
function createASCII($file, $character) {
	$info = getimagesize($file);
	
	switch($info['mime']) {
		case 'image/jpeg':
			$im = imagecreatefromjpeg($file);
		break;
		case 'image/gif':
			$im = imagecreatefromgif($file);
		break;
		case 'image/png':
			$im = imagecreatefrompng($file);
		break;
		default:
			echo "File type not supported";
	}
	
	if ($info[0] > 100) {
		$p = 100 / $info[0];
		
		$w = $info[0] * $p;
		$h = $info[1] * $p;
		
		$new = imagecreatetruecolor($w, $h);
		imagecopyresized($new, $im, 0, 0, 0, 0, $w, $h, $info[0], $info[1]);
	} else {
		$w = $info[0];
		$h = $info[1];
		$new = $im;
	}
	
	for ($x = 0; $x < $h; $x++) {
		for ($y = 0; $y < $w; $y++) {
			if ($character == "random") {
				$ch = chr(rand(33, 43));
			}
			else
				$ch = $character;
			$rgb = imagecolorat($new, $y, $x);
			$r = $rgb 	>> 16;
			$g = $rgb 	>> 8 	& 255;
			$b = $rgb 			& 255;
			echo "<span style=\"color:#" . 
				str_pad(dechex($r), 2, '0', STR_PAD_LEFT).
				str_pad(dechex($g), 2, '0', STR_PAD_LEFT).
				str_pad(dechex($b), 2, '0', STR_PAD_LEFT) . "\">".$ch."</span>";
		}
		echo "<br />";
	}
}
?>
