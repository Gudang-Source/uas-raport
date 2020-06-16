<?php 

namespace App\Controllers\Admin;

class Kelas extends BaseController {
	public function __construct(){
		$this->req = \Config\Services::request();
		$this->db = db_connect();
		$this->session = session();
		if (!$this->session->get("role") || $this->session->get("role") != "Admin"){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
		parent::__construct();
	}
	public function index() {
		$data = [
			"page" => "admin/table/kelas",
			"title" => [
				"head" => "Data Kelas",
				"desc" => "Page untuk mengelola Kelas"
			],
			"buttons" => true
		];
		return view('admin/template', $data);
	}
}
