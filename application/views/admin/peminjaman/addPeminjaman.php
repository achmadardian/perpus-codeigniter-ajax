<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h6 class="card-header font-weight-bold text-primary">Peminjaman</h6>
            <div class="card-body">
                <div class="row mb-3 ml-auto">
                    <a href="<?= base_url('peminjaman'); ?>" class="btn btn-primary">Kembali</a>
                </div>
                <form class="user" method="POST" action="<?= base_url('peminjaman/insert') ?>">
                    <div class="form-group">
                        <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS...">
                            <?= form_error('nis', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id" class="col-sm-2 col-form-label">Nama Buku</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="id" id="id">
                                <?php foreach ($buku as $row) : ?>
                                    <option value="<?php echo $row->id; ?>"><?php echo $row->nama_buku; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>