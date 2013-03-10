<?php

require_once 'Zend/Filter.php';

class myZend_Filter_Slug implements Zend_Filter_Interface
{
	
    public function __construct()
    {
    }

    public function filter($value)
    {
        $value = preg_replace("/@/", ' at ', $value);
        $value = preg_replace("/&/", ' and ', $value);
        $value = preg_replace("/£/", ' pound ', $value);
        $value = preg_replace("/#/", ' hash ', $value);
        $value = preg_replace("/[\-+]/", ' ', $value);
        $value = preg_replace("/[\s+]/", ' ', $value);
        $value = preg_replace("/[\.+]/", '.', $value);
        $value = preg_replace("/[^A-Za-z0-9\.\s]/", '', $value);
        $value = preg_replace("/[\s]/", '-', $value);
        $value = preg_replace("/\-\-+/", '-', $value);

        $value = strtolower($value);

        if (substr($value, -1) == "-") { $value = substr($value, 0, -1); }
        if (substr($value, 0, 1) == "-") { $value = substr($value, 1); }

        return $value;
    }
}
