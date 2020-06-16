<?php 

namespace App\Controllers\Guru;

class Kelas extends BaseController {
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
		$guru = [
			"page" => "guru/table/kelas",
			"title" => [
				"head" => "Data Kelas",
				"desc" => "Page untuk mengelola Kelas"
			],
			"buttons" => false
		];
		return view('guru/template', $guru);
	}
}
