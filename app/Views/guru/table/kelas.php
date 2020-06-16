<style>
    .selected {
        background-color: #fb0000 !important;
    }
</style>
<div class="row">
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
                url: "<?= base_url() ?>/guru/api/kelas/table/1",
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
        ajax: '<?= base_url()?>/guru/api/kelas/table',
        responsive:!0,
        destroy: true
    });
</script>