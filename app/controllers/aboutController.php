<?php
$pageTitle = 'About';
$pageDescription = 'About page!';
$pageKeywords = 'about, page';

// add page specific css:
$requireCssArr = array(
//    'css/example',
);

// add page to layout:
$requireViewArr = array(
//    'div/navigation',
    'page/'.$page,
);

// get layout:
require $appPath.'views/template/layout.inc.php';
