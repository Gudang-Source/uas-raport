<style>
    .selected {
        background-color: #fb0000 !important;
    }
</style>
<div class="row">
    <div class="col-md-4 col-12 d-none" id="form_tambah">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="form-group">
                    <label for=""> Nama Kelas </label>
                    <input type="text" name="kelas" placeholder="Nama Kelas ..." class="form-control" id="nama_kelas">
                    <input type="hidden" name="id" id="id_kelas">
                </div>
                <div class="form-group">
                    <input type="button" name="submit" value="Tambah Kelas" class="btn btn-primary" onclick="save()">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-12" id="tabel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <table style="width: 100%;" id="dataTable" class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <!-- <th> Aksi </th> -->
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas </th>
                        <!-- <th> Aksi </th> -->
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>            <div class="modal-body">
                <p class="mb-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
                url: "<?= base_url() ?>/admin/api/kelas/table/1",
                type: "GET",
                success: function(c){
                    for (var i = 0; i < c['data'].length; i++){
                        if (data[0] == i + 1){
                            $(row).attr('onclick','edit('+c['data'][i][2]+')');
                        }
                    }
                }
            });
        },
        ajax: '<?= base_url()?>/admin/api/kelas/table',
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
                        url: "<?= base_url() ?>/admin/api/kelas/table/1",
                        type: "GET",
                        success: function(c){
                            for (var i = 0; i < c['data'].length; i++){
                                if (data[0] == i + 1){
                                    $(row).attr('id',c['data'][i][2]);
                                }
                            }
                        }
                    });
                },
                ajax: '<?= base_url()?>/admin/api/kelas/table',
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
                        url: "<?= base_url() ?>/admin/api/kelas/table/1",
                        type: "GET",
                        success: function(c){
                            for (var i = 0; i < c['data'].length; i++){
                                if (data[0] == i + 1){
                                    $(row).attr('onclick','edit('+c['data'][i][2]+')');
                                }
                            }
                        }
                    });
                },
                ajax: '<?= base_url()?>/admin/api/kelas/table',
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
            if ($("#id_kelas").val() != ""){
                $(".btn-primary").val("Tambah Kelas");   
                $("#id_kelas").val("");
                $("#nama_kelas").val("");
            }
            $("#form_tambah").removeClass("d-none");
            $("#tabel").removeClass("col-md-12");
            $("#tabel").addClass("col-md-8");
        }
        else {
            if ($("#id_kelas").val() != ""){
                $(".btn-primary").val("Tambah Kelas");   
                $("#id_kelas").val("");
                $("#nama_kelas").val("");
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
            url: "<?= base_url(); ?>/admin/api/kelas/get/" + id,
            type: "GET",
            success: function(c){
                $("#nama_kelas").val(c['data'][0]['nama_kelas']);
                $("#id_kelas").val(c['data'][0]['id_kelas']);
                $(".btn.btn-primary").val("Edit Kelas");
                if ($("#form_tambah").attr("class").includes("d-none") === true){
                    $("#form_tambah").removeClass("d-none");
                    $("#tabel").removeClass("col-md-12");
                    $("#tabel").addClass("col-md-8");
                }
            }
        });
    }
    function save(){
        if ($("#id_kelas").val() != ""){
            var url = "<?= base_url() ?>/admin/api/kelas/edit/" + $("#id_kelas").val();
        }
        else {
            var url = "<?= base_url() ?>/admin/api/kelas/insert";
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: "kelas=" + $("#nama_kelas").val(),
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
                $("#nama_kelas").val("");
                $("#id_kelas").val("");
                $(".btn.btn-primary").val("Add Kelas");
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
                        url: "<?= base_url() ?>/admin/api/kelas/delete/"+ id[i],
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