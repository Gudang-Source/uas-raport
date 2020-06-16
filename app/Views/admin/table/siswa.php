<style>
    .selected {
        background-color: #fb0000 !important;
    }
</style>
<div class="col-md-12 col-12 d-none" id="form_tambah">
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="jumbotron">
                <h1> Data Siswa </h1>
            </div>
            <form id="formku">
            <div class="row">
                <div class="col-sm-4 col-12">
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa">
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" class="form-control" name="nis" id="nis" placeholder="NIS">
                    </div>
                </div>
                <div class="col-sm-4 col-12">
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control" name="nisn" id="nisn" placeholder="NISN">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat lahir">
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal lahir">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for=""> Kelas </label>
                        <select name="kelas" id="kelas" class="form-control">
                            <option value=""> -- Pilih Kelas -- </option>
                            <?php
                                foreach ($kelas->getResult() as $c){
                                    echo "<option value='$c->id_kelas'> $c->nama_kelas </option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for="no_telp">Nomer Telepon</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Nomer Telepon yang bisa dihubungi">
                    </div>                            
                </div>        
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" style="resize:none"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for="form_sex">Provinsi <small>*</small></label>
                        <select class="form-control m-b" id="propinsi">
                            <option selected value="">-- Pilih Provinsi --</option>
                        </select>
                        <input type="hidden" name="provinsi" id="nprovinsi">
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for="form_post">Kab / Kota <small>*</small></label>
                        <select class="form-control m-b" id="kabupaten">
                            <option selected value="">-- Pilih Kabupaten --</option>
                        </select>
                        <input type="hidden" name="kabupaten" id="nkabupaten">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-12">
                    <label for="form_sex">Kecamatan <small>*</small></label>
                    <select class="form-control m-b" id="kecamatan">
                        <option selected value="">-- Pilih Kecamatan --</option>
                    </select>
                    <input type="hidden" name="kecamatan" id="nkecamatan">
                </div>
                <div class="col-sm-6 col-12">
                    <label for="form_post">Kelurahan / Desa <small>*</small></label>
                    <select class="form-control m-b" id="kelurahan">
                        <option selected value="">-- Pilih Kelurahan --</option>
                    </select>
                    <input type="hidden" name="kelurahan" id="nkelurahan">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for="nip">Username <small>*</small></label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for="nama_guru">Password <small>*</small></label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" id="id_siswa">
            <div class="mt-4 jumbotron">
                <h1> Data Wali </h1>
            </div>
            <select class="form-control mb-4" id="wali">
                <option value="" selected> -- Pilih Wali -- </option>
                <option value="new"> Buat Baru </option>
                <?php
                    foreach ($wali->getResult() as $c){
                        echo "<option value='$c->id_keluarga'> $c->nama_wali </option>";
                    }
                ?>
            </select>
            <div class="d-none" id="formWali">
                <div class="row">
                    <div class="col-sm-12 col-12">
                        <div class="form-group">
                            <label for="nama_siswa">Nama Wali</label>
                            <input type="text" class="form-control" name="nama_wali" id="nama_wali" placeholder="Nama Wali">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat_wali" id="alamat_wali" style="resize:none"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <label for="form_sex">Provinsi <small>*</small></label>
                            <select class="form-control m-b" id="propinsiW">
                                <option selected value="">-- Pilih Provinsi --</option>
                            </select>
                            <input type="hidden" name="provinsi_wali" id="nprovinsiW">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <label for="form_post">Kab / Kota <small>*</small></label>
                            <select class="form-control m-b" id="kabupatenW">
                                <option selected value="">-- Pilih Kabupaten --</option>
                            </select>
                            <input type="hidden" name="kabupaten_wali" id="nkabupatenW">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <label for="form_sex">Kecamatan <small>*</small></label>
                        <select class="form-control m-b" id="kecamatanW">
                            <option selected value="">-- Pilih Kecamatan --</option>
                        </select>
                        <input type="hidden" name="kecamatan_wali" id="nkecamatanW">
                    </div>
                    <div class="col-sm-6 col-12">
                        <label for="form_post">Kelurahan / Desa <small>*</small></label>
                        <select class="form-control m-b" id="kelurahanW">
                            <option selected value="">-- Pilih Kelurahan --</option>
                        </select>
                        <input type="hidden" name="kelurahan_wali" id="nkelurahanW">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <label for="nip">Username <small>*</small></label>
                            <input type="text" class="form-control" name="username_wali" id="username_wali" placeholder="Username Wali">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <label for="nama_guru">Password <small>*</small></label>
                            <input type="password" class="form-control" name="password_wali" placeholder="Password Wali">
                        </div>
                    </div>
                    <input type="hidden" name="id_keluarga" id="id_keluarga">
                </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" name="submit" onclick="save()">Tambah Siswa</button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="col-md-12 col-12" id="tabel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <table style="width: 100%;" id="dataTable" class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th> No Telp </th>
                        <th>Nama Wali</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th> No Telp </th>
                        <th>Nama Wali</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
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


<script type="text/javascript">
    var return_first = function() {
        var tmp = null;
        $.ajax({
            'async': false,
            'type': "get",
            'global': false,
            'dataType': 'json',
            'url': 'https://x.rajaapi.com/poe',
            'success': function(data) {
                tmp = data.token;
            }
        });
        return tmp;
    }();
    $(document).ready(function() {
        $.ajax({
            url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/provinsi',
            type: 'GET',
            dataType: 'json',
            success: function(json) {
                if (json.code == 200) {
                    for (i = 0; i < Object.keys(json.data).length; i++) {
                        $('#propinsi').append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
                    }
                } else {
                    $('#kabupaten').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                }
            }
        });
        $("#propinsi").change(function() {
            var propinsi = $("#propinsi").val();
            $.ajax({
                url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kabupaten',
                data: "idpropinsi=" + propinsi,
                type: 'GET',
                cache: false,
                dataType: 'json',
                success: function(json) {
                    $("#nprovinsi").val($("#propinsi option:selected").text());
                    $("#kabupaten").html('<option value=""> -- Pilih Kabupaten -- </option>');
                    if (json.code == 200) {
                        for (i = 0; i < Object.keys(json.data).length; i++) {
                            $('#kabupaten').append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
                        }
                        $('#kecamatan').html($('<option>').text('-- Pilih Kecamatan --').attr('value', '-- Pilih Kecamatan --'));
                        $('#kelurahan').html($('<option>').text('-- Pilih Kelurahan --').attr('value', '-- Pilih Kelurahan --'));

                    } else {
                        $('#kabupaten').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                    }
                }
            });
        });
        $("#kabupaten").change(function() {
            var kabupaten = $("#kabupaten").val();
            $.ajax({
                url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kecamatan',
                data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi,
                type: 'GET',
                cache: false,
                dataType: 'json',
                success: function(json) {
                    $("#nkabupaten").val($("#kabupaten option:selected").text());
                    $("#kecamatan").html('<option value=""> -- Pilih Kecamatan -- </option>');
                    if (json.code == 200) {
                        for (i = 0; i < Object.keys(json.data).length; i++) {
                            $('#kecamatan').append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
                        }
                        $('#kelurahan').html($('<option>').text('-- Pilih Kelurahan --').attr('value', '-- Pilih Kelurahan --'));

                    } else {
                        $('#kecamatan').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                    }
                }
            });
        });
        $("#kecamatan").change(function() {
            var kecamatan = $("#kecamatan").val();
            $.ajax({
                url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kelurahan',
                data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi + "&idkecamatan=" + kecamatan,
                type: 'GET',
                dataType: 'json',
                cache: false,
                success: function(json) {
                    $("#nkecamatan").val($("#kecamatan option:selected").text());
                    $("#kelurahan").html('<option value=""> -- Pilih Kelurahan -- </option>');
                    if (json.code == 200) {
                        for (i = 0; i < Object.keys(json.data).length; i++) {
                            $('#kelurahan').append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
                        }
                    } else {
                        $('#kelurahan').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                    }
                }
            });
        });
        $("#kelurahan").change(function(){
            $("#nkelurahan").val($("#kelurahan option:selected").text());
        });
    });

    function getProvinsi(name, suffix = ""){
        $.ajax({
            async: false,
            url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/provinsi',
            type: 'GET',
            dataType: 'json',
            success: function(json) {
                if (json.code == 200) {
                    $("#propinsi" + suffix + "option:selected").removeAttr("selected");
                    for (i = 0; i < Object.keys(json.data).length; i++) {
                        if (json.data[i].name == name){
                            $('#propinsi'+suffix).append($('<option selected>').text(json.data[i].name).attr('value', json.data[i].id));
                            $("#nprovinsi"+suffix).val(name);
                        }
                        else {
                            $('#propinsi'+suffix).append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
                        }
                    }
                } else {
                    $('#kabupaten'+suffix).append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                }
            }
        });
    }
    function getKabupaten(name,suffix = ""){
        var propinsi = $("#propinsi"+suffix).val();
        $.ajax({
            async: false,
            url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kabupaten',
            data: "idpropinsi=" + propinsi,
            type: 'GET',
            cache: false,
            dataType: 'json',
            success: function(json) {
                $("#kabupaten" + suffix).html('<option value=""> -- Pilih Kabupaten -- </option>');
                if (json.code == 200) {
                    for (i = 0; i < Object.keys(json.data).length; i++) {
                        if (json.data[i].name == name){
                            $('#kabupaten' + suffix).append($('<option selected>').text(json.data[i].name).attr('value', json.data[i].id));
                            $("#nkabupaten" + suffix).val(name);
                        }
                        else {
                            $('#kabupaten' + suffix).append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
                        }
                    }
                    $('#kecamatan' + suffix).html($('<option selected>').text('-- Pilih Kecamatan --').attr('value', ''));
                    $('#kelurahan' + suffix).html($('<option selected>').text('-- Pilih Kelurahan --').attr('value', ''));

                } else {
                    $('#kabupaten' + suffix).append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                }
            }
        });
    }
    function getKecamatan(name, suffix = ""){
        var propinsi = $("#propinsi"+ suffix).val();
        var kabupaten = $("#kabupaten" + suffix).val();
        $.ajax({
            async: false,
            url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kecamatan',
            data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi,
            type: 'GET',
            cache: false,
            dataType: 'json',
            success: function(json) {
                $("#kecamatan" + suffix).html('<option value=""> -- Pilih Kecamatan -- </option>');
                if (json.code == 200) {
                    for (i = 0; i < Object.keys(json.data).length; i++) {
                        if (json.data[i].name == name){
                            $('#kecamatan' + suffix).append($('<option selected>').text(json.data[i].name).attr('value', json.data[i].id));
                            $("#nkecamatan" + suffix).val(name);
                        }
                        else {
                            $('#kecamatan' + suffix).append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
                        }$("#nkecamatan" + suffix).val(name);
                    }
                    $('#kelurahan' + suffix).html($('<option>').text('-- Pilih Kelurahan --').attr('value', '-- Pilih Kelurahan --'));

                } else {
                    $('#kecamatan' + suffix).append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                }
            }
        });
    }
    function getKelurahan(name, suffix = ""){
        var propinsi = $("#propinsi" + suffix).val();
        var kabupaten = $("#kabupaten" + suffix).val();
        var kecamatan = $("#kecamatan" + suffix).val();
        $.ajax({
            url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kelurahan',
            data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi + "&idkecamatan=" + kecamatan,
            type: 'GET',
            dataType: 'json',
            cache: false,
            success: function(json) {
                $("#kelurahan" + suffix).html('<option value=""> -- Pilih Kelurahan -- </option>');
                if (json.code == 200) {
                    for (i = 0; i < Object.keys(json.data).length; i++) {
                        if (json.data[i].name == name){
                            $('#kelurahan' + suffix).append($('<option selected>').text(json.data[i].name).attr('value', json.data[i].id));
                            $("#nkelurahan" + suffix).val(name);
                        }
                        else {
                            $('#kelurahan' + suffix).append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
                        }
                    }
                } else {
                    $('#kelurahan' + suffix).append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                }
            }
        });
    }

    $("#wali").on("change",function(){
        var wali = $("#wali").val();
        if (wali === "new"){
            $("#formWali input, #formWali select, #formWali textarea").val("");
            $("#formWali input, #formWali select, #formWali textarea").removeAttr("disabled");
            $("#kabupatenW").html("<option value=''> -- Pilih Kabupaten -- </option>");
            $("#kecamatanW").html("<option value=''> -- Pilih Kecamatan -- </option>");
            $("#kelurahanW").html("<option value=''> -- Pilih Kelurahan -- </option>");
            $("#formWali").removeClass("d-none");
        }
        else if (wali == ""){
            $("#formWali").addClass("d-none");
        }
        else if ($.isNumeric(wali)){
            $.ajax({
                url: "<?= base_url() ?>/admin/api/siswa/get_wali/" + wali,
                type: "GET",
                success: function(c){
                    $("#nama_wali").val(c['data']['nama_wali']).attr("disabled","");
                    $("#alamat_wali").val(c['data']['alamat']).attr("disabled","");
                    getProvinsi(c['data']['provinsi'], 'W');
                    getKabupaten(c['data']['kabupaten'], 'W');
                    getKecamatan(c['data']['kecamatan'], 'W');
                    getKelurahan(c['data']['kelurahan'], 'W');
                    $("#propinsiW").attr("disabled","");
                    $("#kabupatenW").attr("disabled","");
                    $("#kecamatanW").attr("disabled","");
                    $("#kelurahanW").attr("disabled","");
                    $("#username_wali").val(c['data']['username']).attr("disabled","");
                    $("#id_keluarga").val(c['data']['id_keluarga']).attr("disabled","");
                    $("#formWali").removeClass("d-none");
                }
            });
        }
    });


    var table = $("#dataTable").DataTable({
        createdRow: function(row, data, dataIndex) {
            $.ajax({
                url: "<?= base_url() ?>/admin/api/siswa/table/1",
                type: "GET",
                success: function(c) {
                    for (var i = 0; i < c['data'].length; i++) {
                        if (data[0] == i + 1) {
                            $(row).attr('onclick', 'edit(' + c['data'][i][10] + ')');
                        }
                    }
                }
            });
        },
        ajax: '<?= base_url() ?>/admin/api/siswa/table',
        responsive: !0,
        destroy: true
    });

    function hapus() {
        var deletemode = 0;
        $('#dataTable tbody tr').each(function() {
            if ($(this).attr("onclick") !== undefined) {
                deletemode = 1;
            }
        });
        table.destroy();
        if ($("#btnTool").attr("delete-mode").includes("no") === true) {
            table = $("#dataTable").DataTable({
                createdRow: function(row, data, dataIndex) {
                    $.ajax({
                        url: "<?= base_url() ?>/admin/api/siswa/table/1",
                        type: "GET",
                        success: function(c) {
                            for (var i = 0; i < c['data'].length; i++) {
                                if (data[0] == i + 1) {
                                    $(row).attr('id', c['data'][i][10]);
                                }
                            }
                        }
                    });
                },
                ajax: '<?= base_url() ?>/admin/api/siswa/table',
                responsive: !0,
                destroy: true
            });
            $("#btnTool i").removeClass("fa-star");
            $("#btnTool").removeClass("btn-dark");
            $("#btnTool").addClass("btn-danger");
            $("#btnTool i").addClass("fa-trash");
            $("#btnTool").attr("delete-mode", "yes go");
            $("#btnTool").attr("title", "Delete Selected Rows");
            $("#btnTool").attr("data-original-title", "Delete Selected Rows");
            $("#btnTool").attr("onclick", "del()");
        } else {
            table = $("#dataTable").DataTable({
                createdRow: function(row, data, dataIndex) {
                    $.ajax({
                        url: "<?= base_url() ?>/admin/api/siswa/table/1",
                        type: "GET",
                        success: function(c) {
                            for (var i = 0; i < c['data'].length; i++) {
                                if (data[0] == i + 1) {
                                    $(row).attr('onclick', 'edit(' + c['data'][i][10] + ')');
                                }
                            }
                        }
                    });
                },
                ajax: '<?= base_url() ?>/admin/api/siswa/table',
                responsive: !0,
                destroy: true
            });
            $("#btnTool i").addClass("fa-star");
            $("#btnTool").addClass("btn-dark");
            $("#btnTool").removeClass("btn-danger");
            $("#btnTool i").removeClass("fa-trash");
            $("#btnTool").attr("delete-mode", "no");
            $("#btnTool").attr("title", "Example Tooltip");
            $("#btnTool").attr("data-original-title", "Example Tooltip");
        }
        if (deletemode == 1) {
            $('#dataTable tbody').on('click', 'tr', function() {
                if ($(this).attr("class").includes("selected") === true) {
                    $(this).removeClass("selected");
                } else {
                    $(this).addClass("selected");
                }
            });
        } else {
            $('#dataTable tbody').on('click', 'tr', function() {
                $(this).removeClass("selected");
            });

        }
    }

    function tambah() {
        // if ()
        if ($("#form_tambah").attr("class").includes("d-none") === true) {
            if ($("#id_siswa").val() != "") {
                $(".btn-primary").text("Edit Siswa");
                $("input,select,textarea").val("");
            }
            $("#form_tambah").removeClass("d-none");
        } else {
            if ($("#id_siswa").val() != "") {
                $(".btn-primary").text("Tambah Siswa");
                $("input,select,textarea").val("");
            } else {
                $("#form_tambah").addClass("d-none");
            }
        }
    }

    function edit(id) {
        $.ajax({
            url: "<?= base_url(); ?>/admin/api/siswa/get/" + id,
            type: "GET",
            success: function(c) {
                $("#nama_siswa").val(c['data']['nama_siswa']);
                $("#nis").val(c['data']['nis']);
                $("#nisn").val(c['data']['nisn']);
                $("#tempat_lahir").val(c['data']['tempat_lahir']);
                $("#tgl_lahir").val(c['data']['tgl_lahir']);
                $("#no_telp").val(c['data']['no_telp']);
                $("#alamat").val(c['data']['alamat']);
                getProvinsi(c['data']['provinsi']);
                getKabupaten(c['data']['kabupaten']);
                getKecamatan(c['data']['kecamatan']);
                getKelurahan(c['data']['kelurahan']);
                $("#kelas").val(c['data']['id_kelas']);
                $("#username").val(c['data']['username']);
                $("#nama_wali").val(c['data']['nama_wali']);
                $("#alamat_wali").val(c['data']['alamat_wali']);
                getProvinsi(c['data']['provinsi_wali'], 'W');
                getKabupaten(c['data']['kabupaten_wali'], 'W');
                getKecamatan(c['data']['kecamatan_wali'], 'W');
                getKelurahan(c['data']['kelurahan_wali'], 'W');
                $("#propinsi").removeAttr("disabled");
                $("#kabupaten").removeAttr("disabled");
                $("#kecamatan").removeAttr("disabled");
                $("#kelurahan").removeAttr("disabled");
                $("#username_wali").val(c['data']['username_wali']);
                $("#id_siswa").val(c['data']['id_siswa']);
                $(".btn.btn-primary").text("Edit Siswa");
                if ($("#form_tambah").attr("class").includes("d-none") === true) {
                    $("#form_tambah").removeClass("d-none");
                }
                if ($("#formWali").attr("class").includes("d-none") === true) {
                    $("#formWali").removeClass("d-none");
                }
            }
        });
    }

    function save() {
        if ($("#id_siswa").val() != "") {
            var url = "<?= base_url() ?>/admin/api/siswa/edit/" + $("#id_siswa").val();
            var data = $("#formku").serialize() + "&submit=true";
        } else {
            var url = "<?= base_url() ?>/admin/api/siswa/insert";
            var data = $("#formku").serialize() + "&id_keluarga=" + $("#id_keluarga").val().toString() + "&nama_wali=" + $("#nama_wali").val() + "&username_wali=" + $("#username_wali").val() + "&alamat_wali=" + $("#alamat_wali").val() + "&submit=true";
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(c) {
                if (c['status'] == "success") {
                    Swal.fire({
                        title: 'Berhasil !',
                        text: c['msg'],
                        icon: 'success',
                        confirmButtonText: 'Okey'
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal !',
                        text: c['msg'],
                        icon: 'error',
                        confirmButtonText: 'Okey'
                    });
                }
                $("input,select,textarea").val("");
                $(".btn.btn-primary").text("Tambah Siswa");
                table.ajax.reload(null, false);
            }
        });
    }

    function del() {
        Swal.fire({
            title: 'Anda yakin akan menghapus data yang dipilih?',
            text: "Anda tidak bisa mengembalikan ini lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus itu'
        }).then((result) => {
            if (result.value) {
                var id = [];
                var berhasil = 0;
                table.rows().every(function(rowIdx, tableLoop, rowLoop) {
                    if (this.nodes().to$().attr("class").includes("selected") === true) {
                        id.push(this.nodes().to$().attr("id"));
                    }
                });
                for (var i = 0; i < id.length; i++) {
                    $.ajax({
                        async: false,
                        url: "<?= base_url() ?>/admin/api/siswa/delete/" + id[i],
                        type: "POST",
                        data: "delete=true",
                        success: function(c) {
                            if (c['status'] == "success") {
                                berhasil += 1;
                            }
                        }
                    });
                    Swal.fire({
                        title: 'Berhasil !',
                        text: "Berhasil Menghapus " + berhasil.toString() + " Data",
                        icon: 'success',
                        confirmButtonText: 'Okey'
                    }).then((result) => {

                    });
                    table.ajax.reload(null, false);
                }
            }
        });
    }
</script>