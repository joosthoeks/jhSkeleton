<?php
if (!isset($_GET['type'])
        || !isset($_GET['key'])
        || !isset($_GET['value'])
        ) {
    exit();
}

$dataOutput = '';

require $page.'View.php';
