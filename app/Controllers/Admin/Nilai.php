<?php 

namespace App\Controllers\Admin;

class Nilai extends BaseController {
    public function __construct(){
		$this->req = \Config\Services::request();
		$this->db = db_connect();
		$this->session = session();
		$this->session->start();
		if (!$this->session->get("role") || $this->session->get("role") != "Admin"){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
		parent::__construct();
	}
	public function index() {
		$data = [
			"page" => "admin/table/nilai",
			"title" => [
				"head" => "Data Nilai",
				"desc" => "Page untuk mengelola Nilai"
			],
			"buttons" => false,
			"kelas" => $this->db->table("kelas")->get()
		];
		return view('admin/template', $data);
	}
}