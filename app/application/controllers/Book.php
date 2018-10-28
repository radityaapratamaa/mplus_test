<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

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
		$dt['content'] = "books";
		$dt['data_list'] = get_all_data("book_list");
		$this->load->view('index', $dt);
	}

	function reload_table()
	{
		$list_data = get_all_data("book_list", "book_id, title, author_name, date_published, type");
		$data['body'] = "";
		$icr=0;
		foreach ($list_data as $book) {
			# code...
			$data["body"] .= "
                      <tr>
                        <td>".(++$icr)."</td>
                        <td>$book[title]</td>
                        <td>$book[author_name]</td>
                        <td>$book[date_published]</td>
                        <td>$book[type]</td>
                        <td>
                          <button class='btn btn-warning' onclick=\"show_modal('book', 'update', $book[book_id])\">
                            <i class='fa fa-edit'></i>
                          </button>
                          <button class='btn btn-danger' onclick=\"show_modal('book', 'delete', $book[book_id])\">
                            <i class='fa fa-times'></i>
                          </button>
                        </td>
                      </tr>";
		}

		$data['header'] = "
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Author Name</th>
			<th>Date Publish</th>
			<th>Type</th>
			<th>Action</th>
		</tr>
		";

		echo json_encode($data);
		
	}

	function __destruct()
	{}
}
?>