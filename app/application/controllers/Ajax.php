<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		if(!$this->input->is_ajax_request()) exit("You're not Authorized");
	}

	function show_modal($menu, $action)
	{

		$dt['menu'] = $menu;
		$dt['action'] = $action;
		$dt['link'] = BASE_URL."ajax/crud/$action/$menu";
		if($menu == "book"){
			$dt['author_list']= get_all_data("book_authors", "author_id, name");
			$dt['type_list']= get_all_data("book_types", "type_id, name");
		}
		if($action != "insert"){
			$id = $_POST['myid'];
			$tableList = unserialize(TABLE_MAPPING);
			$tableName = $tableList[$menu];
			$col = $menu."_id 'idnya', ";
			if($menu == "book") $col .= "title, author_id, date_published, type_id";
			else $col .= "name";
			$mydata = get_detail_data($tableName, $menu."_id = '$id'",$col);
			$dt = array_merge($dt, $mydata);
		}
		$this->load->view('main_modal', $dt);
	}


	function crud($action, $menu)
	{
		$tableList = unserialize(TABLE_MAPPING);
		$tableName = $tableList[$menu];
		$valid_to_process = check_validation();
		$resp['valid'] = false;
		if(is_bool($valid_to_process)){
			$resp['valid'] = true;
			if ($action == "insert") {
				$dt = $_POST;
				$checkData = get_detail_data($tableName, "1=1", "max(".$menu."_id) 'max'");
				if($checkData == null) $dt[$menu."_id"] = 1;
				else $dt[$menu."_id"] = $checkData['max']+1;
				$dt['created_by'] = "admin";
				$res = $this->db->insert($tableName, $dt);
			}
			else if($action == "update") {
				$dt = $_POST;
				unset($dt['idnya']);
				$pk = array($menu."_id" => $_POST['idnya']);
				$dt['updated_by'] = "admin";
				$res = $this->db->update($tableName, $dt, $pk);
			} else {
				$pk = array($menu."_id" => $_POST['idnya']);
				$res = $this->db->where($pk)->delete($tableName);
			}
			if ($res) $resp['resp'] = "sukses";
			else $resp['resp'] = "gagal";
			$resp['menu'] = $menu;
		} else {
			// echo "else, $valid_to_process";
			$resp['message'] = $valid_to_process;
		}
		echo json_encode($resp);
	}

	function reload_table($menu)
	{
		$data_list = get_all_data($menu);
		$this->load->view('View File', $data, FALSE);
	}
}
?>