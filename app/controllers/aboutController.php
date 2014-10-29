<?php
$pageTitle = 'About';
$pageDescription = '';
$pageKeywords = '';

// add page specific css:
$requireCssArr = array(
//    'css/example',
);

// add page to layout:
$requireViewArr = array(
//    'div/navigation',
    'page/'.$page,
);

// add page specific js:
$requireJsArr = array(
//    'js/example',
);

// get layout:
require $appPath.'views/template/layout.inc.php';
