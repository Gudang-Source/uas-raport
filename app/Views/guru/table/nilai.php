<div class="jumbotron">
    <h1>Pilih Siswa</h1>
</div>
<div class="row">
    <div class="col-md-12">
        <form id="nilaiForm">
        <select class="form-control" name="siswa" id="gantisiswa">
            <option value="null"> -- Pilih Siswa -- </option>
            <?php
                foreach ($db as $data){
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
</div>
<div class="mt-4 jumbotron">
    <h1>Pilih Mapel</h1>
</div>
<div class="row">
    <div class="col-md-12">
        <form id="nilaiForm">
        <select class="form-control" name="mapel" id="mapel">
            <option value="null"> -- Pilih Mapel -- </option>
        </select>
    </div>
</div>
<div class="mt-4 jumbotron">
    <h1>Nilai Tugas</h1>
</div>
<div class="row" id="addTugas">
    <div class="col-md-6 col-12">
        <div id="inputFormRow">
            <div class="input-group mb-3">
                <input type="text" name="tugas[]" class="form-control m-input" placeholder="Nilai Tugas" autocomplete="off" disabled="true"> 
                <div class="input-group-append">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <button id="addRow" type="button" class="btn btn-info"><i class="fa fa-plus"></i></button>
    </div>
</div>
<div class=" mt-4 jumbotron">
    <h1>Nilai UTS & Nilai UAS</h1>
</div>
<div class="row mb-4">
    <div class="col-md-6 col-12">
        <input type="text" name="uts" class="form-control m-input" placeholder="Nilai UTS" autocomplete="off" disabled="true">
    </div>
    <div class="col-md-6 col-12">
        <input type="text" name="uas" class="form-control m-input" placeholder="Nilai UAS" autocomplete="off" disabled="true">
    </div>
</div>
<button type="button" class="btn btn-primary mb-4" onclick="save()"> Input Nilai </button>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>

<script type="text/javascript">
    $("#addRow").click(function () {
        var html = '';
        html += '<div class="col-md-6 col-12>'
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        if ($("#gantisiswa").val() !== ""){
            html += '<input type="text" name="tugas[]" class="form-control m-input" placeholder="Nilai Tugas" autocomplete="off">';
        }
        else {
            html += '<input type="text" name="tugas[]" class="form-control m-input" placeholder="Nilai Tugas" autocomplete="off" disabled>';
        }
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('#addTugas').append(html);
        if ($("input[name='tugas[]']").length <= 1){
            $("#removeRow").remove();
        }
        else {
            $("#inputFormRow").each(function(){
                if ($(this).find("#removeRow").length === 0){
                    $(this).find(".input-group-append").append('<button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>');
                }
            });
        }
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('.col-md-6').remove();
        if ($("input[name='tugas[]']").length <= 1){
            $("#removeRow").remove();
        }
        else {
            $("#inputFormRow").each(function(){
                if ($(this).find("#removeRow").length === 0){
                    $(this).find(".input-group-append").append('<button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>');
                }
            });
        }
    });
    $("#gantisiswa").on("change", function(){
        $("#mapel").html("<option value=''> -- Pilih Mapel -- </option>");
        $.ajax({
            url: "<?= base_url() ?>/guru/api/nilai/get_mapel/" + $("#gantisiswa").val(),
            type: "GET",
            success: function(x){
                for (var i = 0; i < x['data'].length; i++){
                    $("#mapel").append("<option value='" + x['data'][i][0] + "'>" + x['data'][i][1] + "</option>");
                }
            } 
        });
    });
    $("#mapel").on("change", function(){
        $.ajax({
            async: false,
            url: "<?= base_url() ?>/guru/api/nilai/ganti_siswa/" + $("#gantisiswa").val() + "/" + $(this).val() ,
            type: "GET",
            success: function(c){
                $("input[name='tugas[]'").each(function(){
                    $("#removeRow").click();
                    $("input").val("");

                });
                $("input").removeAttr("disabled");
                if (c['data'] !== null){
                    for (var i = 0; i < c['data']['nilai_tugas'].length - 1; i++){
                        $("#addRow").click();
                        var x = 0;
                        $("input[name='tugas[]'").each(function(){
                            $(this).val(c['data']['nilai_tugas'][x]);
                            x++;
                        });
                    }
                    $("input[name='uts']").val(c['data']['nilai_uts']);
                    $("input[name='uas']").val(c['data']['nilai_uas']);
                }
                else {
                    $("input").val("");
                    $("input").attr("disabled","true");
                    $("input[name='tugas[]'").each(function(){
                        $("#removeRow").click();
                    });
                }
            }
        });
    });
    function save(){
        var nilai_tugas = [];
        var data = $("#nilaiForm").serialize();
        $("input[name='tugas[]']").each(function(){
           nilai_tugas.push($(this).val());
        });
        for (var i = 1; i < nilai_tugas.length; i++){
            data += "&tugas[]=" + nilai_tugas[i].toString();
        }
        $.ajax({
            url: "<?= base_url() ?>/guru/api/nilai/update",
            type: "POST",
            data: data,
            success: function(c){
                if (c['status'] == "success"){
                    Swal.fire({
                        title: 'Berhasil !',
                        text: c['msg'],
                        icon: 'success',
                        confirmButtonText: 'Okey'
                    });
                    $("#gantisiswa,#mapel").val("null");
                    $("input").val("");
                    $("input[name='tugas[]'").each(function(){
                        $("#removeRow").click();
                    });
                }
                else {
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
