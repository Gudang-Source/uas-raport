<?php
namespace App\Controllers\Siswa;

class Api extends BaseController {
	public function __construct(){
		$this->req = \Config\Services::request();
		$this->db = db_connect();
        $this->session = session();
        $this->session->start();
        if (!$this->session->get("role") || $this->session->get("role") != "Siswa"){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        parent::__construct();
        header("Content-type: application/json");
	}
    public function siswa($act, $id = NULL) {
        if ($act == "edit") {
            if ($id !== NULL) {
                $db = $this->db->table("siswa")->where(["id_siswa" => intval($id)])->get();
                if (!$db->getResult()) {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
                if ($this->req->getPost("submit")) {
                    $nis = intval($this->req->getPost("nis"));
                    $nisn = intval($this->req->getPost("nisn"));
                    $tl = $this->db->escapeString($this->req->getPost("tempat_lahir"));
                    $tgll = $this->db->escapeString($this->req->getPost("tgl_lahir"));
                    $nohp = $this->db->escapeString($this->req->getPost("no_telp"));
                    $nama_siswa = $this->db->escapeString($this->req->getPost("nama_siswa"));
                    $id_kelas = intval($this->req->getPost("kelas"));
                    $alamat = $this->db->escapeString($this->req->getPost("alamat"));
                    $provinsi = $this->db->escapeString($this->req->getPost("provinsi"));
                    $kabupaten = $this->db->escapeString($this->req->getPost("kabupaten"));
                    $kecamatan = $this->db->escapeString($this->req->getPost("kecamatan"));
                    $kelurahan = $this->db->escapeString($this->req->getPost("kelurahan"));
                    $username = $this->db->escapeString($this->req->getPost("username"));
                    $data = [
                        "nis" => intval($nis),
                        "nisn" => intval($nisn),
                        "nama_siswa" => $nama_siswa,
                        "id_kelas" => $id_kelas,
                        "tempat_lahir" => $tl,
                        "tgl_lahir" => $tgll,
                        "no_telp" => $nohp,
                        "alamat" => $alamat,
                        "provinsi" => $provinsi,
                        "kabupaten" => $kabupaten,
                        "kecamatan" => $kecamatan,
                        "kelurahan" => $kelurahan,
                        "username" => $username,
                    ];
                    if ($this->req->getPost("password")){
                        $password = password_hash($this->req->getPost("password"), PASSWORD_DEFAULT);
                        $data += ["password" => $password];
                    }
                    $this->db->table("siswa")->update($data, ["id_siswa" => intval($id)]);
                    if ($this->db->affectedRows() > 0) {
                        die(json_encode(["status" => "success", "msg" => "Berhasil Mengedit Siswa"]));
                    } else {
                        die(json_encode(["status" => "error", "msg" => "Gagal Mengedit Siswa"]));
                    }
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } elseif ($act == "get") {
            $db = $this->db->table("siswa a")->select("a.*, b.nama_wali, b.alamat as alamat_wali, b.provinsi as provinsi_wali, b.kabupaten as kabupaten_wali, b.kecamatan as kecamatan_wali, b.kelurahan as kelurahan_wali, b.username as username_wali")->join("keluarga b", "a.id_keluarga = b.id_keluarga");
            if ($id !== NULL) {
                $db = $db->where(["id_siswa" => intval($id)]);
            }
            $db = $db->get()->getRowArray();
            unset($db["password"]);
            die(json_encode(["status" => "success", "data" => $db]));
        }
    }
    public function kelas($act, $id = NULL) {
        if ($act == "insert") {
            if ($this->req->getPost("kelas")){
                $kelas = $this->db->escapeString($this->req->getPost("kelas"));
                $this->db->table("kelas")->insert(["nama_kelas" => $kelas]);
                if ($this->db->affectedRows() > 0){
                    die(json_encode(["status" => "success", "msg" => "Berhasil Menambah Kelas"]));
                }
                else {
                    die(json_encode(["status" => "error", "msg" => "Gagal Menambah Kelas"]));
                }
            }
            else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
        elseif ($act == "edit"){
            if ($id !== NULL){
                $db = $this->db->table("kelas")->where(["id_kelas" => intval($id)])->get();
                if (!$db->getResult()){
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
                if ($this->req->getPost("kelas")){
                    $kelas = $this->db->escapeString($this->req->getPost("kelas"));
                    $this->db->table("kelas")->update(["nama_kelas" => $kelas], ["id_kelas" => intval($id)]);
                    if ($this->db->affectedRows() > 0){
                        die(json_encode(["status" => "success", "msg" => "Berhasil Mengedit Kelas"]));
                    }
                    else {
                        die(json_encode(["status" => "error", "msg" => "Gagal Mengedit Kelas"]));
                    }
                }
                else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            }
            else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
        elseif ($act == "get"){
            $db = $this->db->table("kelas");
            if ($id !== NULL){
                $db = $db->where(["id_kelas" => intval($id)]);
            }
            $db = $db->get();
            die(json_encode(["status" => "success", "data" => $db->getResultArray()]));
        }
        elseif ($act == "table"){
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
        elseif ($act == "delete"){
            if ($id !== NULL){
                $db = $this->db->table("kelas")->where(["id_kelas" => intval($id)])->get();
                if (!$db->getResult()){
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
                if ($this->req->getPost("delete") == "true"){
                    $this->db->table("kelas")->delete(["id_kelas" => intval($id)]);
                    if ($this->db->affectedRows() > 0){
                        die(json_encode(["status" => "success", "msg" => "Berhasil Mengehapus Kelas"]));
                    }
                    else {
                        die(json_encode(["status" => "error", "msg" => "Gagal Menghapus Kelas"]));
                    }
                }            
            }
            else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
    public function keahlian_guru($act, $id = NULL){
        if ($act == "update"){
            if ($this->req->getPost("guru") && $this->req->getPost("mapel")){
                $id_guru = intval($this->req->getPost("guru"));
                $id_mapel = [];
                foreach ($this->req->getPost("mapel") as $c){
                    array_push($id_mapel, intval($c));
                }
                $id_mapel = json_encode($id_mapel);
                $this->db->table("guru")->update(["keahlian" => $id_mapel], ["id_guru" => $id_guru]);
                if ($this->db->affectedRows() > 0){
                    die(json_encode(["status" => "success", "msg" => "Berhasil Update Data Keahlian Guru"]));
                }
                else {
                    die(json_encode(["status" => "error", "msg" => "Gagal Update Data Keahlian Guru"]));
                }
            }
        }
        elseif ($act == "table"){
            $db = $this->db->table("guru")->get();
            if (!$db->getRow()){
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $data = [];
            foreach ($db->getResult() as $i => $c){
                $i++;
                $mapel = $c->keahlian;
                $finalMapel = "";
                if ($mapel !== NULL){
                    $sql = "SELECT * FROM mapel WHERE id_mapel IN :id:";
                    $get = $this->db->query($sql, ["id" => json_decode($mapel)]);
                    foreach ($get->getResult() as $cs){
                        $finalMapel .= "$cs->nama_mapel, ";
                    }
                    $finalMapel = substr($finalMapel, 0, strlen($finalMapel) - 2);
                }
                else {
                    $finalMapel = "Belum Ada";
                }
                if ($id !== NULL)
                    array_push($data, [$i, $c->nama_guru, $finalMapel, $c->id_guru]);
                else
                    array_push($data, [$i, $c->nama_guru, $finalMapel]);
            }
            die(json_encode(["data" => $data]));
        }
        elseif ($act == "get"){
            $db = $this->db->table("guru");
            if ($id !== NULL){
                $db = $db->where(["id_guru" => intval($id)]);
            }
            $db = $db->get();
            if (!$db->getResult()){
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $data = [];
            foreach ($db->getResultArray() as $c){
                $c["keahlian"] = json_decode($c['keahlian']);
                $data += [$c];
            }
            die(json_encode(["status" => "success", "data" => $data]));
        }
        elseif ($act == "delete"){
            if ($id !== NULL){
                $db = $this->db->table("guru")->where(['id_guru' => intval($id)])->get();
                if (!$db->getRow()){
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
                $this->db->table("guru")->update(["keahlian" => NULL], ["id_guru" => intval($id)]);
                if ($this->db->affectedRows() > 0){
                    die(json_encode(["status" => "success", "msg" => "Berhasil Delete Data Keahlian Guru"]));
                }
                else {
                    die(json_encode(["status" => "error", "msg" => "Gagal Delete Data Keahlian Guru"]));
                }
            }
        }
    }
    public function kbm($act, $id = NULL){
        if ($act == "insert"){
            if ($this->req->getPost("guru") && $this->req->getPost("kelas") && $this->req->getPost("mapel")){
                $guru = intval($this->req->getPost("guru"));
                $kelas = intval($this->req->getPost("kelas"));
                $mapel = intval($this->req->getPost("mapel"));

                $data = [
                    "id_guru" => $guru,
                    "id_kelas" => $kelas,
                    "id_mapel" => $mapel
                ];
                $this->db->table("pembelajaran")->insert($data);
                if ($this->db->affectedRows() > 0){
                    die(json_encode(["status" => "success", "msg" => "Berhasil Menambah Data KBM"]));
                }
                else {
                    die(json_encode(["status" => "error", "msg" => "Gagal Menambah Data KBM"]));
                }

            }
        }
        elseif ($act == "edit"){
            if ($id !== NULL) {
                if ($this->req->getPost("guru") && $this->req->getPost("kelas") && $this->req->getPost("mapel")){
                    $db = $this->db->table("pembelajaran")->where(["id_pembelajaran" => intval($id)])->get();
                    if (!$db->getRow()){
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    }
                    $guru = intval($this->req->getPost("guru"));
                    $kelas = intval($this->req->getPost("kelas"));
                    $mapel = intval($this->req->getPost("mapel"));
    
                    $data = [
                        "id_guru" => $guru,
                        "id_kelas" => $kelas,
                        "id_mapel" => $mapel
                    ];
                    $this->db->table("pembelajaran")->update($data, ["id_pembelajaran" => intval($id)]);
                    if ($this->db->affectedRows() > 0){
                        die(json_encode(["status" => "success", "msg" => "Berhasil Mengedit Data KBM"]));
                    }
                    else {
                        die(json_encode(["status" => "error", "msg" => "Gagal Mengedit Data KBM"]));
                    }
                }
            }
        }
        elseif ($act == "delete"){
            if ($id !== NULL){
                $db = $this->db->table("pembelajaran")->where(['id_pembelajaran' => intval($id)])->get();
                if (!$db->getRow()){
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
                $this->db->table("pembelajaran")->delete(["id_pembelajaran" => intval($id)]);
                if ($this->db->affectedRows() > 0){
                    die(json_encode(["status" => "success", "msg" => "Berhasil Delete Data KBM"]));
                }
                else {
                    die(json_encode(["status" => "error", "msg" => "Gagal Delete Data KBM"]));
                }
            }
        }
        elseif ($act == "get"){
            $db = $this->db->table("pembelajaran");
            if ($id !== NULL){
                $db = $db->where(["id_pembelajaran" => intval($id)]);
            }
            $db = $db->get();
            if (!$db->getRow()){
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            die(json_encode(["status" => "success", "data" => $db->getResultArray()]));
        }
        elseif ($act == "table"){
            $db = $this->db->table("pembelajaran a")->join("guru b", "a.id_guru = b.id_guru")->join("kelas c", "a.id_kelas = c.id_kelas")->join("mapel d", "a.id_mapel = d.id_mapel")->get();
            $data = [];
            foreach ($db->getResult() as $i => $c){
                $i++;
                if ($id !== NULL)
                    array_push($data, [$i, $c->nama_guru, $c->nama_kelas, $c->nama_mapel, $c->id_pembelajaran]);
                else
                array_push($data, [$i, $c->nama_guru, $c->nama_kelas, $c->nama_mapel]);
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