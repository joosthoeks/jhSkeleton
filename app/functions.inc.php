<?php
function csv2Array($filename)
{
    return array_map('str_getcsv', file($filename));
}
function remoteFile2Str($url)
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
function remoteFile2Dir($url, $dir)
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
