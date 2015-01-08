<?php
function jhSetIncludePathRecursive($path)
{
    set_include_path(get_include_path().PATH_SEPARATOR.$path);
    $scandir = scandir($path);
    foreach ($scandir as $value) {
        if ($value == '.' || $value == '..')            continue;
        if (is_dir($path.$value)) {
            jhSetIncludePathRecursive($path.$value.'/');
        }
    }
}
function jhClassLoader($className)
{
    $extensions = array('.php', '.class.php', '.inc', '.inc.php');
    $paths = explode(PATH_SEPARATOR, get_include_path());
    foreach ($paths as $path) {
        $filename = $path.$className;
        foreach ($extensions as $ext) {
            if (is_readable($filename.$ext)) {
                require $filename.$ext;
            }
        }
    }
}
function jhCsv2Array($filename)
{
    return array_map('str_getcsv', file($filename));
}
function jhRemoteFile2Str($url)
{
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_USERAGENT, 'Bot');
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 600); // 600 = 10 minutes.
    
    $r = curl_exec($ch);
    $info = curl_getinfo($ch);
    
    curl_close($ch);
    
    if ($info['http_code'] == 200) {
        return $r;
    }
    return FALSE;
}
function jhRemoteFile2Dir($url, $dir)
{
    $fp = fopen($dir.basename($url), "w");
    
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_USERAGENT, 'Bot');
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60); // 60 = 1 minute.
    curl_setopt($ch, CURLOPT_FILE, $fp);
    
    curl_exec($ch);
    $info = curl_getinfo($ch);
    
    curl_close($ch);
    
    fclose($fp);
    
    if ($info['http_code'] == 200) {
        return TRUE;
    }
    return FALSE;
}
function jhCreateFingerprint()
{
    $keys = array(
        'HTTP_USER_AGENT',
        'SERVER_PROTOCOL',
        'HTTP_ACCEPT_CHARTSET',
        'HTTP_ACCEPT_ENCODING',
        'HTTP_ACCEPT_LANGUAGE',
        );
    
    $tmp = '';
    foreach ($keys as $key) {
        if (isset($_SERVER[$key])) {
            $tmp .= $_SERVER[$key];
        }
    }
    
    $result = sha1($tmp);
    return $result;
}
