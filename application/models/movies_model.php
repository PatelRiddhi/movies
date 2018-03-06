<?php
class Movies_Model extends My_Model 
{
	
	function __construct() 
	{
		parent::__construct();	
		$this->table_name = 'movies';	
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

	public function search($search)
	{
		$this->db->like('title', $search,'after');
		return $this->db->get($this->table_name)->result_array();
	}

	public function delete_all($ids)
	{
		$this->db->where_in('id', $ids);
		return $this->db->delete('movies');
	}
}
?>