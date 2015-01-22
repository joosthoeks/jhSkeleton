<?php
class dataController extends Controller
{
    private $dataOutput = '';
    
    public function __construct($config)
    {
        parent::__construct($config);
    }

    public function getDataOutput()
    {
        return $this->dataOutput;
    }
    
    public function setDataOutput($data)
    {
        $this->dataOutput = $data;
    }

    public function __destruct()
    {
        if (!isset($_GET['type'])
                || !isset($_GET['key'])
                || !isset($_GET['value'])
                ) {
            return;
        }
        require 'dataView.php';
    }
}
