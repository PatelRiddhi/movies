<?php
class Directors_Model extends My_Model 
{
	
	function __construct() 
	{
		parent::__construct();	
		$this->table_name = 'directors';	
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
		FROM directors
		LEFT JOIN movie_direction ON movie_direction.director_id = directors.id
		LEFT JOIN movies ON movies.id = movie_direction.movie_id 
        WHERE movies.id = $id")->result_array();
	}

	public function add_id($data)
	{
		$this->table_name = 'movie_direction';
		return parent::add($data);
	}

	public function get_director_id($id)
	{
		$this->db->select('director_id');
		$this->db->where('movie_id',$id);
		return $this->db->get('movie_direction')->result_array();
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
		return $this->db->delete('directors');
	}

}
?>