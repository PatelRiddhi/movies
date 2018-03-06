<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actors extends My_Controller 
{
	/**
	 * costructor for load team_model, pagination and start session
	 */
	function __construct() 
	{
		parent::__construct();
		$this->load->model('actors_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->session->set_userdata('permission', $this->router->fetch_class());
		if(!$this->session->userdata('username'))
		{
			redirect('admin');
		}
		$permission = parent::has_permission();
		if(!in_array('actors', $permission))
		{
			redirect('dashboard/error');
		}
		$this->access = $this->session->userdata('access');
		foreach ($this->access as $value) 
		{
			if(in_array('actors', $value))
			{
				$this->a = $value;
			}
		}
	}

	/**
	 * This function is for redirect the index page of this controller with some pagination
	 * @param  integer $start this parameter is for pagination start index which we selected
	 * @return [boolean]         
	 */
	public function index($start=0)
	{
		$data['actors'] = $this->actors_model->total_row(5, $start);
		$config = $this->config1();
		// $config['cur_tag_open'] = '&nbsp;<a class="current">';
		// $config['cur_tag_close'] = '</a>';
		// $config['next_link'] = 'Next';
		// $config['prev_link'] = 'Previous';

		/* For Pagination */
		$config["base_url"] = base_url() . "actors/index";
		$config["total_rows"] = $this->actors_model->total_row_count();
		$config["per_page"] = 5;
		// $config['cur_tag_open'] = '&nbsp;<a class="current">';
		// $config['cur_tag_close'] = '</a>';
	
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['start'] =$start;
		$data['content'] = $this->load->view('actors/index', $data, TRUE);	
		$this->load->view('layout/default', $data);
		$this->session->set_userdata('referred_from', current_url());
	}

	/**
	 * This function delete data which we want to select by id
	 * @param  [integer] $id select id for delete data from the table
	 * @return [boolean]    
	 */
	public function delete($id)
	{
		if($this->a['delete'] == 0)
       	{
       		redirect('dashboard/error');
       	}
		$this->actors_model->delete($id);
		$referred_from = $this->session->userdata('referred_from');
		redirect($referred_from, 'refresh');
	}

	/**
	 * This function is for update data which we want to select by id
	 * @param  [integer] $id select id for update data from the table
	 * @return [boolean] 
	 */
	public function edit($id)
	{
		if($this->a['update'] == 0)
       	{
       		redirect('dashboard/error');
       	}
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
			$data['content'] =$this->load->view('actors/edit', $data, TRUE);	
			$this->load->view('layout/default', $data);
		}
	}

	/**
	 * This function is simply we can redirect index page for this controller to avoid any add or update prodess
	 * @return [boolean] 
	 */
	public function cancel()
	{
		$referred_from = $this->session->userdata('referred_from');
		redirect($referred_from, 'refresh');
	}

	/**
	 * This function is for add some data in databse or table
	 */
	public function add()
	{
		if($this->a['insert'] == 0)
       	{
       		redirect('dashboard/error');
       	}
		foreach ($this->access as $key=>$value) 
        {
            if($value['insert'] == 0)
          	{
          		redirect('dashboard/error');
          	}
        }
		if($this->input->post())
		{
			$data = array(
							'firstname' =>$this->input->post('firstname') ,
							'lastname' =>$this->input->post('lastname') ,
							'gender' =>$this->input->post('gender') 
								 );
			$this->actors_model->add($data);
			$referred_from = $this->session->userdata('referred_from');
			redirect($referred_from, 'refresh');
		}
		else
		{
			$data['content'] =$this->load->view('actors/add', '', TRUE);	
			$this->load->view('layout/default', $data);

		}
	}

	/**
	 * This Function is delete selected data
	 * @return [boolean] if data is deleted from the database then it will return true otherwise return false
	 */
	public function delete_all()
	{
		if($this->a['delete_all'] == 0)
       	{
       		redirect('dashboard/error');
       	}
       	
		foreach ($this->access as $key=>$value) 
        {
            if($value['delete_all'] == 0)
          	{
          		redirect('dashboard/error');
          	}
        }
		if(empty($this->input->post('select')))
		{
			echo "not selected";
			$referred_from = $this->session->userdata('referred_from');
			redirect($referred_from, 'refresh');
		}
		else
		{
			$ids= $_POST['select'];
			if($this->actors_model->delete_all($ids))
			{
				foreach ($ids as $id) 
				{
					$this->actors_model->delete($id);
				}
				$referred_from = $this->session->userdata('referred_from');
				redirect($referred_from, 'refresh');
			}
			else
			{
				echo 'not deleted';
				$referred_from = $this->session->userdata('referred_from');
				redirect($referred_from, 'refresh');
			}
		}
	}

   	public function search($start=0)
    {

    	$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		/* For Pagination */
		$config["base_url"] = base_url() . "actors/search";
		$config["total_rows"] = $this->actors_model->total_row_count();
		$config["per_page"] = 5;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
	
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['start'] =$start;

    	$search = $this->input->post('member_name');
    	if ($search=='') 
    	{
			redirect(base_url('actors'), 'refresh');  
		}
		else
		{
	    	$data['actors'] = $this->actors_model->search($search);
	    	foreach ($data['actors'] as $row)
	        {
?> 
	               <tr>
	                    <td><input type="checkbox" class="checkbBoxClass" id="select" name="select[]" value="<?php echo $row['id'] ?>"></td> 
	                    <td><?php echo $start+1; $start++; ?></td>
	                    <td><?php echo ucfirst($row['firstname']); ?></td>
	                    <td><?php echo ucfirst($row['lastname']); ?></td>
	                    <td><?php if($row['gender'] == 'F')
	                              {
	                                echo "Female";
	                              }
	                              elseif($row['gender'] == 'M')
	                              {
	                                echo "Male";
	                              }
	                        ?></td>
	                    <td><a href= "<?php echo base_url('actors/edit/').$row['id'];?>" > Edit </a> | 
	                    <a href= "<?php echo base_url('actors/delete/').$row['id'];?>" onclick="return confirm('Are you sure you want to delete this data?');">  Delete </a> 
	                  </tr>
<?php
	        }
		}
    }
}
?>