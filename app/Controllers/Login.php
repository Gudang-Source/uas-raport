<?php 

namespace App\Controllers;

class Login extends BaseController {
    public function __construct(){
		$this->req = \Config\Services::request();
		$this->db = db_connect();
		$this->session = session();
		$this->session->start();
		parent::__construct();
	}
	public function index() {
		if ($this->session->get("role")){
			$link =  base_url()."/".strtolower($this->session->get("role"));
			header("Location: $link");
			exit;
		}
		return view('forms/login');
	}
}