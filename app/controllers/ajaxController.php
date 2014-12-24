<?php
if (!isset($_POST['type'])
        || !isset($_POST['key'])
        || !isset($_POST['value'])
        ) {
    exit();
}

$ajaxOutput = '';

require $appPath.'views/page/'.$page.'View.php';
