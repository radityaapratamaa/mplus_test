<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists("get_all_data")) {
	function get_all_data($table, $col = "*", $to_object = false, $order = "null", $join = "null", $pkjoin = "null", $group = "null", $start = 0, $limit = -1)
	{
		$CI = &get_instance();

		return $CI->general_model->get_all_data($table, $col, $to_object, $order, $join, $pkjoin, $group, $start, $limit);
	}
}
/*
if (!function_exists("check_validation")) {
	function check_validation()
	{
		$CI = &get_instance();
		foreach ($_POST as $key => $value) {
			if ($value == "") return false;
		}
		return true;
	}
}*/

if (!function_exists("get_detail_data")) {
	function get_detail_data($table, $condition, $col = "*", $start = 0, $limit = -1)
	{
		$CI = &get_instance();

		return $CI->general_model->direct_detail_data($table, $condition, $col, $start, $limit);
		// else return $CI->gm->get_detail_data($table, $condition, $col, $start, $limit);
        // return search_in_db($table, $condition, $col, $start, $limit)[0];

	}
}

if (!function_exists("get_detail_list")) {
	function get_detail_list($table, $condition, $col = "*", $start = 0, $limit = -1, $to_object = false, $order = "null", $join = "null", $pkjoin = "null", $group = "null")
	{
		$CI = &get_instance();

		return $CI->general_model->direct_detail_list($table, $condition, $col, $start, $limit, $to_object, $order, $join, $pkjoin, $group);
		// else return $CI->gm->get_detail_list($table, $condition, $col, $start, $limit, $to_object, $order, $join, $pkjoin, $group);
        // return search_in_db($table, $condition, $col, $start, $limit, $order, $group);
	}
}

if (!function_exists("encrypt")) {
	function encrypt($string)
	{
		$CI = &get_instance();
		$CI->load->library("opensslencrypt");
		return $CI->opensslencrypt->text_encrypt($string);
	}
}

if (!function_exists("decrypt")) {
	function decrypt($string)
	{
		$CI = &get_instance();
		$CI->load->library("opensslencrypt");
		return $CI->opensslencrypt->text_decrypt($string);
	}
}

if (!function_exists('is_openssl_encrypt')) {
	function is_openssl_encrypt()
	{
		ini_set("max_execution_time", 0);
		$ci = &get_instance();
		$ci->load->library('opensslencrypt');
		$sample_user = get_detail_data("ps_master_personal_data", "email = 'admin'", 'password1');
		decrypt($sample_user['password1']);
            echo "sebelum masuk openssl encrypt";
		if (!$ci->opensslencrypt->is_openssl_encrypt()) {
            echo "belum openssl encrypt";
			$list_users = get_all_data("ps_master_personal_data", "email, password1");
            // $ci->db->trans_begin();
			foreach (array_chunk($list_users, 500) as $klu => $vlu) {
				$ci->db->trans_begin();
				foreach ($vlu as $key => $value) {
					$encrypt_pass = encrypt($value['email']);
					$ci->db->set("password1", $encrypt_pass)->where("email", $value['username'])->update("users");
				}
				if ($ci->db->trans_status() === false) {
					echo "gagal update openssl_encrypt";
					$ci->db->trans_rollback();
				}
				else {
					echo "berhasil update openssl_encrypt";

					$ci->db->trans_commit();
				}
			}

            // sleep(3);
            // if ($ci->db->trans_status() === FALSE) $ci->db->trans_rollback();
            // else $ci->db->trans_commit();

			/* $list_users = get_all_data("super_users", "username, password");
            // echo "<pre>";
            // print_r ($list_users);
            // echo "</pre>";
            // foreach (array_chunk($list_users,500) as $klu => $vlu) {
			$ci->db->trans_begin();
			foreach ($list_users as $key => $value) {
				$encrypt_pass = encrypt($value['username']);
				$ci->db->set("password", $encrypt_pass)->where("username", $value['username'])->update("super_users");
			}
			if ($ci->db->trans_status() === false) $ci->db->trans_rollback();
			else $ci->db->trans_commit(); */
                // sleep(3);
            // }

		}
        // else echo "belum di enkrip";
        // echo " -> ".((int) $ci->opensslencrypt->is_openssl_encrypt());
	}
}

function numtoint($num) {
	$num = str_replace('.00','',$num);
	return str_replace(',','',$num);
}

function debux($str){
	echo "<pre>";
	print_r($str);
	echo "</pre>";
}

function showView($view_name="", $data=array())
{
	$CI =& get_instance();
	if($view_name !== "") $data['content'] = $view_name;
	$CI->load->view("redesign/index", $data);
}

if (!function_exists('generate_new_key')) {
	function generate_new_key($old_key, $unset = false)
	{
		$new_key = substr($old_key, 0, strpos($old_key, "-"));
		$_POST[$new_key] = $_POST[$old_key];
		if ($unset) unset($_POST[$old_key]);
	}
}

if (!function_exists('strposa')) {
	function strposa($haystack, $needle, $offset = 0)
	{
		if (!is_array($needle)) $needle = array($needle);
		foreach ($needle as $query) {
            // stop on first true result
			if (strpos($haystack, $query, $offset) !== false) return true;
		}
		return false;
	}
}

if (!function_exists("set_validation")) {
	function check_validation()
	{
		$data = $_POST;
		
		$CI = &get_instance();
		$CI->load->library('form_validation');
		$CI->load->helper('security');
		$data = xss_clean($data);
		$CI->form_validation->set_message('required', "<i>Field</i> %s tidak boleh <b style=\'color: #333\'>kosong</b> !");
		$CI->form_validation->set_message('min_length', "<i>Field</i> %s minimal harus <b style=\'color: #333\'>%s karakter</b> !");
		$CI->form_validation->set_message('max_length', "<i>Field</i> %s maksimal hanya <b style=\'color: #333\'>%s karakter</b> !");
		$CI->form_validation->set_message('valid_email', "<i>Field</i> %s memiliki <b style=\'color: #333\'>format email yang tidak valid</b> !");
		$CI->form_validation->set_message('numeric', "<i>Field</i> %s hanya diisi <b style=\'color: #333\'>angka</b> !");
		$CI->form_validation->set_message('alpha', "<i>Field</i> %s hanya diisi <b style=\'color: #333\'>huruf</b> !");
		$CI->form_validation->set_message('matches', "<i>Field</i> %s<b style=\'color: #333\'> tidak sama</b> dengan Field %s!");
        // show_data($data);
        // show_data($_POST);
		foreach ($data as $key => $value) {
			$alt = $key;
			$altChange = false;
			$validation = "";
			$alreadyGenerateNewKey = false;

			if (strpos($key, "-nr") > 0) {
				if (!$alreadyGenerateNewKey) {
					generate_new_key($key, true);
					$alreadyGenerateNewKey = true;
				}
				continue;
			}
			if (is_array($value)) {
                // $pecah = explode(":", explode('-', $key)[1]);
                // $alt = $pecah[1];
                // generate_new_key($key, "-", true);
				continue;
			}
			if (strpos($key, "-alt:") > 0) {
                /* echo  */ $startAlt = substr($key, strpos($key, "-alt:") + strlen("-alt:")); //echo " -> ";
				$alt = substr($startAlt, 0, ((strpos($startAlt, "-") !== false) ? strpos($startAlt, "-") : strlen($startAlt)));
				$altChange = true;
                // $alt = $pecah[1];
				if (!$alreadyGenerateNewKey) {
					generate_new_key($key, true);
					$alreadyGenerateNewKey = true;
				}

				$key = substr($key, 0, strpos($key, '-'));
			} 
            // echo "$key, ";
			if (strpos($key, "-valid:") > 0) {
				$tmp = explode("-", $key);
				$listValidation = array();
				foreach ($tmp as $kt => $vt) {
					if ($kt == 0 || strpos($vt, "valid") === false) continue;
					$listnya = substr($vt, strpos($vt, ':') + 1);
					$listValidation = explode(";", $listnya);
				}
				foreach ($listValidation as $kv => $vv) {
					if ($vv == "") continue;
					if(strpos($vv, 'email') !== false) $vv = "valid_email";
					if(strpos($vv, 'ip') !== false) $vv = "valid_ip";
					if (strpos($vv, '=') !== false) {
						$pecahVV = explode("=", $vv);
						$validation .= $pecahVV[0] . "[$pecahVV[1]]|";
					} else $validation .= "$vv|";
				}
				$alt = (!$altChange) ? $tmp[0] : $alt;
				if (!$alreadyGenerateNewKey) {
					generate_new_key($key, true);
					$alreadyGenerateNewKey = true;
				}
				$secondElement2 = $tmp[0];
				$key = (!$altChange) ? $secondElement2 : $key;
			}
			$validation .= 'required|trim|xss_clean';
            // echo "$alt -> $validation<br>";
            // if($key == "isi_surat") {
            //     // echo "$key --> just required";
            //     $validation = "required";
            // }
			$CI->form_validation->set_rules($key, "<b style='color: #333'>" . ucwords(str_replace("_", " ", $alt)) . "</b>", $validation);
            // $CI->form_validation->set_message("required", "Field ".str_replace("_", "", $key)." tidak boleh kosong !");
		}
		unset($_POST[0]);
        // show_data($_POST);
		if ($CI->form_validation->run()) return true;
		else return validation_errors();
	}
}

if (!function_exists('check_array_input')) {
	function check_array_input()
	{
		foreach ($_POST as $key => $value) {
			if (strpos($key, "[]") > 0) {
				generate_new_key($key, "-", true);
			}
		}
		foreach ($_POST as $key => $value) {
			if (!is_array($value)) continue;
			else {
				foreach ($value as $key_val => $subval) {
					$isi_array = trim($subval);
					if ($isi_array == "" || $isi_array == null) {
						return $key;
					}
				}
			}
		}
		return true;
	}
}


if (!function_exists("set_session")) {
	function set_session($param1, $param2 = "")
	{
		$CI = &get_instance();
		if (is_array($param1)) $CI->session->set_userdata($param1);
		else $CI->session->set_userdata($param1, $param2);
	}
}

if (!function_exists("destroy_session")) {
	function destroy_session()
	{
		$CI = &get_instance();
		$CI->session->sess_destroy();
	}
}

if (!function_exists("unset_session")) {
	function unset_session($sess_name)
	{
		$CI = &get_instance();
        /*if(is_array($param1)) */ $CI->session->unset_userdata($sess_name);
        // else $CI->session->set_userdata($sess_name);
	}
}

if (!function_exists("get_session")) {
	function get_session($sess_name)
	{
		$CI = &get_instance();
		return $CI->session->userdata($sess_name);
	}
}

 
?>