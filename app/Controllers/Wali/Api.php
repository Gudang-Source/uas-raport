<?php
namespace App\Controllers\Wali;

class Api extends BaseController {
	public function __construct(){
		$this->req = \Config\Services::request();
		$this->db = db_connect();
        $this->session = session();
        $this->session->start();
        if (!$this->session->get("role") || $this->session->get("role") != "Wali"){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        parent::__construct();
        header("Content-type: application/json");
	}
    public function siswa($act, $id = NULL) {
        if ($act == "table") {
            $db = $this->db->table("siswa a")->select('a.*,b.nama_wali')->join('keluarga b', 'a.id_keluarga = b.id_keluarga')->get();
            $data = [];
            foreach ($db->getResult() as $i => $c) {
                $i++;
                if ($id !== NULL)
                    array_push($data, [$i, $c->nis, $c->nisn, $c->nama_siswa, $c->no_telp, $c->nama_wali, $c->provinsi, $c->kabupaten, $c->kecamatan, $c->kelurahan, $c->id_siswa]);
                else
                    array_push($data, [$i, $c->nis, $c->nisn, $c->nama_siswa, $c->no_telp, $c->nama_wali, $c->provinsi, $c->kabupaten, $c->kecamatan, $c->kelurahan]);
            }
            die(json_encode(["data" => $data]));
        }
    }
    function raport($act, $id = NULL){
        if ($act == "get"){
            $db = $this->db->table("siswa a");
            if ($id !== NULL){
                if ($id == "0"){
                    die(json_encode(['data' => []]));    
                }
                $db = $db->join("nilai b", "a.id_siswa = b.id_siswa")->join("pembelajaran c", "b.id_pembelajaran = c.id_pembelajaran")->join("mapel d", "c.id_mapel = d.id_mapel")->select("a.nama_siswa, b.nilai_tugas, b.nilai_uts, b.nilai_uas, d.nama_mapel")->where(["a.id_siswa" => intval($id)]);
                $db = $db->get();
                $data = [];
                foreach ($db->getResult() as $i => $c){
                    $i++;
                    $nilai_tugas = json_decode($c->nilai_tugas);
                    $nilai_akhir_tugas = array_sum($nilai_tugas) / count($nilai_tugas);
                    $nilai_akhir = ($nilai_akhir_tugas + $c->nilai_uts + $c->nilai_uas) / 3;
                    array_push($data, [$i, $c->nama_mapel, $nilai_akhir_tugas, $c->nilai_uts, $c->nilai_uas, round($nilai_akhir, 2)]);
                }
                die(json_encode(['data' => $data]));
            }
        }
    }
}   