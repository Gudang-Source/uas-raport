<?php 

namespace App\Controllers\Admin;

class Dashboard extends BaseController {
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
			"page" => "admin/table/dashboard",
			"title" => [
				"head" => "Dashboard",
				"desc" => ""
			],
			"buttons" => false
		];
		return view('admin/template', $data);
	}
}
