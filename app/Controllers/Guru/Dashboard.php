<?php 

namespace App\Controllers\Guru;

class Dashboard extends BaseController {
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
			"page" => "guru/table/dashboard",
			"title" => [
				"head" => "Dashboard",
				"desc" => ""
			],
			"buttons" => false
		];
		return view('guru/template', $data);
	}
}
