<?php
switch ($_SERVER['SERVER_NAME']) {
    case 'local':
    case 'localhost':
        // development:
        error_reporting(-1);
        ini_set('display_errors', '1');
        $local = TRUE;
        $publicPath = $_SERVER['DOCUMENT_ROOT'].'/jhSkeleton/jhSkeleton/public/';
        $appPath = $publicPath.'../app/';
        $db = new PDO('mysql:host=localhost;dbname=jhSkeleton', 'root', 'root');
        $url = 'http://localhost/jhSkeleton/public/';
        break;
    
    default :
        // production:
        error_reporting(0);
        ini_set('display_errors', '0');
        set_error_handler('jhErrorHandler');
        set_exception_handler('jhExceptionHandler');
        $local = FALSE;
        $publicPath = $_SERVER['DOCUMENT_ROOT'].'/';
        $appPath = $publicPath.'../app/';
        $db = new PDO('mysql:host=localhost;dbname=example', 'user', 'pass');
        $url = 'http://example.com/';
        break;
}

date_default_timezone_set('UTC');
ini_set('default_charset', 'UTF-8');
setlocale(LC_ALL,'nl_NL.utf8');

// start session:
session_name('jhSkeleton');
session_start();

$siteName = 'jhSkeleton';
$siteDescription = 'My app skeleton';

require $appPath.'functions.inc.php';

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
