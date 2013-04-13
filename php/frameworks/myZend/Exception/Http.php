<?php 

class myZend_Exception_Http extends myZend_Exception
{
    public function getStatus()
    {
        return 500;
    }
}
