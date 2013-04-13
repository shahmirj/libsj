<?php

require_once 'Zend/Filter.php';

class Core_Filter_Slug implements Zend_Filter_Interface
{
    public function filter($value)
    {
        $value = str_replace("@", ' at ', $value);
        $value = str_replace("&", ' and ', $value);
        $value = str_replace("£", ' pound ', $value);
        $value = str_replace("#", ' hash ', $value);
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
