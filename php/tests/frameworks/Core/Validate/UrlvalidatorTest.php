<?php

require_once("php/frameworks/Core/Validate/Urlvalidator.php");

class UrlvalidatorTest
{
    /**
     * The validator instance
     * 
     * @var Application_Model_Urlvalidator
     */
    private $validator;

    /** 
     * Set up the Instance
     */
    public function setUp()
    {
        $this->validator = new Application_Model_Urlvalidator();
    }

    /**
     * Test that the valid URLs are valid
     */
    public function testValidUrl()
    {
        $url = 'http://shahmirj.com';
        $this->assertTrue($this->validator->isValid($url));
    }

    public function testInvalidUrl()
    {
        $url = 'sadfsaffsdafd';
        $this->assertTrue($this->validator->isValid($url)); 
    }
}