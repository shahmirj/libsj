<?php

require_once 'Zend/Filter.php';

class Core_Filter_Keywords implements Zend_Filter_Interface
{
    public function filter($value)
    {
        $value = preg_replace("/[^A-Za-z0-9\+\.\?\!\#\-\s]/i", '', $value);
        $value = preg_replace("/\s+/", ' ', $value);
        $value = strtolower($value);
        //$value = str_replace($this->stopwords, "", $value);
        $value = trim($value);

        return $value;
    }
}
