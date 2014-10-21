<?php
$pageTitle = 'Home';
$pageDescription = 'Welcome page!';
$pageKeywords = 'home, welcome, page';

// add page to layout:
$requireViewArr = array(
//    'div/navigation',
    'page/'.$page,
);

// get layout:
require $appPath.'views/template/layout.inc.php';
