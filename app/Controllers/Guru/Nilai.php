<?php 

namespace App\Controllers\Guru;

class Nilai extends BaseController {
    public function __construct(){
		$this->req = \Config\Services::request();
		$this->db = db_connect();
		$this->session = session();
		$this->session->start();
		if (!$this->session->get("role") || $this->session->get("role") != "Guru"){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
		parent::__construct();
	}
	public function index() {
		$db = $this->db->table("pembelajaran")->where(["id_guru" => $this->session->get("id")])->get();
		$id_kelas = [];
		foreach ($db->getResult() as $c){
			array_push($id_kelas, $c->id_kelas);
		}
		$id_kelas = array_unique($id_kelas);
		$data = [
			"page" => "guru/table/nilai",
			"title" => [
				"head" => "Data Nilai",
				"desc" => "Page untuk mengelola Nilai"
			],
			"buttons" => false,
			"db" => $id_kelas
		];
		return view('guru/template', $data);
	}
}