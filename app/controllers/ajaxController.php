<?php
if (!isset($_POST['type'])
        || !isset($_POST['key'])
        || !isset($_POST['value'])
        ) {
    exit();
}

$ajaxData = '';

require $appPath.'views/page/ajaxView.php';
