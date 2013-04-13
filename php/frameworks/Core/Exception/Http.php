<?php 

class Core_Exception_Http extends Core_Exception
{
    public function getStatus()
    {
        return 500;
    }

    public function getTitle()
    {
        return "Internal Server Error";
    }
}
