<style>
    .selected {
        background-color: #fb0000 !important;
    }
</style>
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
    var table = $("#dataTable").DataTable({
        createdRow: function(row, data, dataIndex) {
            $.ajax({
                url: "<?= base_url() ?>/guru/api/siswa/table/1",
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
        ajax: '<?= base_url() ?>/guru/api/siswa/table',
        responsive: !0,
        destroy: true
    });
</script>