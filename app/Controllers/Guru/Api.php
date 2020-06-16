<?php
namespace App\Controllers\Guru;

class Api extends BaseController {
	public function __construct(){
		$this->req = \Config\Services::request();
		$this->db = db_connect();
        $this->session = session();
        $this->session->start();
        if (!$this->session->get("role") || $this->session->get("role") != "Guru"){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        parent::__construct();
        header("Content-type: application/json");
	}
    public function mapel($act, $id = NULL) {
        if ($act == "table"){
            $db = $this->db->table("mapel")->get();
            $data = [];
            foreach ($db->getResult() as $i => $c){
                $i++;
                if ($id !== NULL)
                    array_push($data, [$i, $c->nama_mapel, $c->id_mapel]);
                else
                    array_push($data, [$i, $c->nama_mapel]);
            }
            die(json_encode(["data" => $data]));
        }
    }
    public function nilai($act, $id = NULL, $idp = NULL){
        if ($act === "ganti_siswa"){
            if ($id == "null"){
                die(json_encode(['status' => 'success', 'data' => NULL]));
            }
            if ($id !== NULL && $idp !== NULL){
                $db = $this->db->table("nilai")->where(['id_siswa' => intval($id), "id_pembelajaran" => intval($idp)])->get();
                $this->session->set(['id_siswa' => intval($id)]);
                if (!$db->getResult()){
                    die(json_encode(['status' => 'success', 'data' => ["nilai_tugas" => "", "nilai_uts" => "", "nilai_uas" => ""]]));
                }
                else {
                    $nilai = $db->getRowArray();
                    $nilai["nilai_tugas"] = json_decode($nilai["nilai_tugas"]);
                    $nilai += ["id_mapel" => intval($this->db->table("pembelajaran")->where(["id_pembelajaran" => $nilai["id_pembelajaran"]])->get()->getRow()->id_mapel)];
                    die(json_encode(['status' => 'success', 'data' => $nilai]));
                }
            }
        }
        elseif ($act === "update"){
            if ($this->req->getPost("tugas") && $this->req->getPost("uts") && $this->req->getPost("uas") && $this->req->getPost("mapel")){
                $tugas = [];
                foreach ($this->req->getPost("tugas") as $data){
                    array_push($tugas, intval($data));
                }
                $tugas = json_encode($tugas);
                $mapel = intval($this->req->getPost("mapel"));
                $uts = intval($this->req->getPost("uts"));
                $uas = intval($this->req->getPost("uas"));

                $data = [
                    "id_siswa" => intval($this->req->getPost("siswa")),
                    "id_pembelajaran" => $mapel,
                    "nilai_tugas" => $tugas,
                    "nilai_uts" => $uts,
                    "nilai_uas" => $uas
                ];
                $db = $this->db->table("nilai")->where(["id_siswa" => intval($this->req->getPost("siswa")), "id_pembelajaran" => intval($this->req->getPost("mapel"))])->get();
                if (!$db->getResult()){
                    $this->db->table("nilai")->insert($data);
                }
                else {
                    unset($data["id_siswa"]);
                    unset($data["id_pembelajaran"]);
                    $this->db->table("nilai")->update($data, ["id_siswa" => intval($this->req->getPost("siswa")), "id_pembelajaran" => $mapel]);
                }
                if ($this->db->affectedRows() > 0){
                    die(json_encode(["status" => "success", "msg" => "Berhasil Menginput Nilai"]));
                }
                else {
                    die(json_encode(["status" => "error", "msg" => "Gagal Menginput Nilai"]));
                }
            }
        }
        elseif ($act === "get_mapel"){
            $kelas = $this->db->table("siswa")->where(["id_siswa" => intval($id)])->get()->getRow()->id_kelas;
            $pemb = $this->db->table("pembelajaran")->where(["id_guru" => ($this->req->getPost("id_guru")) ? intval($this->req->getPost("id_guru")) : $this->session->get("id"), "id_kelas" => $kelas])->get();
            $mapel = [];
            foreach ($pemb->getResult() as $data){
                $nama_mapel = $this->db->table("mapel")->where(["id_mapel" => $data->id_mapel])->get()->getRow()->nama_mapel;
                array_push($mapel, [intval($data->id_pembelajaran), $nama_mapel]);
            }
            die(json_encode(["status" => "success", "data" => $mapel]));
        }
    }
    public function guru($act, $id = NULL) {
        if ($act == "edit") {
            if ($id !== NULL) {
                $db = $this->db->table("guru")->where(["id_guru" => intval($id)])->get();
                if (!$db->getResult()) {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
                if ($this->req->getPost("nip") && $this->req->getPost("nama_guru") && $this->req->getPost("alamat") && $this->req->getPost("provinsi") && $this->req->getPost("kabupaten") && $this->req->getPost("kecamatan") && $this->req->getPost("kelurahan")) {
                    $nip = intval($this->req->getPost("nip"));
                    $nama_guru = $this->db->escapeString($this->req->getPost("nama_guru"));
                    $alamat = $this->db->escapeString($this->req->getPost("alamat"));
                    $provinsi = $this->db->escapeString($this->req->getPost("provinsi"));
                    $kabupaten = $this->db->escapeString($this->req->getPost("kabupaten"));
                    $kecamatan = $this->db->escapeString($this->req->getPost("kecamatan"));
                    $kelurahan = $this->db->escapeString($this->req->getPost("kelurahan"));
                    $username = $this->db->escapeString($this->req->getPost("username"));
                    $this->db->table("guru")->update(
                        [
                            "nip" => intval($nip),
                            "nama_guru" => $nama_guru,
                            "alamat" => $alamat,
                            "provinsi" => $provinsi,
                            "kabupaten" => $kabupaten,
                            "kecamatan" => $kecamatan,
                            "kelurahan" => $kelurahan,
                            "username" => $username,
                        ],
                        ["id_guru" => intval($id)]
                    );
                    if ($this->db->affectedRows() > 0) {
                        die(json_encode(["status" => "success", "msg" => "Berhasil Mengedit Guru"]));
                    } else {
                        die(json_encode(["status" => "error", "msg" => "Gagal Mengedit Guru"]));
                    }
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } elseif ($act == "get") {
            $db = $this->db->table("guru");
            if ($id !== NULL) {
                $db = $db->where(["id_guru" => intval($id)]);
            }
            $db = $db->get();
            die(json_encode(["status" => "success", "data" => $db->getResultArray()]));
        } elseif ($act == "table") {
            $db = $this->db->table("guru")->get();
            $data = [];
            foreach ($db->getResult() as $i => $c) {
                $i++;
                if ($id !== NULL)
                    array_push($data, [$i, $c->nip, $c->nama_guru, $c->provinsi, $c->kabupaten, $c->kecamatan, $c->kelurahan, $c->id_guru]);
                else
                array_push($data, [$i, $c->nip, $c->nama_guru, $c->provinsi, $c->kabupaten, $c->kecamatan, $c->kelurahan]);
            }
            die(json_encode(["data" => $data]));
        }
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
    public function kelas($act, $id = NULL) {
        if ($act == "table"){
            $db = $this->db->table("kelas")->get();
            $data = [];
            foreach ($db->getResult() as $i => $c){
                $i++;
                if ($id !== NULL)
                    array_push($data, [$i, $c->nama_kelas, $c->id_kelas]);
                else
                    array_push($data, [$i, $c->nama_kelas]);
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