<?php

class Check_Controller extends NakarteBase
{
    // Set the name of the template to use
    public $template = 'kohana/template';

    public $authed = false;

    public $session;

    public $userinfo;

    public function  __construct() {
        parent::__construct();
        $this->session = Session::instance();
	if (!Auth::instance()->logged_in()){
	     $this->session->set("requested_url","/".url::current()); // this will redirect from the login page back to this page
        } else{
            $this->authed = true;
	    $this->user = Auth::instance()->get_user(); //now you have access to user information stored in the database
	}

        $this->userinfo = new View('admin/userinfo_content');
    }
}
