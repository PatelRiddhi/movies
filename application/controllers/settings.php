<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends My_Controller 
{

	function __construct() 
	{
		parent::__construct();
		$this->load->model('setting_model');
		$this->load->helper('array');

		if(!$this->session->userdata('username'))
		{
			redirect('admin');
		}

		$permission = parent::has_permission();
		if(!in_array('settings', $permission))
		{
			redirect('dashboard/error');
		}
	}

	public function index()
	{	
			$data['permission'] = array();
			$per = $this->permission;
			foreach ($per as $key=>$value) 
			{
				array_push($data['permission'],$value['name']);
			}
			$data['setting'] = $this->setting_model->get_all();
			foreach ($data['setting'] as $key => $value) 
			{
				$permission = $this->setting_model->get_permission_id($value['id']);
				$data['setting'][$key]['permission'] = array_column($permission,'permission');
			}
			if($this->input->post())
			{
				foreach ($data['setting'] as $key=>$value) 
				{
					$id = $data['setting'][$key]['id'];
					if(array_key_exists($id , $this->input->post()))
					{
						$old_permission = $data['setting'][$key]['permission'];
						$new_permission = $this->input->post($data['setting'][$key]['id']);
						
						//for deleting old resord for update permission
						foreach ($old_permission as $k=>$row) 
						{
							if(in_array($row, $new_permission))
							{
							}
							else
							{
								$id = $data['setting'][$key]['id'];
								$this->setting_model->remove($id , $row);
							}
						}

						// for insert new record for update permission
						foreach ($new_permission as $k=>$row) 
						{
							if(in_array($row, $old_permission))
							{
							}
							else
							{
								$data = array(
											'r_id' => $id ,
											'permission' => $row );
								$this->setting_model->insert($data);
							}
						}
					}
					else
					{

					}
				}
				redirect('dashboard','refresh');
			}
			else
			{ 
				$data['content'] = $this->load->view('setting/index', $data ,TRUE);
				$this->load->view('layout/default', $data);
			}
	}

	public function cancel()
	{
		redirect('dashboard', 'refresh');
	}

	public function get_all()
	{
		return $this->setting_model->get_all();
	}

	public function add_permission()
	{
		if($this->input->post())
		{
				$data = array(
							'name' =>$this->input->post('title')	
							);
				$this->setting_model->add($data, 'modules');
				redirect('dashboard', 'refresh');
		}
		else
		{
			$data['content'] = $this->load->view('setting/add','', TRUE);
			$this->load->view('layout/default', $data);
		}
	}

	public function add_role()
	{
		if($this->input->post())
		{
				$data = array(
							'role' =>$this->input->post('title')	
							);
				$this->setting_model->add($data, 'role');
				redirect('dashboard', 'refresh');
		}
		else
		{
			$data['content'] = $this->load->view('setting/add_role','', TRUE);
			$this->load->view('layout/default', $data);
		}
	}
}

/* End of file settings.php */
/* Location: ./application/controllers/settings.php */