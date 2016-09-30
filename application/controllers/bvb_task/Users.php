<?php
class Users extends CI_Controller {
	public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->library(array('session', 'template'));
                $this->load->model('bvb_task/users_model');
                $this->load->model('bvb_task/channels_model');
        }
    public function register()
    {
    	$this->template->addSection("bvb_task/header", "header");
        $this->template->addSection("bvb_task/side_menu", "left");
        $this->template->addSection("bvb_task/register_view", "center");
        $this->template->render("Test application");
    }

    public function login()
    {
    	$this->template->addSection("bvb_task/header", "header");
        $this->template->addSection("bvb_task/side_menu", "left");
        $this->template->addSection("bvb_task/login_view", "center");
        $this->template->render("Test application");
    }

    function logout()
        {
            $this->session->unset_userdata('logged_in');
            redirect('main_ctrl','refresh');
        }


    public function delete_channel($channel_id)
    {
    	$this->channels_model->delete_channel($channel_id);
    	redirect('main_ctrl/profile', 'refresh');
    }

    public function verify_login()
	{
	   //This method will have the credentials validation
	   $this->load->library('form_validation');
	 
	   $this->form_validation->set_rules('email', 'Email', 'required');
	   $this->form_validation->set_rules('password', 'Password', 'required|callback_check_login_func');
	 
	   if($this->form_validation->run() == FALSE)
	   {
	     //Field validation failed.  User redirected to login page
	   		$this->template->addSection("bvb_task/header", "header");
            $this->template->addSection("bvb_task/side_menu", "left");
		    $this->template->addSection("bvb_task/login_view", "center");
    		$this->template->render("Test application");
	   }
	   else
	   {
	     //Go to private area
	     redirect('main_ctrl', 'refresh');
	   }
	}

	public function verify_registration()
	{
	   //This method will have the credentials validation
	   $this->load->library('form_validation');
	 
	   $this->form_validation->set_rules('password', 'Password', 'trim|required');
	   $this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]');
	   $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|callback_check_registration_func');
	 
	   if($this->form_validation->run() == FALSE)
	   {
	     //Field validation failed.  User redirected to login page
	     	$this->template->addSection("bvb_task/header", "header");
            $this->template->addSection("bvb_task/side_menu", "left");
            $this->template->addSection("bvb_task/register_view", "center");
            $this->template->render("Test application");
	   }
	   else
	   {
	     //Go to private area
	   	$message = array(
	   		'message_type' => 'bg-success',
	   		'message_body' => 'Account successfully created'
	   		);
	   	$this->session->set_flashdata('flash_message', 'value');
	    redirect('main_ctrl', 'refresh');
	   }
	}

	public function check_login_func()
	{
		$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
			 );

		$result = $this->users_model->login_user($data);

		if ($result != 0) {
			$sess_array = array(
				'id' => $result[0]['id'],
				'username' => $data['email']
			);
		$this->session->set_userdata('logged_in', $sess_array);
		return TRUE;
		}
		else
	   {
	     $this->form_validation->set_message('check_login_func', 'Invalid username or password');
	     return FALSE;
	   }
	}

	public function check_registration_func()
	{
		$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			 );

		$result = $this->users_model->register_user($data);

		if ($result) {
		$this->form_validation->set_message('check_registration_func', 'Account succesfully created');
		return TRUE;
		}
		else
	   {
	     $this->form_validation->set_message('check_registration_func', 'Invalid email');
	     return FALSE;
	   }
	}
}