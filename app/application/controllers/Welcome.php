<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	}

	public function index()
	{
		$data['total_authors'] = get_detail_data("book_authors", "1=1", "count(*) 'total'")['total'];
		$data['total_types'] = get_detail_data("book_types", "1=1", "count(*) 'total'")['total'];
		$data['total_books'] = get_detail_data("books", "1=1", "count(*) 'total'")['total'];
		$this->load->view('index', $data);
	}

	function __destruct()
	{ }
}
