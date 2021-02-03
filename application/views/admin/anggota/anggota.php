<div class="container">
    <div class="card shadow">
        <h6 class="card-header font-weight-bold text-primary">Data Anggota</h6>
        <div class="card-body">
            <div class="panel panel-primary">
                <script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
                <div class="panel-heading">
                    <button data-toggle="modal" data-target="#addModal1" class="btn btn-success float-left my-2">Tambah Data</button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Email</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_data2">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="alert" class="modal fade" data-dismiss="alert">
                <div class="alert alert-success" role="alert">
                    A simple success alert—check it out!
                </div>
            </div>

            <!-- Modal Tambah-->
            <div id="addModal1" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">Tambah Data</h4>
                        </div>
                        <div class="modal-body">
                            <form action="POST">
                                <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input type="text" name="nis" class="form-control"></input>
                                    <small class="nis_error text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" name="nama_siswa" class="form-control"></input>
                                    <small class="nama_siswa_error text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <small class="jenis_kelamin_error text-danger"></small>
                                    <div class="col-sm-10">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" name="jenis_kelamin" class="custom-control-input" value="Laki-Laki">
                                            <label class="custom-control-label" for="customRadioInline1">Laki-Laki</label>

                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" name="jenis_kelamin" class="custom-control-input" value="Perempuan">
                                            <label class="custom-control-label" for="customRadioInline2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control"></input>
                                    <small class="email_error text-danger"></small>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="btn_add_data1">Simpan</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal Edit-->
            <div id="editModal2" class="modal fade" role="dialog">
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
                                    <label for="nis">NIS</label>
                                    <input type="text" name="nis_edit" class="form-control" readonly></input>
                                </div>
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" name="nama_siswa_edit" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="a" name="jenis_kelamin_edit" class="custom-control-input" value="Laki-Laki">
                                            <label class="custom-control-label" for="a">Laki-Laki</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="b" name="jenis_kelamin_edit" class="custom-control-input" value="Perempuan">
                                            <label class="custom-control-label" for="b">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="text" name="email_edit" class="form-control"></input>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="btn_update_data2">Update</button>
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
                url: '<?php echo base_url(); ?>anggota/view',
                type: 'POST',
                dataType: 'json',
                success: function(anggota) {
                    console.log(anggota);
                    var i;
                    var no = 0;
                    var html = "";
                    for (i = 0; i < anggota.length; i++) {
                        no++;
                        html = html + '<tr>' +
                            '<td>' + no + '</td>' +
                            '<td>' + anggota[i].nis + '</td>' +
                            '<td>' + anggota[i].nama_siswa + '</td>' +
                            '<td>' + anggota[i].jenis_kelamin + '</td>' +
                            '<td>' + anggota[i].email + '</td>' +
                            '<td style="width: 16.66%;">' + '<span><button data-id="' + anggota[i].nis + '" class="btn btn-warning btn-sm btn_edit2">Edit</button><button style="margin-left: 5px;" data-id="' + anggota[i].nis + '" class="btn btn-danger btn-sm btn_hapus2">Hapus</button></span>' + '</td>' +
                            '</tr>';

                    }
                    $("#tbl_data2").html(html);
                }

            });
        }

        //Menambahkan Data ke database
        $("#btn_add_data1").on('click', function() {
            var nis = $('input[name="nis"]').val();
            var nama_siswa = $('input[name="nama_siswa"]').val();
            var jenis_kelamin = $('input[name="jenis_kelamin"]:checked').val();
            var email = $('input[name="email"]').val();
            $.ajax({
                url: '<?php echo base_url(); ?>anggota/tambahData',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    nis: nis,
                    nama_siswa: nama_siswa,
                    jenis_kelamin: jenis_kelamin,
                    email: email,
                },
                success: function(data) {
                    if (data == 'sukses') {
                        $('input[name="nis"]').val("");
                        $('input[name="nama_siswa"]').val("");
                        $('input[name="jenis_kelamin"]:checked').val("");
                        $('input[name="email"]').val("");
                        $('#addModal1').modal('hide');
                        tampil_data();
                    } else {
                        $(".nis_error").html(data.nis);
                        $(".nama_siswa_error").html(data.nama_siswa);
                        $(".jenis_kelamin_error").html(data.jenis_kelamin);
                        $(".email_error").html(data.email);
                    }
                }
            })

        });

        //Memunculkan modal edit
        $("#tbl_data2").on('click', '.btn_edit2', function() {
            var nis = $(this).attr('data-id');
            $.ajax({
                url: '<?php echo base_url(); ?>anggota/ambilDataByNis',
                type: 'POST',
                data: {
                    nis: nis
                },
                dataType: 'json',
                success: function(anggota) {
                    $("#editModal2").modal('show');
                    $('input[name="nis_edit"]').val(anggota[0].nis);
                    $('input[name="nama_siswa_edit"]').val(anggota[0].nama_siswa);
                    $('input[name="jenis_kelamin_edit"]:checked').val(anggota[0].jenis_kelamin);
                    $('input[name="email_edit"]').val(anggota[0].email);
                }
            })
        });

        //Meng-Update Data
        $('#btn_update_data2').on('click', function() {
            var nis = $('input[name="nis_edit"]').val();
            var nama_siswa = $('input[name="nama_siswa_edit"]').val();
            var jenis_kelamin = $('input[name="jenis_kelamin_edit"]:checked').val();
            var email = $('input[name="email_edit"]').val();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>anggota/update',
                dataType: "JSON",
                data: {
                    nis: nis,
                    nama_siswa: nama_siswa,
                    jenis_kelamin: jenis_kelamin,
                    email: email,
                },
                success: function(anggota) {
                    $('input[name="nis_edit"]').val();
                    $('input[name="nama_siswa_edit"]').val();
                    $('input[name="jenis_kelamin_edit"]:checked').val();
                    $('input[name="email_edit"]').val();
                    $('#editModal2').modal('hide');
                    tampil_data();
                }
            });
            return false;
        });

        //Hapus Data
        $("#tbl_data2").on('click', '.btn_hapus2', function() {
            var nis = $(this).attr('data-id');
            var status = confirm('Yakin ingin menghapus?');
            if (status) {
                $.ajax({
                    url: '<?php echo base_url(); ?>anggota/hapusData',
                    type: 'POST',
                    data: {
                        nis: nis
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