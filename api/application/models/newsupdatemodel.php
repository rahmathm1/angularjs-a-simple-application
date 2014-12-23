<?php 

class newsupdatemodel extends CI_Model {

	

	/* to fetch projects */
	function get_newsupdates()
	{
		$this->db->select('news.id as id,
						   news.title as title,
						   news.description as description,
						   news.picture as picture');
		$this->db->from('news as news'); 
		$query = $this->db->get();
		return $query->result();
	}
	
	/* to fetch a single property */
	function get_newsupdate($params)
	{
		$this->db->select('*');			
		if(array_key_exists('id',$params))
			$this->db->where('id', $params['id']);			
		$query = $this->db->get('news');
		return $query->result();
	}
	/* to fetch a single property */
	function delete_newsupdate($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete('news'); 
		return $result;
	}
	/* to save a news update */
	function save_newsupdate($params)
	{
		$title = $params['title'];
		$description = $params['description'];
		$data = array(
		   'title' => $title ,
		   'description' => $description 
		);
		if(array_key_exists('id',$params))
		{
			$this->db->where('id', $params['id']);
			return $this->db->update('news', $data); 
		}	
		else 
			return $this->db->insert('news', $data);
		
	}	
	function update_newsupdate($id,$params)
	{
		$title = $params['title'];
		$description = $params['description'];
		$data = array(
		   'title' => $title ,
		   'description' => $description 
		);
		$this->db->where('id',$id);
		return $this->db->update('news', $data); 

	}		
	
}

/* End of file property_model.php */
/* Location:  */
?>