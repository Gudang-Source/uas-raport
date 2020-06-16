<style>
    .selected {
        background-color: #fb0000 !important;
    }
</style>
<div class="row">
    <div class="col-md-4 col-12 d-none" id="form_tambah">
        <div class="main-card mb-3 card">
            <div class="card-body">
            <form id="formku">
                <div class="form-group">
                    <label for=""> Nama Guru </label>
                    <select id="guru" name="guru" class="form-control">
                        <option value=""> -- Pilih Guru -- </option>
                        <?php
                            foreach ($guru->getResult() as $c){
                                echo "<option value='$c->id_guru'> $c->nama_guru </option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for=""> Kelas </label>
                    <select id="kelas" name="kelas" class="form-control">
                        <option value=""> -- Pilih Kelas -- </option>
                        <?php
                            foreach ($kelas->getResult() as $c){
                                echo "<option value='$c->id_kelas'> $c->nama_kelas </option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for=""> Nama Mapel </label>
                    <select id="mapel" name="mapel" class="form-control">
                        <option value=""> -- Pilih Mapel -- </option>
                        <?php
                            foreach ($mapel->getResult() as $c){
                                echo "<option value='$c->id_mapel'> $c->nama_mapel </option>";
                            }
                        ?>
                    </select>
                    <input type="hidden" name="id" id="id_kbm">
                </div>
                <div class="form-group">
                    <input type="button" name="submit" value="Tambah KBM" class="btn btn-primary" onclick="save()">
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-12" id="tabel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <table style="width: 100%;" id="dataTable" class="table table-hover table-stri table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Guru</th>
                        <th>Kelas</th>
                        <th>Nama Mapel</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Guru</th>
                        <th>Kelas</th>
                        <th>Nama Mapel</th>
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
        createdRow: function( row, data, dataIndex ) {
            $.ajax({
                url: "<?= base_url() ?>/admin/api/kbm/table/1",
                type: "GET",
                success: function(c){
                    for (var i = 0; i < c['data'].length; i++){
                        if (data[0] == i + 1){
                            $(row).attr('onclick','edit('+c['data'][i][4]+')');
                        }
                    }
                }
            });
        },
        ajax: '<?= base_url()?>/admin/api/kbm/table',
        responsive:!0,
        destroy: true
    });
    function hapus(){
        var deletemode = 0;
        $('#dataTable tbody tr').each(function() {
            if ($(this).attr("onclick") !== undefined){
                deletemode = 1;
            }
        });
        table.destroy();
        if ($("#btnTool").attr("delete-mode").includes("no") === true){
            table = $("#dataTable").DataTable({
                createdRow: function( row, data, dataIndex ) {
                    $.ajax({
                        url: "<?= base_url() ?>/admin/api/kbm/table/1",
                        type: "GET",
                        success: function(c){
                            for (var i = 0; i < c['data'].length; i++){
                                if (data[0] == i + 1){
                                    $(row).attr('id',c['data'][i][4]);
                                }
                            }
                        }
                    });
                },
                ajax: '<?= base_url()?>/admin/api/kbm/table',
                responsive:!0,
                destroy: true
            });
            $("#btnTool i").removeClass("fa-star");
            $("#btnTool").removeClass("btn-dark");
            $("#btnTool").addClass("btn-danger");
            $("#btnTool i").addClass("fa-trash");
            $("#btnTool").attr("delete-mode", "yes go");
            $("#btnTool").attr("title","Delete Selected Rows");
            $("#btnTool").attr("data-original-title","Delete Selected Rows");
            $("#btnTool").attr("onclick","del()");
        }
        else {
            table = $("#dataTable").DataTable({
                createdRow: function( row, data, dataIndex ) {
                    $.ajax({
                        url: "<?= base_url() ?>/admin/api/kbm/table/1",
                        type: "GET",
                        success: function(c){
                            for (var i = 0; i < c['data'].length; i++){
                                if (data[0] == i + 1){
                                    $(row).attr('onclick','edit('+c['data'][i][4]+')');
                                }
                            }
                        }
                    });
                },
                ajax: '<?= base_url()?>/admin/api/kbm/table',
                responsive:!0,
                destroy: true
            });
            $("#btnTool i").addClass("fa-star");
            $("#btnTool").addClass("btn-dark");
            $("#btnTool").removeClass("btn-danger");
            $("#btnTool i").removeClass("fa-trash");
            $("#btnTool").attr("delete-mode", "no");
            $("#btnTool").attr("title","Example Tooltip");
            $("#btnTool").attr("data-original-title","Example Tooltip");
        }
        if (deletemode == 1){
            $('#dataTable tbody').on( 'click', 'tr', function () {
                if ($(this).attr("class").includes("selected") === true){
                    $(this).removeClass("selected");
                }
                else {
                    $(this).addClass("selected");
                }
            });
        }
        else {
            $('#dataTable tbody').on( 'click', 'tr', function () {
               $(this).removeClass("selected");
            });

        }
    }
    function tambah(){
        // if ()
        if ($("#form_tambah").attr("class").includes("d-none") === true){
            if ($("#id_kbm").val() != ""){
                $("select").val("");
                $(".btn-primary").val("Tambah KBM");   
            }
            $("#form_tambah").removeClass("d-none");
            $("#tabel").removeClass("col-md-12");
            $("#tabel").addClass("col-md-8");
        }
        else {
            if ($("#id_kbm").val() != ""){
                $("#select").val("");
                $(".btn-primary").val("Tambah Mapel");   
            }
            else {
                $("#form_tambah").addClass("d-none");
                $("#tabel").removeClass("col-md-8");
                $("#tabel").addClass("col-md-12");
            }
        }
    }
    function edit(id){
        $.ajax({
            url: "<?= base_url(); ?>/admin/api/kbm/get/" + id,
            type: "GET",
            success: function(c){
                $("#guru").val(c['data'][0]["id_guru"]);
                $("#kelas").val(c['data'][0]["id_kelas"]);
                $("#mapel").val(c['data'][0]["id_mapel"]);
                $("#id_kbm").val(c['data'][0]["id_pembelajaran"]);
                $(".btn.btn-primary").val("Edit KBM");
                if ($("#form_tambah").attr("class").includes("d-none") === true){
                    $("#form_tambah").removeClass("d-none");
                    $("#tabel").removeClass("col-md-12");
                    $("#tabel").addClass("col-md-8");
                }
            }
        });
    }
    function save(){
        if ($("#id_kbm").val() != ""){
            var url = "<?= base_url() ?>/admin/api/kbm/edit/" + $("#id_kbm").val();
        }
        else {
            var url = "<?= base_url() ?>/admin/api/kbm/insert";
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: $("#formku").serialize(),
            success: function(c){
                if (c['status'] == "success"){
                    Swal.fire({
                        title: 'Berhasil !',
                        text: c['msg'],
                        icon: 'success',
                        confirmButtonText: 'Okey'
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
                $("select").val("");
                $("#id_kbm").val("");
                $(".btn.btn-primary").val("Add Mapel");
                table.ajax.reload( null, false );
            }
        });
    }
    function del(){
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
                table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                    if (this.nodes().to$().attr("class").includes("selected") === true){
                        id.push(this.nodes().to$().attr("id"));
                    }
                } );
                for (var i = 0; i < id.length; i++){
                    $.ajax({
                        async: false,
                        url: "<?= base_url() ?>/admin/api/kbm/delete/"+ id[i],
                        type: "POST",
                        data: "delete=true",
                        success: function(c){
                            if (c['status'] == "success"){
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
                    table.ajax.reload( null, false );
                }
            }
        });
    }
</script>