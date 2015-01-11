<?php
class Config
{
    private $local;
    private $publicPath;
    private $appPath;
    private $url;
    private $sessionDomain;
    private $sessionName;
    private $db;
    
    public function __construct()
    {
        switch ($_SERVER['SERVER_NAME']) {
            case 'local':
            case 'localhost':
                // development:
                $this->local = TRUE;
                $this->publicPath = $_SERVER['DOCUMENT_ROOT'].'/jhSkeleton/jhSkeleton/public/';
                $this->appPath = $this->publicPath.'../app/';
                $this->url = 'http://local/jhSkeleton/jhSkeleton/public/';
                $this->sessionDomain = '.localhost';
                $this->sessionName = 'jhSkeleton';
                $this->db = new PDO('mysql:host=localhost;dbname=jhSkeleton', 'root', 'root');
                error_reporting(-1);
                ini_set('display_errors', '1');
                break;
            default :
                // production:
                $this->local = FALSE;
                $this->publicPath = $_SERVER['DOCUMENT_ROOT'].'/';
                $this->appPath = $this->publicPath.'../app/';
                $this->url = 'http://example.com/';
                $this->sessionDomain = '.example.com';
                $this->sessionName = 'jhSkeleton';
                $this->db = new PDO('mysql:host=localhost;dbname=example', 'user', 'pass');
                error_reporting(0);
                ini_set('display_errors', '0');
//                set_error_handler('jhErrorHandler');
//                set_exception_handler('jhExceptionHandler');
        }
        
        date_default_timezone_set('UTC');
        ini_set('default_charset', 'UTF-8');
        setlocale(LC_ALL,'nl_NL.utf8');
        
        session_set_cookie_params(0, '/', $this->getSessionDomain());
        session_name($this->getSessionName());
        session_start();
        
    }
    
    public function getLocal()
    {
        return $this->local;
    }
    
    public function getPublicPath()
    {
        return $this->publicPath;
    }
    
    public function getAppPath()
    {
        return $this->appPath;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function getSessionDomain()
    {
        return $this->sessionDomain;
    }
    
    public function getSessionName()
    {
        return $this->sessionName;
    }
    
    public function getDb()
    {
        return $this->db;
    }
}
