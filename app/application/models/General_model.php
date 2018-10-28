<?php

class General_model extends CI_Model {
	protected $CI;
	function __construct() {
        parent::__construct();
		// $this->load->database();
		$this->CI =& get_instance();
	}


	function direct_detail_data($table, $condition, $col = "*", $start = 0, $limit = -1)
	{
			# code...
		$this->db->select($col)
			->from($table)
			->where($condition);
		if ($limit >= 0) $this->db->limit($limit, $start);

		$result = $this->db->get()->row_array();
		return $result;
	}

	function direct_detail_list($table, $condition, $col = "*", $start = 0, $limit = -1, $to_object = false, $order = "null", $join = "null", $pkjoin = "null", $group = "null")
	{
		$this->db->select($col)
			->from($table)
			->where($condition);
		if ($limit >= 0) $this->db->limit($limit, $start);
		if ($order !== "null") $this->db->order_by($order);
		if ($group !== "null") $this->db->group_by($group);
		if ($pkjoin !== "null" && $join !== "null") $this->db->join($join, $pkjoin);

		$result = $this->db->get();//->result_array();
		if ($to_object) return $result->result();
		else return $result->result_array();
			// $data = array(
			// 	'table' => $table,
			// 	'condition' => $condition,
			// 	'column'	=> $col,
			// 	'order' => $order,
			// 	'join' => $join,
			// 	'pk_join' => $pkjoin,
			// 	'group' => $group,
			// 	'start'		=> $start,
			// 	'limit'		=> $limit

			// );
			// return get_data($data, $to_object);
	}

	function get_all_data($table, $col = "*", $to_object = false, $order = "null", $join = "null", $pkjoin = "null", $group = "null", $start = 0, $limit = -1)
	{
		$this->db->select($col)
			->from($table);
			if ($limit >= 0) $this->db->limit($limit, $start);
		if ($order !== "null") $this->db->order_by($order);
		if ($group !== "null") $this->db->group_by($group);
		if ($pkjoin !== "null" && $join !== "null") $this->db->join($join, $pkjoin);
		$result = $this->db->get();//->result_array();
		if ($to_object) return $result->result();
		else return $result->result_array();
			// $condition = "all";
			// $data = array(
			// 	'table' => $table,
			// 	'condition' => 'all',
			// 	'column'	=> $col,
			// 	'order' => $order,
			// 	'join' => $join,
			// 	'pk_join' => $pkjoin,
			// 	'group' => $group,
			// 	'start' => $start,
			// 	'limit'	=> $limit
			// );
			// return get_data($data, $to_object);
	}

	
	// =============== (akhir) fungsi lama (blm dihapus takut error) =======================
	function __destruct(){ }	
}
?>