<?php
class Whatmobile_model extends CI_Model
{
	public function insert_brand($data)
	{
		$this->db->select('id')->from('brands');
		$this->db->where('site',$data['site']);
		$this->db->where('link',$data['link']);
		$this->db->where('brand',$data['brand']);
		$query=$this->db->get();
		if($query->num_rows()==0)
		{
			$this->db->insert('brands',$data);
		}
	}
	public function get_brand($site)
	{
		$this->db->select('*')->from('brands');
		$this->db->where('scraped',0);
		$this->db->where('site',$site);
		$this->db->limit(1);
		$query=$this->db->get()->result_array();
		return $query;
	}
}