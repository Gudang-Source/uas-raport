<?php 

namespace App\Controllers\Guru;

class Mapel extends BaseController {
	public function __construct(){
		$this->req = \Config\Services::request();
		$this->db = db_connect();
		$this->session = session();
		if (!$this->session->get("role") || $this->session->get("role") != "Guru"){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
		parent::__construct();
	}
	public function index() {
		$data = [
			"page" => "guru/table/mapel",
			"title" => [
				"head" => "Data Mapel",
				"desc" => "Page untuk mengelola Mapel"
			],
			"buttons" => false
		];
		return view('guru/template', $data);
	}
}
