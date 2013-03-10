<?php

/*

Purpose:
	Meta Class is designed to produce the meta tags in HTML using an OOP approach

	The following show the HTML outlay of the exec function in HTML

    <title>Hello</title>
    <meta name="description" content="Whats happening">
    <meta name="keywords" content="Shahmir Javaid">
    <meta name="copyright" content="Shahmir Javaid 200">
    <meta name="author" content="Shahmir Javaid" >
    <meta name="email" content="shahmirj@gmail.com">
    <meta name="Charset" content="UTF-8">
    <meta name="Distribution" content="Global">
    <meta name="Rating" content="General">
    <meta name="Robots" content="INDEX,FOLLOW">
    <meta name="Revisit-after" content="1 Day">
    
Usage:
	
	$m = new Meta();
	$m->title = "Hello World";
	$m->author = "Shahmir Javaid";
	$m->keywords = "Shahmir Javaid Blog";
	$m->exec();
	

*/

class Meta{
	
	public $title;
	public $tags;	
	
	public function __construct($title = null){
		
		//Defaults
		$this->title 		= "Shahmir Javaid";
		$this->description 	= "Shahmir Javaids personal test ground with blog and contact details.";
		$this->keywords		= "Shahmir Javaid Blog Personal Programmer Developer System Architect";
		$this->copyright 	= "shahmirj.com 2008";
		$this->author		= "Shahmir Javaid";
		$this->email		= "me@shahmirj.com";
		#$this->charset		= "UTF-8";
		$this->distribution	= "Global";
		$this->rating		= "General";

		//Not used by the serach engines, they set them as defaults
		#$this->robots		= "INDEX,FOLLOW";
		#$this->revisit		= "1 Day";
		
		if ($title) { $this->title = $title; }
	}
	
	public function __destruct(){
		
	}
	
	public function __set($name, $value){
		
		if ($value == "") { throw new Exception("Empty value for $name __set Meta Class"); }
		if (strtoupper($name) == "REVISIT") { $name = "REVISIT-AFTER"; }
		
		$this->tags[strtoupper($name)] = $value;
	}
	
	public function __get($name){
		
		if ($name == "title"){ return $this->title; }
		else {
			return $this->tags[strtoupper($name)];
		}
	}
	
	public function exec(){
		
		print "\t<!--META TAGS-->\n";
		print "\t<title>" . $this->title . "</title>\n";
		print "\t<meta http-equiv='Content-type' content='text/html;charset=UTF-8' />\n";
		
		foreach ($this->tags as $key=>$value){
			print "\t<meta name='$key' content='$value' />\n";
		}	
	}
}

?>
