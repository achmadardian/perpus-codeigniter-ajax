<div class="container">
    <div class="card shadow">
        <h6 class="card-header font-weight-bold text-primary">Laporan Chart Peminjaman</h6>
        <div class="card-body">
            <div class="panel panel-primary">
                <link rel="stylesheet" href="<?= base_url('assets/vendor/morris/morris.css'); ?>">

                <div id="graph"></div>
                <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
                <script src="<?= base_url('assets/vendor/morris/raphael-min.js'); ?>"></script>
                <script src="<?= base_url('assets/vendor/morris/morris.min.js'); ?>"></script>
                <script>
                    Morris.Bar({
                        element: 'graph',
                        data: <?= $data; ?>,
                        xkey: 'nama_buku',
                        ykeys: ['total'],
                        labels: ['Total Pinjam']
                    });
                </script>
            </div>
        </div>
    </div>
</div>
</div>