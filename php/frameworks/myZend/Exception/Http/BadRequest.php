<?php 

class myZend_Exception_Http_Forbidden extends myZend_Exception_Http
{
    public function getStatus()
    {
        return 400;
    }
}
