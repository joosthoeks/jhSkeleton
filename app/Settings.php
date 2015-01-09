<?php
class Settings
{
    private $siteName = 'jhSkeleton';
    private $siteDescription = 'My app skeleton';
    private $siteNavigationArr = array(
        'home' => 'Home',
        'about' => 'About',
    );
    
    public function getSiteName()
    {
        return $this->siteName;
    }
    
    public function getSiteDescription()
    {
        return $this->siteDescription;
    }
    
    public function getSiteNavigationArr()
    {
        return $this->siteNavigationArr;
    }
}
