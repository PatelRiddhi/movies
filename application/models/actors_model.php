<?php
class Actors_Model extends My_Model 
{
	
	function __construct() 
	{
		parent::__construct();	
		$this->table_name = 'actors';	
	}

	public function get_all()
	{
		return parent::get_all();
	}

	public function delete($id)
	{
		return parent::delete($id);
	}

	public function update($id, $data)
	{
		return parent::update($id, $data);
	}

	public function get_by_id($id)
	{
		return parent::get_by_id($id);
	}

	public function add($data)
	{
		return parent::add($data);
	}

	public function total_row_count()
	{
		return parent::total_row_count();
	}

	public function total_row($num, $start)
	{
		$this->db->select()->from($this->table_name)->limit($num,$start);
		return $this->db->get()->result_array();
	}

	public function get_id_by_movie($id)
	{
		return $this->db->query("SELECT *
		FROM actors
		LEFT JOIN movie_cast ON movie_cast.actor_id = actors.id
		LEFT JOIN movies ON movies.id = movie_cast.movie_id 
        WHERE movies.id = $id")->result_array();
	}

	public function add_id($data)
	{
		$this->table_name = 'movie_cast';
		return $this->db->insert_batch($this->table_name,$data);
	}

	public function get_actor_id($id)
	{
		$this->db->select('actor_id');
		$this->db->where('movie_id',$id);
		return $this->db->get('movie_cast')->result_array();
	}

	public function selectorganizer($search) 
	{
	    $this->db->where('firstname',$search);
	    $this->db->or_where('lastname', $search); 
	    $this->db->select('*');
	    $this->db->from($this->table_name);
	    $query = $this->db->get();
	    return $result = $query->result_array();
	} 

	public function search($search)
	{
		$this->db->like('lastname', $search,'after');
		$this->db->or_like('firstname', $search,'after'); 
		return $this->db->get($this->table_name)->result_array();
	}

	public function delete_all($ids)
	{
		$this->db->where_in('id', $ids);
		return $this->db->delete('actors');
	}

	public function geta_data($where = '', $limit ='', $offset = '')
	{
		parent::get_data();
	}
}
?>