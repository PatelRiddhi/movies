<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends My_Controller 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->model('admin_model','al');
	}

	public function index()
	{
		$this->load->view('admin/login');
	}

	public function login()
	{
		if($this->input->post())
		{
			$data = array(
							'username' => $this->input->post('username'),
							'password' => $this->input->post('password')
						);
			if($this->al->check_data($data))
			{
				$this->session->set_userdata('username', $data['username']);
				redirect('dashboard');
			}
			else
			{
				redirect('admin');
			}
		}
		else
		{
			redirect('admin');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		redirect('admin/login');
	}
}
