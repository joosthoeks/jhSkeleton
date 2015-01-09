<?php
class dataController
{
    private $dataOutput = 'bla';
    
    public function __construct()
    {
        
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
