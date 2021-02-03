<div class="container">
    <div class="card shadow">
        <h6 class="card-header font-weight-bold text-primary">Data Pengembalian</h6>
        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>
            <div class="row mb-2 float-right">
                <a href="<?= base_url('laporan/pengembalianPdf'); ?>" class="btn btn-outline-danger mr-1">Export to PDF</a>
                <a href="<?= base_url('laporan/pengembalianExcel'); ?>" class="btn btn-outline-success mr-1">Export to EXCEL</a>
                <a href="<?= base_url('laporan/pengembalianChart'); ?>" class="btn btn-outline-primary mr-1">Chart</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Transaksi</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Tanggal Kembali</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Peminjam</th>
                            <th scope="col">Nama Buku</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pengembalian as $peng) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $peng->id_transaksi; ?></td>
                                <td><?php echo $peng->tanggal_pinjam; ?></td>
                                <td><?php echo $peng->tanggal_kembali; ?></td>
                                <td><?php echo $peng->nis; ?></td>
                                <td><?php echo $peng->nama_siswa; ?></td>
                                <td><?php echo $peng->nama_buku; ?></td>
                                <td>
                                    <a href="<?= base_url(); ?>pengembalian/delete/<?= $peng->id_transaksi; ?>" class="btn btn-danger btn-sm">Hapus</a>
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