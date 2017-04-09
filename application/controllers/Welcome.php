<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 
	public function index() //homepage
	{
		if(!isset($_SESSION)) { 
			session_start();
		}		
		$title['title'] = 'Home';
		$this->load->view('header', $title);
		$this->load->view('welcome_message');
		$this->load->view('footer');
	}
	
	public function about()	{
		if(!isset($_SESSION)) { 
			session_start();
		}
		$title['title'] = 'About'; //lang('About'); //Does not work for some reason
		$this->load->view('header', $title);
		$this->load->view('about');
		$this->load->view('footer');
		
	}
	public function contactUs() {
		if(!isset($_SESSION)) { 
			session_start();
		}		
		$title['title'] = 'Contact Us';// lang('Contact'); //Does not work for some reason
		$this->load->view('header', $title);
		$this->load->view('contactUs');
		$this->load->view('footer');
	}
	public function findPolls()	{
		if(!isset($_SESSION)) { 
			session_start();
		}		
		$title['title'] = 'Find Polls';
		$this->load->view('header', $title);
		$this->load->view('findPolls');
		$this->load->view('footer');
	}
	public function statistics()
	{}
	public function yourPolls() //probably needs to be logged in as well
	{
		if(!isset($_SESSION)) { 
			session_start();
		}		
		$title['title'] = 'Your Polls';
		$this->load->view('header', $title);
		$this->load->view('yourPolls');
		$this->load->view('footer');
	}
	public function account()//needs login before proper usage
	{
		if(!isset($_SESSION)) { 
			session_start();
		}		
		$title['title'] = 'Account';
		$this->load->view('header', $title);
		$this->load->view('account');
		$this->load->view('footer');
	}
	public function createPolls()//needs login before proper usage
	{
		if(!isset($_SESSION)) { 
			session_start();
		}		
		$title['title'] = 'Create Polls';
		$this->load->view('header', $title);
		$this->load->view('createPolls');
		$this->load->view('footer');
	}
	public function guestAdditInfo()//when making a poll as a guest
	{} 

	
	public function signUp() //when you don't have an account, you can use the sign up button to make one
	{
		if(!isset($_SESSION)) { 
			session_start();
		}		
		$title['title'] = 'Sign up';
		$this->load->view('header', $title);
		$this->load->view('signUp');
		$this->load->view('footer');
		
		
	}
	
	public function vahetaKeelt($language = "") //keele vahetamine
	{
		if(!isset($_SESSION)) { 
			session_start();
			$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
		}
		if($language == "")
			$language = "estonian";
		
        $this->session->set_userdata('site_lang', $language);
		header("Location: ". $_SESSION['current_page']);
	}

	
	
	
	
	
		
}
