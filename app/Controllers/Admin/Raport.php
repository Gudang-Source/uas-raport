<?php 

namespace App\Controllers\Admin;

class Raport extends BaseController {
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
			"page" => "admin/table/raport",
			"title" => [
				"head" => "Data Raport",
				"desc" => "Page untuk melihat raport"
			],
			"buttons" => false,
			"kelas" => $this->db->table("kelas")->get()
		];
		return view('admin/template', $data);
	}
}
