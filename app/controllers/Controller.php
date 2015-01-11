<?php
class Controller
{
    private $config;
    private $page = 'home';
    
    public function __construct($config)
    {
        $this->config = $config;
        
        if (isset($_GET['page'])
                && file_exists($config->getAppPath().'controllers/'.basename($_GET['page']).'Controller.php')
                && file_exists($config->getAppPath().'views/page/'.basename($_GET['page']).'View.php')
                ) {
            $this->page = basename($_GET['page']);
        }
    }
    
    public function getConfig()
    {
        return $this->config;
    }

    public function getPage()
    {
        return $this->page;
    }
    
    public function __destruct()
    {
        $pageController = $this->getPage().'Controller';
        new $pageController($this->getConfig());
    }
}
