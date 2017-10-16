<?php
header("Content-Type: image/png");

// Set data variables
$t = isset($_GET['datestr']) ? $_GET['datestr'] : 1508168978; // as if it were an api call
$date_src = date("M jS", $t).' at '.date("g:ia", $t);
$contributed_src = isset($_GET['contributed']) ? $_GET['contributed'] : 37820504;
$goal_src = isset($_GET['goal']) ? $_GET['goal'] : 49000000;
$contributions_src = isset($_GET['contributions']) ? $_GET['contributions'] : 1248258;

// Display vars
$show_center_perc = isset($_GET['showperc']) ? $_GET['showperc'] : true;
$show_date = isset($_GET['showdate']) ? $_GET['showdate'] : true;
$show_contributions = isset($_GET['showcontributions']) ? $_GET['showcontributions'] : true;
$half_size = isset($_GET['halfsize']) ? $_GET['halfsize'] : false;

$perc_calc = round(($contributed_src / $goal_src) * 100);

// create image and set background to transparent
if ($half_size==true) {
    $image = imagecreatetruecolor(620, 150);
} else {
    $image = imagecreatetruecolor(620, 200);
}
imagefill($image, 0, 0, 0x7fff0000);
imagealphablending($image, true);
imagesavealpha($image, true);

// Set vars for fonts and colours
$font_normal = 'OpenSans-Regular.ttf';
$font_semi = 'OpenSans-Semibold.ttf';
$font_bold = 'OpenSans-Bold.ttf';
$blue = imagecolorallocatealpha($image, 20, 18, 207, 0);
$grey = imagecolorallocatealpha($image, 76, 85, 92, 0);
$green = imagecolorallocatealpha($image, 75, 204, 103, 0);

// 17 602
// This is the progress bar
$bar_width = round(($contributed_src * (602-17)) / $goal_src) + 17;
imagefilledrectangle($image, 17, 78, $bar_width, 105, $green);

// Contributed value text
$contributed = '£'.number_format($contributed_src);
imagettftext($image, 22, 0, 15, 55, $blue, $font_bold, $contributed);

// Right aligned goal value text
$goal = '£'.number_format($goal_src);
$dimensions = imagettfbbox(22, 0, $font_bold, $goal);
$textWidth = abs($dimensions[4] - $dimensions[0]);
$x = imagesx($image) - $textWidth;
imagettftext($image, 22, 0, ($x - 17), 55, $blue, $font_bold, $goal);

// Contributions
if ($show_contributions===true) {
    $contributions_label = 'CONTRIBUTIONS';
    imagettftext($image, 10, 0, 15, 160, $grey, $font_semi, $contributions_label);
    $contributions = number_format($contributions_src);
    imagettftext($image, 20, 0, 15, 186, $grey, $font_semi, $contributions);
}

// Date display, right aligned
if ($show_date===true) {
    $date = 'As of '.$date_src;
    $dimensions2 = imagettfbbox(14, 0, $font_semi, $date);
    $textWidth2 = abs($dimensions2[4] - $dimensions2[0]);
    $x2 = imagesx($image) - $textWidth2;
    imagettftext($image, 14, 0, ($x2 - 17), 186, $grey, $font_semi, $date);
}

// Centered percent display on the progress bar
if ($show_center_perc===true) {
    $perc = $perc_calc.'%';
    $x3 = (imagesx($image) / 2);
    imagettftext($image, 14, 0, ($x3 - 17), 98.5, $grey, $font_semi, $perc);
}

// add the template over the image
$imgPng = imageCreateFromPng('template.png');
imageAlphaBlending($imgPng, true);
imageSaveAlpha($imgPng, true);
imagecopy($image, $imgPng, 0, 0, 0, 0, 620, 200);


imagepng($image);
imagedestroy($image);
