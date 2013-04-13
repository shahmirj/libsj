<?php

require_once 'Zend/Filter.php';

class Core_Filter_Addhttp implements Zend_Filter_Interface
{
    public function filter($value)
    {
        if (preg_match('@^(https?)://(.*)@', $value)) { return $value; }
        else { return "http://" . $value; }

        return $value;
    }
}
