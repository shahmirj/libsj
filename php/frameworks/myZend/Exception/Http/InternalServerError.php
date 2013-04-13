<?php 

class myZend_Exception_Http_NotFound extends myZend_Exception_Http
{
    public function getStatus()
    {
        return 500;
    }
}
