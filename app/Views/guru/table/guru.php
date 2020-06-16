<style>
    .selected {
        background-color: #fb0000 !important;
    }
</style>
<div class="col-md-12 col-12" id="form_tambah">
    <div class="main-card mb-3 card">
        <div class="card-body">
        <form id="formku">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for="nip">NIP <small>*</small></label>
                        <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP">
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="form-group">
                        <label for="nama_guru">Nama Guru <small>*</small></label>
                        <input type="text" class="form-control" name="nama_guru" id="nama_guru" placeholder="Nama Guru">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="form-group">
                        <label for=""> Alamat </label>
                        <textarea name="alamat" class="form-control" style="resize:none;min-height:50px" id="alamat"></textarea>
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
            <input type="hidden" name="id" id="id_guru">
            <br>
            <div class="form-group">
                <button type="button" class="btn btn-primary" name="submit" onclick="save()">Edit Data</button>
            </div>
        </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>

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
    function getProvinsi(name){
        $.ajax({
            async: false,
            url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/provinsi',
            type: 'GET',
            dataType: 'json',
            success: function(json) {
                if (json.code == 200) {
                    $("#propinsi option:selected").removeAttr("selected");
                    for (i = 0; i < Object.keys(json.data).length; i++) {
                        if (json.data[i].name == name){
                            $('#propinsi').append($('<option selected>').text(json.data[i].name).attr('value', json.data[i].id));
                            $("#nprovinsi").val(name);
                        }
                        else {
                            $('#propinsi').append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
                        }
                    }
                } else {
                    $('#kabupaten').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                }
            }
        });
    }
    function getKabupaten(name){
        var propinsi = $("#propinsi").val();
        $.ajax({
            async: false,
            url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kabupaten',
            data: "idpropinsi=" + propinsi,
            type: 'GET',
            cache: false,
            dataType: 'json',
            success: function(json) {
                $("#kabupaten").html('<option value=""> -- Pilih Kabupaten -- </option>');
                if (json.code == 200) {
                    for (i = 0; i < Object.keys(json.data).length; i++) {
                        if (json.data[i].name == name){
                            $('#kabupaten').append($('<option selected>').text(json.data[i].name).attr('value', json.data[i].id));
                            $("#nkabupaten").val(name);
                        }
                        else {
                            $('#kabupaten').append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
                        }
                    }
                    $('#kecamatan').html($('<option selected>').text('-- Pilih Kecamatan --').attr('value', ''));
                    $('#kelurahan').html($('<option selected>').text('-- Pilih Kelurahan --').attr('value', ''));

                } else {
                    $('#kabupaten').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                }
            }
        });
    }
    function getKecamatan(name){
        var propinsi = $("#propinsi").val();
        var kabupaten = $("#kabupaten").val();
        $.ajax({
            async: false,
            url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kecamatan',
            data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi,
            type: 'GET',
            cache: false,
            dataType: 'json',
            success: function(json) {
                $("#kecamatan").html('<option value=""> -- Pilih Kecamatan -- </option>');
                if (json.code == 200) {
                    for (i = 0; i < Object.keys(json.data).length; i++) {
                        if (json.data[i].name == name){
                            $('#kecamatan').append($('<option selected>').text(json.data[i].name).attr('value', json.data[i].id));
                            $("#nkecamatan").val(name);
                        }
                        else {
                            $('#kecamatan').append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
                        }$("#nkecamatan").val(name);
                    }
                    $('#kelurahan').html($('<option>').text('-- Pilih Kelurahan --').attr('value', '-- Pilih Kelurahan --'));

                } else {
                    $('#kecamatan').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                }
            }
        });
    }
    function getKelurahan(name){
        var propinsi = $("#propinsi").val();
        var kabupaten = $("#kabupaten").val();
        var kecamatan = $("#kecamatan").val();
        $.ajax({
            url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kelurahan',
            data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi + "&idkecamatan=" + kecamatan,
            type: 'GET',
            dataType: 'json',
            cache: false,
            success: function(json) {
                $("#kelurahan").html('<option value=""> -- Pilih Kelurahan -- </option>');
                if (json.code == 200) {
                    for (i = 0; i < Object.keys(json.data).length; i++) {
                        if (json.data[i].name == name){
                            $('#kelurahan').append($('<option selected>').text(json.data[i].name).attr('value', json.data[i].id));
                            $("#nkelurahan").val(name);
                        }
                        else {
                            $('#kelurahan').append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
                        }
                    }
                } else {
                    $('#kelurahan').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                }
            }
        });
    }
    $(document).ready(function(){
        $.ajax({
            url: "<?= base_url(); ?>/guru/api/guru/get/" + <?= session()->get("id") ?>,
            type: "GET",
            success: function(c) {
                $("#nip").val(c['data'][0]['nip']);
                $("#nama_guru").val(c['data'][0]['nama_guru']);
                $("#alamat").val(c['data'][0]['alamat']);
                getProvinsi(c['data'][0]['provinsi']);
                getKabupaten(c['data'][0]['kabupaten']);
                getKecamatan(c['data'][0]['kecamatan']);
                getKelurahan(c['data'][0]['kelurahan']);
                $("#username").val(c['data'][0]['username']);
                $("#id_guru").val(c['data'][0]['id_guru']);
                $(".btn.btn-primary").text("Edit Data");
                if ($("#form_tambah").attr("class").includes("d-none") === true) {
                    $("#form_tambah").removeClass("d-none");
                }
            }
        });
    });
    function save() {
        var url = "<?= base_url() ?>/guru/api/guru/edit/<?= session()->get("id") ?>";
        $.ajax({
            url: url,
            type: 'POST',
            data: $("#formku").serialize(),
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
            }
        });
    }
</script>