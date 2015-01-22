<?php
class ajaxController extends Controller
{
    private $ajaxOutput = '';
    
    public function __construct($config)
    {
        parent::__construct($config);
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
