<?php

namespace App\Controllers\Admin;

class Guru extends BaseController {

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
      "page" => "admin/table/guru",
      "title" => [
        "head" => "Data Guru",
        "desc" => "Page untuk mengelola Guru"
      ],
      "buttons" => true,
    ];
    return view('admin/template', $data);
  }
  public function keahlian() {
    $data = [
      "page" => "admin/table/mapel_guru",
      "title" => [
        "head" => "Data Keahlian Guru",
        "desc" => "Page untuk mengelola Keahlian Guru"
      ],
      "buttons" => true,
      "add_button" => false,
      "guru" => $this->db->table("guru")->get(),
      "mapel" => $this->db->table("mapel")->get(),
    ];
    return view('admin/template', $data);
  }
}
