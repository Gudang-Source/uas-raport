<?php 

namespace App\Controllers\Wali;

class Raport extends BaseController {
	public function __construct(){
		$this->req = \Config\Services::request();
		$this->db = db_connect();
		$this->session = session();
		if (!$this->session->get("role") || $this->session->get("role") != "Wali"){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
		parent::__construct();
	}
	public function index() {
		$data = [
			"page" => "wali/table/raport",
			"title" => [
				"head" => "Data Raport",
				"desc" => "Page untuk melihat raport"
			],
			"buttons" => false,
			"db" => $this->db->table("siswa")->where(["id_keluarga" => $this->session->get("id")])->get()
		];
		return view('wali/template', $data);
	}
}
