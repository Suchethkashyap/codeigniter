<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	
    public function login()
	{
		$this->load->view('login');
		echo "login page";
	}


	public function register()
	{
		if(isset($_POST['register'])){
			$this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required|min_length[5]');
			$this->form_validation->set_rules('username','Username','required|min_length[5]|matches[password]');
            $this->form_validation->set_rules('phone','Phone','required|min_length[10]');


			if($this->form_validation->run() == TRUE){
				echo "form validated!!";


				$data = array(
					'username'=>$_POST['username'],
					'email'=>$_POST['email'],
					'password'=>md5($_POST['password']),
					'gender'=>$_POST['gender'],
					'created_date'=>date('Y-m-d'),
					'phone'=>$_POST['phone'],

				);
				$this->db->insert('users',$data);

				$this->session->set_flashdata("success","You have been registered !!");
				redirect("auth/register","refresh");
			}
		}


		$this->load->view('register');
	}
}

