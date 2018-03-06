<?php
class My_Controller extends CI_Controller 
{
	protected $upload_path = '';
	protected $controller_name = '';
	protected $model_name = '';
	function __construct() 
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('setting_model');
		$this->permission = $this->setting_model->get_modules();
	}

/**
 * Generates a slug of an string 
 * @param  string $str string to be converted into slug
 * @return string      slug generated
 */
	public function config()
	{
		$this->load->library('upload');
		$config['upload_path'] = $this->upload_path;	
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '1000';
		$config['max_width'] = '1024';
		$config['max_height'] = '1024';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		return $config;
	}

	public function config1()
	{
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		return $config;
	}

	public function manage($id = '')
	{
		if($id='')
		{
			if($this->input->post())
			{
				$data = array(
								'firstname' =>$this->input->post('firstname') ,
								'lastname' =>$this->input->post('lastname') ,
								'gender' =>$this->input->post('gender') 
									 );
				$this->model_name->add($data);
				$referred_from = $this->session->userdata('referred_from');
				redirect($referred_from, 'refresh');
			}
			else
			{
				$data['content'] =$this->load->view('$this->controller_name/add', '', TRUE);	
				$this->load->view('layout/default', $data);

			}
		}
		else
		{
			if($this->input->post())
			{
				$data = array(
								'firstname' =>$this->input->post('firstname') ,
								'lastname' =>$this->input->post('lastname') ,
								'gender' =>$this->input->post('gender') 
									 );
				$this->actors_model->update($id, $data);
				$referred_from = $this->session->userdata('referred_from');
				redirect($referred_from, 'refresh');
			}
			else
			{
				$data['actor'] = $this->actors_model->get_by_id($id);
				$data['content'] =$this->load->view('$this->controller_name/edit', $data, TRUE);	
				$this->load->view('layout/default', $data);
			}
		}
	}

	public function has_permission()
	{
		$setting = $this->setting_model->get_all(); 
		foreach ($setting as $key => $value) 
    	{
      		if($value['role'] == $this->session->userdata('role'))
      		{
        		$k = $key;
        		$permission =  $this->setting_model->get_permission_id($value['id']);
        		$setting[$key]['permission'] = array_column($permission, 'permission');
      		}
    	}
		$this->session->set_userdata('permission', $setting[$k]['permission']);
		return $this->session->userdata('permission');
	}
}