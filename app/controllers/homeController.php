<?php
class homeController extends Controller
{
    private $pageTitle = 'Home';
    private $pageDescription = 'Welcome page!';
    private $pageKeywords = 'home, welcome, page';
    
    // add page specific css:
    private $cssArr = array(
    //    'css/example',
    );

    // add page to layout:
    private $viewArr = array(
    //    'div/navigation',
        'page/home',
    );

    // add page specific js:
    private $jsArr = array(
    //    'js/example',
    );
    
    public function getPageTitle()
    {
        return $this->pageTitle;
    }
    
    public function getPageDescription()
    {
        return $this->pageDescription;
    }
    
    public function getPageKeywords()
    {
        return $this->pageKeywords;
    }
    
    public function getCssArr()
    {
        return $this->cssArr;
    }
    
    public function getViewArr()
    {
        return $this->viewArr;
    }
    
    public function getJsArr()
    {
        return $this->jsArr;
    }
    
    public function __destruct()
    {
        $settings = new Settings();
        // get layout:
        require 'layout.inc.php';
    }
}
