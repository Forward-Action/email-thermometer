<?php
date_default_timezone_set('Europe/London');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
header("Content-Type: image/png");

$url = isset($_GET['geturl']) ? $_GET['geturl'] : 'https://secure.greenpeace.org.uk/page/contribute_c/joe-test-string/xml'; // xml link
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
$data = curl_exec($ch); // execute curl request
curl_close($ch);

$xml = simplexml_load_string($data);

function convertToRGB($hex)
{
    $newRGB = array();
    $hex = str_split($hex, 2);

    foreach ($hex as &$value) {
        array_push($newRGB, hexdec($value));
    }
    return $newRGB;
}

// Set data variables
$t = isset($_GET['datestr']) ? $_GET['datestr'] : time(); // as if it were an api call
$date_src = date("M jS", $t).' at '.date("g:ia", $t);
$contributed_src = isset($_GET['contributed']) ? $_GET['contributed'] : floatval($xml->campaign['amount']);
$goal_src = isset($_GET['goal']) ? $_GET['goal'] : floatval($xml->campaign['goal']);
$contributions_src = isset($_GET['contributions']) ? $_GET['contributions'] : round($xml->campaign['contributions']);

//currency
if (isset($_GET['currency'])) {
    switch ($_GET['currency']) {
        case 'GBP':
            $currency = '£';
            break;
        case 'EUR':
            $currency = '€';
            break;
        case 'USD':
        case 'AUD':
        case 'CAD':
            $currency = '$';
            break;
        default:
            $currency = '£';
            break;
    }
} else {
    $currency = '£';
}

// Display vars
$show_center_perc = isset($_GET['showperc']) ? $_GET['showperc'] : 'true';
$show_date = isset($_GET['showdate']) ? $_GET['showdate'] : 'true';
$show_contributions = isset($_GET['showcontributions']) ? $_GET['showcontributions'] : 'true';
$show_contributed = isset($_GET['showcontributed']) ? $_GET['showcontributed'] : 'true';
$half_size = isset($_GET['halfsize']) ? $_GET['halfsize'] : 'false';
$transBG = isset($_GET['transbg']) ? $_GET['transbg'] : 'true';

// Colour vars
$textColour = isset($_GET['textcolour']) ? $_GET['textcolour'] : '1412cf';
$barColour = isset($_GET['barcolour']) ? $_GET['barcolour'] : '4bcc67';
$labelColour = isset($_GET['labelcolour']) ? $_GET['labelcolour'] : '464646';
$bgColour = isset($_GET['bgcolour']) ? $_GET['bgcolour'] : 'ffffff';

$perc_calc = round(($contributed_src / $goal_src) * 100);

// create image and set background to transparent
if ($half_size==='true') {
    $image = imagecreatetruecolor(620, 150);
} else {
    $image = imagecreatetruecolor(620, 200);
}

if ($transBG==='true') {
    imagefill($image, 0, 0, 0x7fff0000);
} else {
    $bg_src = convertToRGB($bgColour);
    $bg = imagecolorallocate($image, $bg_src[0], $bg_src[1], $bg_src[2]);
    imagefill($image, 0, 0, $bg);
}
imagealphablending($image, true);
imagesavealpha($image, true);

/*
putenv('GDFONTPATH=' . realpath('.'));
// Set vars for fonts and colours
$font_normal = 'OpenSans-Regular';
$font_semi = 'OpenSans-Semibold';
$font_bold = 'OpenSans-Bold';
*/

$font_normal = 'fonts/OpenSans-Regular.ttf';
$font_semi = 'fonts/OpenSans-Semibold.ttf';
$font_bold = 'fonts/OpenSans-Bold.ttf';

$primSrc = convertToRGB($textColour);
$primary = imagecolorallocatealpha($image, $primSrc[0], $primSrc[1], $primSrc[2], 0);

$labelSrc = convertToRGB($labelColour);
$label = imagecolorallocatealpha($image, $labelSrc[0], $labelSrc[1], $labelSrc[2], 0);

$barSrc = convertToRGB($barColour);
$bar = imagecolorallocatealpha($image, $barSrc[0], $barSrc[1], $barSrc[2], 0);

// Contributed label
if ($show_contributed==='true') {
    $contributed_label = 'CONTRIBUTED';
    imagettftext($image, 13, 0, 15, 28, $label, $font_semi, $contributed_label);
    // Contributed value text
    if ($currency == '€') {
        $contributed = str_replace(",00", "", number_format($contributed_src, 2, ',', '.').' '.$currency);
    } else {
        $contributed = str_replace(".00", "", $currency.number_format($contributed_src, 2));
    }
    imagettftext($image, 22, 0, 15, 60, $primary, $font_bold, $contributed);
}

// Goal label
$goal_label = 'GOAL';
$dimensions4 = imagettfbbox(13, 0, $font_semi, $goal_label);
$textWidth4 = abs($dimensions4[4] - $dimensions4[0]);
$x4 = imagesx($image) - $textWidth4;
imagettftext($image, 13, 0, ($x4 - 17), 28, $label, $font_semi, $goal_label);
// Right aligned goal value text
if ($currency == '€') {
    $goal = str_replace(",00", "", number_format($goal_src, 2, ',', '.').' '.$currency);
} else {
    $goal = str_replace(".00", "", $currency.number_format($goal_src, 2));
}
$dimensions = imagettfbbox(22, 0, $font_bold, $goal);
$textWidth = abs($dimensions[4] - $dimensions[0]);
$x = imagesx($image) - $textWidth;
imagettftext($image, 22, 0, ($x - 17), 60, $primary, $font_bold, $goal);

// Contributions
if ($show_contributions==='true') {
    // label
    $contributions_label = 'CONTRIBUTIONS';
    imagettftext($image, 10, 0, 15, 160, $label, $font_semi, $contributions_label);
    // value
    $contributions = number_format($contributions_src);
    imagettftext($image, 20, 0, 15, 186, $label, $font_semi, $contributions);
}

// Date display, right aligned
if ($show_date==='true') {
    $date = 'As of '.$date_src;
    $dimensions2 = imagettfbbox(14, 0, $font_semi, $date);
    $textWidth2 = abs($dimensions2[4] - $dimensions2[0]);
    $x2 = imagesx($image) - $textWidth2;
    imagettftext($image, 14, 0, ($x2 - 17), 186, $label, $font_semi, $date);
}

$zero_label = '0%';
imagettftext($image, 16, 0, 15, 130, $label, $font_semi, $zero_label);

$hund_label = '100%';
imagettftext($image, 16, 0, 553, 130, $label, $font_semi, $hund_label);

// add the bar template over the image
$barTemp = imageCreateFromPng('template_bar.png');
imagefilter($barTemp, IMG_FILTER_COLORIZE, $barSrc[0], $barSrc[1], $barSrc[2], 0);
imageAlphaBlending($barTemp, true);
imageSaveAlpha($barTemp, true);
imagecopy($image, $barTemp, 0, 0, 0, 0, 620, 200);

// add the text template over the image
$textTemp = imageCreateFromPng('template_notches.png');
imagefilter($textTemp, IMG_FILTER_COLORIZE, $labelSrc[0], $labelSrc[1], $labelSrc[2], 0);
imageAlphaBlending($textTemp, false);
imageSaveAlpha($textTemp, true);
imagecopy($image, $textTemp, 0, 0, 0, 0, 620, 200);


// 17 602
// This is the progress bar
if ($perc_calc>=100) {
    $bar_width = 602;
} else {
    $bar_width = round(($contributed_src * (602-17)) / $goal_src) + 17;
}
imagefilledrectangle($image, 17, 78, $bar_width, 105, $bar);

// Centered percent display on the progress bar
if ($show_center_perc==='true') {
    $perc = number_format($perc_calc).'%';
    $dimensions3 = imagettfbbox(14, 0, $font_semi, $perc);
    $textWidth3 = abs($dimensions3[4] - $dimensions3[0]);
    $x3 = ceil((imagesx($image) - $textWidth3) / 2);
    imagettftext($image, 14, 0, $x3, 98.5, $label, $font_semi, $perc);
}

imagepng($image);
imagedestroy($image);
