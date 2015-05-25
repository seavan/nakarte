<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Map controller
 
 */
class Rubrics_Controller extends Check_Controller {

    // Set the name of the template to use
    public $template = 'kohana/template_full';



    public function  __construct() {
        parent::__construct();
    }

    public function index() {

        //$map = ORM::factory('site', 1);

        // In Kohana, all views are loaded and treated as objects.
        $this->template->content = new View('rubric_content');

        $this->template->title = 'НаКарте.kz - Разделы';
        $this->rubrics = ORM::factory('rubric')->where('rubric_id', null)->find_all();

    }

    public function show($id)
    {
        $rubric = ORM::factory('rubric', $id);
        $this->template->content = new View('rubric_content');

        $this->template->title = 'НаКарте.kz - ' . $rubric->name;
        $this->rubrics = ORM::factory('rubric')->where('rubric_id', $rubric->id)->find_all();
    }



    public function __call($method, $arguments) {
        // Disable auto-rendering
        $this->auto_render = FALSE;

        // By defining a __call method, all pages routed to this controller
        // that result in 404 errors will be handled by this method, instead of
        // being displayed as "Page Not Found" errors.
        echo 'This text is generated by __call. If you expected the index page, you need to use: welcome/index/'.substr(Router::$current_uri, 8);
    }

} // End Auth_Controller