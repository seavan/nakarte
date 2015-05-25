<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Authentication/registration controller

 */
class Auth_Controller extends Json_Controller
{

	// Set the name of the template to use

	public $form = Array('email' => '', 'surname' => '', 'name' => '', 'city' => 0);

	public function  __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->template->title = 'НаКарте.kz - Вход';

		$this->template->title = 'НаКарте.kz - Регистрация';
		$this->session= Session::instance();

		$this->db = Database::instance();
		// In Kohana, all views are loaded and treated as objects.
		$view = new View('admin/auth_content');
		$cities = ORM::factory('city')->find_all();
		$cityList = array();
		foreach($cities as $city)
		{
			$cityList[$city->id] = $city->name;
		}
		$view->cities = $cityList;

		$this->template->content = $view;
		$this->template->content->form = $this->form;
		$this->template->content->errors = Array();
	}

	public function captcha()
	{
		$rnd = time();
		// Output html element
		echo "<img alt='Captcha' src='/captcha/default?i=$rnd'>";
	}

	public function login()
	{
		// Form submitted
		if ($_POST)
		{
			$post = new Validation($_POST);
			$post->add_rules('email','required', 'email');
			$post->add_rules('pass', 'required');
			if( $post->validate() )
			{
				$user = ORM::factory('user', $post->email);
				$this->auth = new Auth();

				if ( ! $user->loaded)
				{
					$post->add_error('user', 'login');
				}
				elseif ($this->auth->login($user, $post->pass))
				{
					echo "success";
				}
				else
				{
					$post->add_error('user', 'login');
				}
			}
			$errors = $post->errors('errors');
			foreach($errors as $key => $value)
			{
				echo $value . "<br/>";
			}

		}
		else
		{
			echo "no data";
		}
	}


	public function logout()
	{
		Auth::instance()->logout();
	}

	public function register()
	{
		// Form submitted
		if ($_POST)
		{
			$post = new Validation($_POST);
			$post->pre_filter('trim', TRUE);
			$post->add_rules('email','required', 'email');
			$post->add_rules('name', 'required');
			$post->add_rules('pass', 'required');
			$post->add_rules('captcha', 'required', 'Captcha::valid');

			if( ORM::factory('user')->where('username', $post->email)->find()->loaded )
			{
				$post->add_error('email', 'exists');
			}

			if( $post->validate() )
			{
				// instantiate User_Model and set attributes to the $_POST data
				$user = ORM::factory('user');
				$user->username = $post->email;
				$user->password = $post->pass;
				$user->firstname = $post->name;
				$user->email = $post->email;
				$date = date( 'Y-m-d H:i:s');
				$user->ctime = $date;
				$user->mtime = $date;
				$user->atime = $date;
				$user->status = 'confirmed';
				//$user->city_id = $post->city;

				// if the user was successfully created...
				$user->add(ORM::factory('role', 'login'));
				$user->save();
				// login using the collected data
				$this->auth = new Auth();
				$this->auth->login($user, $post->pass);
				// redirect to somewhere
				echo "success";
				//		url::redirect('map');
			}
			else
			{
				$errors = $post->errors('errors');
				foreach($errors as $key => $value)
				{
					echo $value . "<br/>";
				}
			}

		}
	}


} // End Auth_Controller