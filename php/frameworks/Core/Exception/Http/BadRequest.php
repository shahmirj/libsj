<?php 

class Core_Exception_Http_BadRequest extends Core_Exception_Http
{
    public function getStatus()
    {
        return 400;
    }

    public function getTitle()
    {
        return "BadRequest";
    }
}
