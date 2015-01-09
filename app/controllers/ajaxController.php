<?php
class ajaxController
{
    private $ajaxOutput = '';
    
    public function __construct()
    {
        
    }

    public function getAjaxOutput()
    {
        return $this->ajaxOutput;
    }
    
    public function setAjaxOutput($data)
    {
        $this->ajaxOutput = $data;
    }

    public function __destruct()
    {
        if (!isset($_POST['type'])
                || !isset($_POST['key'])
                || !isset($_POST['value'])
                ) {
            return;
        }
        require 'ajaxView.php';
    }
}
