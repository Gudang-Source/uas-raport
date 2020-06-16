<?php

namespace App\Controllers\Admin;

class Kbm extends BaseController {

  public function __construct() {
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
      "page" => "admin/table/kbm",
      "title" => [
        "head" => "Data Kegiatan Belajar Mengajar",
        "desc" => "Page untuk mengelola Kegiatan Belajar Mengajar"
      ],
      "buttons" => true,
      "guru" => $this->db->table("guru")->get(),
      "kelas" => $this->db->table("kelas")->get(),
      "mapel" => $this->db->table("mapel")->get(),
    ];
    return view('template', $data);
  }
}
