<?php

namespace App\Controllers\Guru;

class Siswa extends BaseController
{

  public function __construct()
  {
    $this->req = \Config\Services::request();
    $this->db = db_connect();
    $this->session = session();
    if (!$this->session->get("role") || $this->session->get("role") != "Guru"){
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    parent::__construct();
  }

  public function index()
  {
    $data = [
      "page" => "guru/table/siswa",
      "title" => [
        "head" => "Data Siswa",
        "desc" => "Page untuk mengelola Siswa"
      ],
      "kelas" => $this->db->table('kelas')->get(),
      "wali" => $this->db->table("keluarga")->get(),
      "buttons" => false
    ];
    return view('guru/template', $data);
  }
}
