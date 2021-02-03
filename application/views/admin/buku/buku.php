<div class="container">
    <div class="card shadow">
        <h6 class="card-header font-weight-bold text-primary">Data Buku</h6>
        <div class="card-body">
            <div class="panel panel-primary">
                <script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
                <div class="panel-heading">
                    <button data-toggle="modal" data-target="#addModal2" class=" btn btn-success float-left my-2">Tambah Data</button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Buku</th>
                                    <th>Nama Buku</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah-->
            <div id="addModal2" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">Tambah Data</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="id">ID Buku</label>
                                    <input type="text" name="id" class="form-control"></input>
                                    <small class="id_error text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="nama_buku">Nama Buku</label>
                                    <input type="text" name="nama_buku" class="form-control"></input>
                                    <small class="nama_buku_error text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="pengarang">Pengarang</label>
                                    <input type="text" name="pengarang" class="form-control"></input>
                                    <small class="pengarang_error text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="penerbit">Penerbit</label>
                                    <input type="text" name="penerbit" class="form-control"></input>
                                    <small class="penerbit_error text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_terbit">Tahun Terbit</label>
                                    <input type="text" name="tahun_terbit" class="form-control"></input>
                                    <small class="tahun_terbit_error text-danger"></small>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="btn_add_data">Simpan</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal Edit-->
            <div id="editModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">Edit Data</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="id">ID Buku</label>
                                    <input type="text" name="id_edit" class="form-control" readonly></input>
                                </div>
                                <div class="form-group">
                                    <label for="nama_buku">Nama Buku</label>
                                    <input type="text" name="nama_buku_edit" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label for="pengarang">Pengarang</label>
                                    <input type="text" name="pengarang_edit" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label for="penerbit">Penerbit</label>
                                    <input type="text" name="penerbit_edit" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_terbit">Tahun Terbit</label>
                                    <input type="text" name="tahun_terbit_edit" class="form-control"></input>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="btn_update_data">Update</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        tampil_data();
        //Menampilkan Data di tabel
        function tampil_data() {
            $.ajax({
                url: '<?php echo base_url(); ?>Buku/ambilData',
                type: 'POST',
                dataType: 'json',
                success: function(buku) {
                    console.log(buku);
                    var i;
                    var no = 0;
                    var html = "";
                    for (i = 0; i < buku.length; i++) {
                        no++;
                        html = html + '<tr>' +
                            '<td>' + no + '</td>' +
                            '<td>' + buku[i].id + '</td>' +
                            '<td>' + buku[i].nama_buku + '</td>' +
                            '<td>' + buku[i].pengarang + '</td>' +
                            '<td>' + buku[i].penerbit + '</td>' +
                            '<td>' + buku[i].tahun_terbit + '</td>' +
                            '<td style="width: 16.66%;">' + '<span><button data-id="' + buku[i].id + '" class="btn btn-warning btn-sm btn_edit">Edit</button><button style="margin-left: 5px;" data-id="' + buku[i].id + '" class="btn btn-danger btn-sm btn_hapus">Hapus</button></span>' + '</td>' +
                            '</tr>';

                    }
                    $("#tbl_data").html(html);
                }

            });
        }

        //Menambahkan Data ke database
        $("#btn_add_data").on('click', function() {
            var id = $('input[name="id"]').val();
            var nama_buku = $('input[name="nama_buku"]').val();
            var pengarang = $('input[name="pengarang"]').val();
            var penerbit = $('input[name="penerbit"]').val();
            var tahun_terbit = $('input[name="tahun_terbit"]').val();
            $.ajax({
                url: '<?php echo base_url(); ?>buku/tambahData',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    nama_buku: nama_buku,
                    pengarang: pengarang,
                    penerbit: penerbit,
                    tahun_terbit: tahun_terbit,
                },
                success: function(data) {
                    if (data == 'sukses') {
                        $('input[name="id"]').val("");
                        $('input[name="nama_buku"]').val("");
                        $('input[name="pengarang"]').val("");
                        $('input[name="penerbit"]').val("");
                        $('input[name="tahun_terbit"]').val("");
                        $("#addModal2").modal('hide');
                        tampil_data();

                    } else {
                        $(".id_error").html(data.id);
                        $(".nama_buku_error").html(data.nama_buku);
                        $(".pengarang_error").html(data.pengarang);
                        $(".penerbit_error").html(data.penerbit);
                        $(".tahun_terbit_error").html(data.tahun_terbit);
                    }
                }
            })

        });

        //Memunculkan modal edit
        $("#tbl_data").on('click', '.btn_edit', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '<?php echo base_url(); ?>Buku/ambilDataById',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(buku) {
                    $("#editModal").modal('show');
                    $('input[name="id_edit"]').val(buku[0].id);
                    $('input[name="nama_buku_edit"]').val(buku[0].nama_buku);
                    $('input[name="pengarang_edit"]').val(buku[0].pengarang);
                    $('input[name="penerbit_edit"]').val(buku[0].penerbit);
                    $('input[name="tahun_terbit_edit"]').val(buku[0].tahun_terbit);
                }
            })
        });

        //Meng-Update Data
        $('#btn_update_data').on('click', function() {
            var id = $('input[name="id_edit"]').val();
            var nama_buku = $('input[name="nama_buku_edit"]').val();
            var pengarang = $('input[name="pengarang_edit"]').val();
            var penerbit = $('input[name="penerbit_edit"]').val();
            var tahun_terbit = $('input[name="tahun_terbit_edit"]').val();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>Buku/update',
                dataType: "JSON",
                data: {
                    id: id,
                    nama_buku: nama_buku,
                    pengarang: pengarang,
                    penerbit: penerbit,
                    tahun_terbit: tahun_terbit,
                },
                success: function(buku) {
                    $('input[name="id_edit"]').val();
                    $('input[name="nama_buku_edit"]').val();
                    $('input[name="pengarang_edit"]').val();
                    $('input[name="penerbit_edit"]').val();
                    $('input[name="tahun_terbit_edit"]').val();
                    $('#editModal').modal('hide');
                    tampil_data();
                }
            });
            return false;
        });

        //Hapus Data
        $("#tbl_data").on('click', '.btn_hapus', function() {
            var id = $(this).attr('data-id');
            var status = confirm('Yakin ingin menghapus?');
            if (status) {
                $.ajax({
                    url: '<?php echo base_url(); ?>Buku/hapusData',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function() {
                        tampil_data();
                    }
                })
            }
        })

    });
</script>
</div>