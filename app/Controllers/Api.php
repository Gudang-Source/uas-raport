<?php 

namespace App\Controllers;

class Api extends BaseController {
	public function __construct(){
		$this->req = \Config\Services::request();
		$this->db = db_connect();
		$this->session = session();
        parent::__construct();
        header("Content-Type: application/json");
	}
	public function login($role){
        if (!in_array($role, ["keluarga", "guru", "admin", "siswa"]))
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($this->req->getPost("username") && $this->req->getPost("password")){
            $username = $this->db->escapeString($this->req->getPost("username"));
            $db = $this->db->table($role)->where(["username" => $username])->get();
            if (!$db->getResult()){
                die(json_encode(['status' => 'false', 'msg' => 'Username Salah']));
            }
            else {
                if (!password_verify($this->db->escapeString($this->req->getPost("password")), $db->getRow()->password)) {
                    die(json_encode(['status' => 'false', 'msg' => 'Password Salah']));
                }
                $nama_role = ($role === "keluarga") ? "wali" : $role;
                $dnama = [];
                foreach (explode(" ", $db->getRowArray()["nama_$nama_role"]) as $c) array_push($dnama, ucfirst($c));
                $nama = implode(" ", $dnama);
                $sess = [
                    "role" => ucfirst($nama_role),
                    "id" => $db->getRowArray()["id_$role"],
                    "nama" => $nama,
                ];
                $this->session->set($sess);
                die(json_encode(['status' => 'success', 'msg' => "Selamat Datang $nama"]));
            }
        }
    }
}