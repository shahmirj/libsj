<?php 

class Core_Exception_Http_NotFound extends Core_Exception_Http
{
    public function getStatus()
    {
        return 404;
    }

    public function getTitle()
    {
        return "Page Not Found";
    }
}
