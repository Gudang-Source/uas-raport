<?php 

namespace App\Controllers\Guru;

class Raport extends BaseController {
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
		$db = $this->db->table("pembelajaran")->where(["id_guru" => $this->session->get("id")])->get();
		$id_kelas = [];
		foreach ($db->getResult() as $c){
			array_push($id_kelas, $c->id_kelas);
		}
		$id_kelas = array_unique($id_kelas);
		$data = [
			"page" => "guru/table/raport",
			"title" => [
				"head" => "Data Raport",
				"desc" => "Page untuk melihat raport"
			],
			"buttons" => false,
			"kelas" => $id_kelas
		];
		return view('guru/template', $data);
	}
}
