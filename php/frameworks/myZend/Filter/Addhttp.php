<?php

require_once 'Zend/Filter.php';

class myZend_Filter_Addhttp implements Zend_Filter_Interface
{
	
	public function __construct()
	{
	}

	public function filter($value)
	{
            if (preg_match('@^(https?)://(.*)@', $value)) { return $value; }
            else { return "http://" . $value; }

            return $value;
	}
}
