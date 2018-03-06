<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movies extends My_Controller 
{
	/**
	 * costructor for load team_model, pagination and start session
	 */
	function __construct() 
	{
		parent::__construct();
		$this->load->model('movies_model');
		$this->load->model('actors_model');
		$this->load->model('directors_model');
		$this->load->model('genres_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->session->set_userdata('permission', $this->router->fetch_class());
		if(!$this->session->userdata('username'))
		{
			redirect('admin');
		}
		$permission = parent::has_permission();
		if(!in_array('movies', $permission))
		{
			redirect('dashboard/error');
		}
		$this->access = $this->session->userdata('access');
		foreach ($this->access as $value) 
		{
			if(in_array('movies', $value))
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
		$data['movies'] = $this->movies_model->total_row(10, $start);
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';

		/* For Pagination */
		$config["base_url"] = base_url() . "movies/index";
		$config["total_rows"] = $this->movies_model->total_row_count();
		$config["per_page"] = 10;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
	
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['start'] =$start; 
		$data['content'] = $this->load->view('movies/index', $data, TRUE);	
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
		$this->movies_model->delete($id);
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
							'title' =>$this->input->post('title') ,
							'year' =>$this->input->post('year') ,
							'duration' =>$this->input->post('duration') ,
							'language' =>$this->input->post('language') ,
							'release_date' =>$this->input->post('release_date') ,
							'country' =>$this->input->post('country') 
						);
			$this->movies_model->update($id, $data);
			$referred_from = $this->session->userdata('referred_from');
			redirect($referred_from, 'refresh');
		}
		else
		{
			$data['genres'] = $this->genres_model->get_all();
			$data['directors'] = $this->directors_model->get_all();
			$data['movie'] = $this->movies_model->get_by_id($id);
			$data['content'] =$this->load->view('movies/edit', $data, TRUE);	
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
			$data['movies'] = array(
							'title' =>$this->input->post('title') ,
							'year' =>$this->input->post('year') ,
							'duration' =>$this->input->post('duration') ,
							'language' =>$this->input->post('language') ,
							'release_date' =>$this->input->post('release_date') ,
							'country' =>$this->input->post('country')  
						);
			
			$mov_id = $this->movies_model->add($data['movies']);
			$count=count($_POST['actor']);
			$actor = array();
			for($i=0; $i<$count;$i++)
			{
				array_push($actor, array('actor_id'=>$this->input->post("actor[$i]"), 'movie_id'=>$mov_id, 'role'=>$this->input->post("role[$i]")));
			}
			$data['director'] = array(
							'movie_id' => $mov_id ,
							'director_id'=>$this->input->post('director')
							);
			$data['genres'] = array(
							'genre_id' =>$this->input->post('genres') ,
							'movie_id' => $mov_id 
						);

			$this->actors_model->add_id($actor);
			//$this->actors_model->add_id($data['actor']);
			$this->directors_model->add_id($data['director']);
			$this->genres_model->add_id($data['genres']);
			$referred_from = $this->session->userdata('referred_from');
			redirect($referred_from, 'refresh');
		}
		else
		{
			$data['actors'] = $this->actors_model->get_all();
			$data['directors'] = $this->directors_model->get_all();
			$data['genres'] = $this->genres_model->get_all();
			$data['content'] =$this->load->view('movies/add', $data, TRUE);	
			$this->load->view('layout/default', $data);

		}
	}

	public function more($id)
	{
		$data['movies'] =$this->movies_model->get_by_id($id);
		$data['genres'] = $this->genres_model->get_id_by_movie($id);
		$data['actors'] = $this->actors_model->get_id_by_movie($id);
		$data['directors'] = $this->directors_model->get_id_by_movie($id);
		$data['content'] = $this->load->view('movies/more', $data, TRUE);
		$this->load->view('admin/default', $data);	
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
			if($this->movies_model->delete_all($ids))
			{
				foreach ($ids as $id) 
				{
					$this->movies_model->delete($id);
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
		$config["base_url"] = base_url() . "movies/search";
		$config["total_rows"] = $this->movies_model->total_row_count();
		$config["per_page"] = 5;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
	
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['start'] =$start;

    	$search = $this->input->post('member_name');
    	if ($search=='') 
    	{
			redirect(base_url('movies'), 'refresh');  
		}
		else
		{
	    	$data['movies'] = $this->movies_model->search($search);
	    	foreach ($data['movies'] as $row)
	        {      
?> 
                  <tr>
                    <td><input type="checkbox" class="checkbBoxClass" id="select" name="select[]" value="<?php echo $row['id'] ?>"></td>
                    <td><?php echo $start+1;  $start++; ?></td>
                    <td><?php echo ucfirst($row['title']); ?></td>
<?php
	 		$genres = $this->genres_model->get_id_by_movie($row['id']);
?>
                   	<td><?php
                   	if($genres)
                   	{
                   		echo ucfirst($genres[0]['title']);
                   	} 
                   	else {
                   		echo " ";
                   	}
                   	 ?></td>
                   	<td>
<?php				
			$actors = $this->actors_model->get_id_by_movie($row['id']);
			if($actors)
                {
                	foreach ($actors as $actor) 
                	{
                   		echo $actor['firstname']." ".$actor['lastname'];
                   	} 
                } 
             else 
             	{
                   	echo " ";
                }  
?>
					</td>
					<td>
<?php
			$directors = $this->directors_model->get_id_by_movie($row['id']);
			if($directors)
                {
                	foreach ($directors as $director) 
                	{
                   		echo $director['firstname']." ".$director['lastname']; 
                   	} 
                } 
             else 
             	{
                   	echo " ";
                }  
?>	
					</td>
					<td><?php echo ($row['release_date']); ?></td>
					<td><?php echo ($row['language']); ?></td>
					<td><?php echo ($row['country']); ?></td>
                    <td><a href= "<?php echo base_url('movies/edit/').$row['id'];?>" onclick="return confirm('Are you sure you want to edit this data?');" > Edit </a>
                    <td><a href= "<?php echo base_url('actors/edit/').$row['id'];?>" > Edit </a> | 
                    <a href= "<?php echo base_url('actors/delete/').$row['id'];?>" onclick="return confirm('Are you sure you want to delete this data?');">  Delete </a> | 
                    <a href= "<?php echo base_url('movies/more/').$row['id'];?>"  > More </a></td> 
                  </tr>
<?php
	        }
		}
    }
}
?>