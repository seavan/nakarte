<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Map controller
 
 */
class Cities_Controller extends Template_Controller {

    // Set the name of the template to use
    public $template = 'kohana/template_full';
    public $auto_render = FALSE;

    public function  __construct() {
        parent::__construct();
    }

    public function index() {

        $iterator = ORM::factory('city')->find_all()->as_array();

        foreach ($iterator as $member)
        {
            $members[] = $member->as_array();
        }

        echo json_encode(array('result' => $members));
    }


} // End Auth_Controller