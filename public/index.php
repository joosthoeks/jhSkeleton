<?php
$pageStartTime = microtime(TRUE);
/*
// error and exception handler functions:
function jhErrorHandler($error_nummer, $error_melding, $error_bestand, $error_regel, $error_vars)
{
    $output = '<div>'.
            '<span style="color:#f00;">There was an <b>ERROR</b> in script:</span>'.
            '<br />'.
            "'$error_bestand'".
            '<br />'.
            'Line: '.$error_regel.
            '<br />'.
            $error_melding.
            '<br />'.
            'Date/time: '.date('Y-m-d H:i:s').
            '<br />'.
            'IP: '.$_SERVER['REMOTE_ADDR'].
            '<br />'.
            'Browser: '.$_SERVER['HTTP_USER_AGENT'].
            '<br />'.
            '<pre>'.print_r($error_vars, 1).'</pre>'.
            '<br />'.
            '</div>';
    error_log(str_replace('<br />', PHP_EOL, $output), 1, 'webmaster@example.com');
    echo '<div style="color:#f00;">Sorry, there was an error! The webmaster has been notified!</div>';
    exit();
}
function jhExceptionHandler($e)
{
    $output = '<div>'.
            '<span style="color:#f00;">There was an <b>EXCEPTION</b> in script:</span>'.
            '<br />'.
            "'{$e->getFile()}'".
            '<br />'.
            'Line: '.$e->getLine().
            '<br />'.
            $e->getMessage().
            '<br />'.
            'Date/time: '.date('Y-m-d H:i:s').
            '<br />'.
            'IP: '.$_SERVER['REMOTE_ADDR'].
            '<br />'.
            'Browser: '.$_SERVER['HTTP_USER_AGENT'].
            '<br />'.
            '<br />'.
            'getcode: '.$e->getCode().
            '<br />'.
            'getfile: '.$e->getFile().
            '<br />'.
            'getline: '.$e->getLine().
            '<br />'.
            'getmessage: '.$e->getMessage().
            '<br />'.
            'gettrace: '.$e->getTrace().
            '<br />'.
            'gettraceasstring: '.$e->getTraceAsString().
            '</div>';
    error_log(str_replace('<br />', PHP_EOL, $output), 1, 'webmaster@example.com');
    echo '<div style="color:#foo;">Sorry, there was an error! The webmaster has been notified!</div>';
    exit();
}
*/
require '../app/Config.php';
$config = new Config();

require $config->getAppPath().'functions.inc.php';

jhSetIncludePathRecursive($config->getAppPath());
jhSetIncludePathRecursive($config->getAppPath().'../libs/');

spl_autoload_register('jhClassLoader');

$page = 'home';
if (isset($_GET['page'])
        && file_exists($config->getAppPath().'controllers/'.basename($_GET['page']).'Controller.php')
        && file_exists($config->getAppPath().'views/page/'.basename($_GET['page']).'View.php')
        ) {
    $page = basename($_GET['page']);
}

$pageController = $page.'Controller';
$controller = new $pageController($page);

