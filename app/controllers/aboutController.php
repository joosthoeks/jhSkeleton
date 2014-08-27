<?php
$pageTitle = 'About';
$pageDescription = 'About page!';
$pageKeywords = 'about, page';

$requireViewArr = array(
    'div/navigation',
    'page/'.$page,
);

// get layout:
require $appPath.'views/template/layout.inc.php';
