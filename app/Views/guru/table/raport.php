<div class="row">
    <div class="col-md-12 col-12 mb-4">
        <select class="form-control" name="siswa" id="gantisiswa">
            <option value="null"> -- Pilih Siswa -- </option>
            <?php
                foreach ($kelas as $data){
                    $c = db_connect();
                    $kelas = $c->table("kelas")->where(["id_kelas" => $data])->get()->getRow()->nama_kelas;
                    echo "<optgroup label='Kelas $kelas'>";
                        $murid = $c->table("siswa")->where(["id_kelas" => $data])->get();
                        foreach ($murid->getResult() as $m){
                            echo "<option value='$m->id_siswa'>  $m->nama_siswa  </option>";
                        }
                    echo "</optgroup>";
                }
                ?>
        </select>
    </div>
    <div class="col-md-12 col-12" id="tabel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <table style="width: 100%;" id="dataTable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mapel </th>
                        <th> Nilai Tugas </th>
                        <th> Nilai UTS </th>
                        <th> Nilai UAS </th>
                        <th> Nilai Akhir </th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Mapel </th>
                        <th> Nilai Tugas </th>
                        <th> Nilai UTS </th>
                        <th> Nilai UAS </th>
                        <th> Nilai Akhir </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    var table = $("#dataTable").DataTable({
        ajax: '<?= base_url()?>/guru/api/raport/get/0',
        responsive:!0,
        destroy: true
    });
    $("#gantisiswa").on("change", function(){
        table.destroy();
        table = $("#dataTable").DataTable({
            ajax: '<?= base_url()?>/guru/api/raport/get/' + $(this).val(),
            responsive:!0,
            destroy: true
        });
    });
</script>