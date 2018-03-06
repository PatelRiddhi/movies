<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends My_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		if(!$this->session->userdata('username'))
		{
			redirect('admin');
		}
	}
	public function index()
	{
		//$username = $this->session->userdata('username');
		$role = $this->admin_model->get_role($this->session->userdata('username'));
		$this->session->set_userdata('role', $role[0]['role']);
		$role_id = $this->admin_model->get_role_id($role[0]['role']);
		$access = $this->admin_model->get_access_data($role_id[0]['id']);
		$this->session->set_userdata('access', $access);
		$data['content'] = array();
		$this->load->view('layout/default', $data);
		$this->session->set_userdata('current_url', current_url());

	}

	public function error()
	{
		$this->load->view('error');
	}

	public function go_back()
	{
			redirect('current_url','refresh');
	}
}
