public function get_latest_blog()
	{
		$this->db->select("*");
		$this->db->from("tbl_blog");
		$this->db->where('blog_status','1');
		$this->db->order_by('blog_created_date','DESC');
		$this->db->limit(1);
        $query=$this->db->get();

       	return $query->result_array();
	}
	
	public function get_emails()
	{
		$this->db->select("email");
		$this->db->from("tbl_newsletter");
		$query=$this->db->get();
       	return $query->result_array();
	}
