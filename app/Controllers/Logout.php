<?php

namespace App\Controllers;

class Logout extends BaseController {
    public function __construct(){
		$this->req = \Config\Services::request();
		$this->db = db_connect();
		$this->session = session();
		$this->session->start();
		parent::__construct();
	}
	public function index() {
		// $data = [
		// 	"page" => "table/nilai",
		// 	"title" => [
		// 		"head" => "Data Nilai",
		// 		"desc" => "Page untuk mengelola Nilai"
		// 	],
		// 	"buttons" => false,
		// 	"db" => $this->db->table("siswa")->get()
		// ];
        $this->session->destroy();
        header("Location: ".base_url());
        exit;
	}
}