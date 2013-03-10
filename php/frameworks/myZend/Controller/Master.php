
<?php

class My_Controller_Master extends Zend_Controller_Action
{
	public function init()
	{		
		//Insert Layout Content
		$res = $this->getResponse();
        $res->insert('nav', $this->view->render('index/navigation.phtml'));
        $res->insert('credit', $this->view->render('index/credits.phtml'));

        //Meta
        $this->view->headMeta()->setName('DESCRIPTION', 'I am a programmer, developer and a Systems Architect. In my spare time i maintain my own blog, just to keep my web development brain refreshed.');
        $this->view->headMeta()->setName('KEYWORDS', 'Shahmir Javaid Personal Site Blog');
        $this->view->headMeta()->setName('COPYRIGHT', 'Shahmir Javaid 2011');
        $this->view->headMeta()->setName('AUTHOR', 'Shahmir Javaid');
        $this->view->headMeta()->setName('EMAIL', 'me@shahmirj.com');
        $this->view->headMeta()->setName('DISTIBUTION', 'Global');
        $this->view->headMeta()->setName('RATING', 'General');      
  
        $this->view->headTitle("Shahmir Javaid");
        
        $this->view->inlineScript()->appendFile('http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js');
        $this->view->inlineScript()->appendFile('/js/ganalytics.js');
	}
}
