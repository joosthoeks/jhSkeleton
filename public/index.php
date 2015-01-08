<?php
$pageStartTime = microtime(TRUE);

switch ($_SERVER['SERVER_NAME']) {
    case 'local':
    case 'localhost':
        // development:
        require '../app/bootstrap.inc.php';
        break;
    
    default :
        // production:
        require '../app/bootstrap.inc.php';
        break;
}

$page = 'home';
if (isset($_GET['page'])
        && file_exists($appPath.'controllers/'.basename($_GET['page']).'Controller.php')
        && file_exists($appPath.'views/page/'.basename($_GET['page']).'View.php')
        ) {
    $page = basename($_GET['page']);
}

require $page.'Controller.php';
