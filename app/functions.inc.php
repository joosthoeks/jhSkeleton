<?php
// app functions:



// core functions:
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
function jhRemoteFile2Str($url, $timeout = 60, $userAgent = 'jhAgent')
{
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    
    $res = curl_exec($ch);
    $info = curl_getinfo($ch);
    
    curl_close($ch);
    
    if ($info['http_code'] == 200) {
        return $res;
    }
    return FALSE;
}
function jhRemoteFile2Dir($url, $dir, $timeout = 60, $userAgent = 'jhAgent')
{
    $fp = fopen($dir.basename($url), "w");
    
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
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
function jhRestClient(
        $url,
        array $data = array(),
        $customRequest = 'GET',
        $timeout = 60,
        $userAgent = 'jhAgent',
        array $httpHeader = array('Content-Type: application/json')
        )
{
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    if (!empty($httpHeader)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
    }
    curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $customRequest);
    if (!empty($data)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    
    $res = curl_exec($ch);
    $info = curl_getinfo($ch);
    
    curl_close($ch);
    
    if ($info['http_code'] == 200) {
        return $res;
    }
    return FALSE;
}
function jhSoapClient(
        $url,
        $xmlEnvelope,
        $customRequest = 'POST',
        $timeout = 60,
        $userAgent = 'jhAgent',
        array $httpHeader = array('Content-Type: text/xml')
        )
{
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    if (!empty($httpHeader)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
    }
    curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $customRequest);
    if (!empty($xmlEnvelope)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlEnvelope);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    
    $res = curl_exec($ch);
    $info = curl_getinfo($ch);
    
    curl_close($ch);
    
    if ($info['http_code'] == 200) {
        return $res;
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
function jhDMS2DEC($deg, $min, $sec)
{
    // Converts DMS (Degrees/Minutes/Seconds) to decimal coord:
    return $deg + ((($min * 60) + ($sec)) / 3600);
}
function jhDEC2DMS($decimalCoord)
{
    // Converts decimal coord to DMS (Degrees/Minutes/Seconds):
    $decimalCoordArr = explode('.', $decimalCoord);
    $degree = $decimalCoordArr[0];
    $time = '0.'.$decimalCoordArr[1];
    
    $time = $time * 3600;
    $min = floor($time / 60);
    $sec = $time - ($min * 60);
    
    return array('deg' => $degree, 'min' => $min, 'sec' => $sec);
}
