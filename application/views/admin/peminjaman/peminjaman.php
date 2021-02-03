<div class="container">
    <div class="card shadow">
        <h6 class="card-header font-weight-bold text-primary">Data Peminjaman</h6>
        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>
            <div class="row mb-2 float-right">
                <a href="<?= base_url('laporan/peminjamanPdf'); ?>" class="btn btn-outline-danger mr-1">Export to PDF</a>
                <a href="<?= base_url('laporan/PeminjamanExcel'); ?>" class="btn btn-outline-success mr-1">Export to EXCEL</a>
                <a href="<?= base_url('laporan/peminjamanChart'); ?>" class="btn btn-outline-primary mr-1">Chart</a>
            </div>
            <div class="row mb-2 ml-auto">
                <a href="<?= base_url('peminjaman/addPeminjaman'); ?>" class="btn btn-success">Tambah Transaksi</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Transaksi</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Peminjam</th>
                            <th scope="col">Nama Buku</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($transaksi as $trs) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $trs->id_transaksi; ?></td>
                                <td><?php echo $trs->tanggal_pinjam; ?></td>
                                <td><?php echo $trs->nis; ?></td>
                                <td><?php echo $trs->nama_siswa; ?></td>
                                <td><?php echo $trs->nama_buku; ?></td>
                                <td>
                                    <a href="<?= base_url(); ?>peminjaman/kembali/<?= $trs->id_transaksi; ?>" class="btn btn-warning btn-sm">Kembalikan</a>
                                    <a href="<?= base_url(); ?>peminjaman/delete/<?= $trs->id_transaksi; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>