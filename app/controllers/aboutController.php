<?php
class aboutController
{
    private $page;
    private $pageTitle = 'About';
    private $pageDescription = '';
    private $pageKeywords = '';
    
    // add page specific css:
    private $cssArr = array(
    //    'css/example',
    );

    // add page to layout:
    private $viewArr = array(
    //    'div/navigation',
        'page/about',
    );

    // add page specific js:
    private $jsArr = array(
    //    'js/example',
    );
    
    public function __construct($page)
    {
        $this->page = $page;
    }
    
    public function getPage()
    {
        return $this->page;
    }

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
