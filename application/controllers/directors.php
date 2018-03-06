<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Directors extends My_Controller 
{
	/**
	 * costructor for load team_model, pagination and start session
	 */
	function __construct() 
	{
		parent::__construct();
		$this->load->model('directors_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->session->set_userdata('permission', $this->router->fetch_class());
		if(!$this->session->userdata('username'))
		{
			redirect('admin');
		}
		$permission = parent::has_permission();
		if(!in_array('directors', $permission))
		{
			redirect('dashboard/error');
		}
        $this->access = $this->session->userdata('access');
        foreach ($this->access as $value) 
		{
			if(in_array('directors', $value))
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

		$data['directors'] = $this->directors_model->total_row(5, $start);
		$config = $this->config1();
		/* For Pagination */
		$config["base_url"] = base_url() . "directors/index";
		$config["total_rows"] = $this->directors_model->total_row_count();
		$config["per_page"] = 5;
	
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['start'] =$start;
		$data['content'] = $this->load->view('directors/index', $data, TRUE);	
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
        $this->directors_model->delete($id);
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
							'lastname' =>$this->input->post('lastname') 
								 );
			$this->directors_model->update($id, $data);
			$referred_from = $this->session->userdata('referred_from');
			redirect($referred_from, 'refresh');
		}
		else
		{
			$data['director'] = $this->directors_model->get_by_id($id);
			$data['content'] =$this->load->view('directors/edit', $data, TRUE);	
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
		if($this->input->post())
		{
			$data = array(
							'firstname' =>$this->input->post('firstname') ,
							'lastname' =>$this->input->post('lastname') 
								 );
			$this->directors_model->add($data);
			redirect('directors');
		}
		else
		{
			$data['content'] =$this->load->view('directors/add', '', TRUE);	
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

		if(empty($this->input->post('select')))
		{
			echo "not selected";
			$referred_from = $this->session->userdata('referred_from');
			redirect($referred_from, 'refresh');
		}
		else
		{
			$ids= $_POST['select'];
			if($this->directors_model->delete_all($ids))
			{
				foreach ($ids as $id) 
				{
					$this->directors_model->delete($id);
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

	public function search()
    {

    	$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		/* For Pagination */
		$config["base_url"] = base_url() . "movies/search";
		$config["total_rows"] = $this->directors_model->total_row_count();
		$config["per_page"] = 5;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
	
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['start'] =$start; 

    	$search = $this->input->post('member_name');
    	if ($search=='') 
    	{
			redirect(base_url('directors'), 'refresh');  
		}
		else
		{
	    	$data['directors'] = $this->directors_model->search($search);
	    	foreach ($data['directors'] as $row)
	        {
?> 
	               <tr>
	                    <td><input type="checkbox" class="checkbBoxClass" id="select" name="select[]" value="<?php echo $row['id'] ?>"></td> 
	                    <td><?php echo $row['id']; ?></td>
	                    <td><?php echo ucfirst($row['firstname']); ?></td>
	                    <td><?php echo ucfirst($row['lastname']); ?></td>
	          
	                    <td><a href= "<?php echo base_url('directors/edit/').$row['id'];?>" > Edit </a> | 
	                    <a href= "<?php echo base_url('directors/delete/').$row['id'];?>" onclick="return confirm('Are you sure you want to delete this data?');">  Delete </a> 
	                  </tr>
<?php
	        }
		}
    }
}
?>