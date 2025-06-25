<!-- PAGE CONTENT-->
<div class="page-content--bgf7">
    <!-- DATA TABLE-->
    <section class="p-t-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-data__tool">
                        <h3 class="title-5 m-b-35">laporan data kas</h3>
                        <div class="table-data__tool-right">
                            <a href="<?= base_url(); ?>kasrt/lapkas" class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="top">
                                <i class="zmdi zmdi-print"></i>print</a>
                            </div>
                    </div>

                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>nomor</th>
                                    <th>tanggal</th>
                                    <th>keterangan</th>
                                    <th>debit</th>
                                    <th>kredit</th>
                                    <th>saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kas as $row): ?>
                                    <tr>
                                        <td><?= $row->idKas; ?></td>
                                        <td><?= date('d-m-Y', strtotime($row->tanggal)); ?></td>
                                        <td><?= $row->keterangan; ?></td>

                                        <!-- Debit -->
                                        <td class="text-success">
                                            <?php if ($row->jenis === 'masuk'): ?>
                                                + Rp <?= rupiah($row->jumlah); ?>
                                            <?php else: ?>
                                                –
                                            <?php endif; ?>
                                        </td>

                                        <!-- Kredit -->
                                        <td class="text-danger">
                                            <?php if ($row->jenis === 'keluar'): ?>
                                                − Rp <?= rupiah($row->jumlah); ?>
                                            <?php else: ?>
                                                –
                                            <?php endif; ?>
                                        </td>

                                        <!-- Saldo per baris -->
                                        <td>
                                            <?= ($row->jenis === 'masuk' ? '+' : '−') . ' Rp ' . rupiah($row->jumlah); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                            <!-- Total Pemasukan, Pengeluaran, dan Saldo -->
                            <thead>
                                <?php
                                $sum_masuk = 0;
                                foreach ($masuk as $total_masuk) {
                                    $sum_masuk += $total_masuk->total;
                                }

                                $sum_keluar = 0;
                                foreach ($keluar as $total_keluar) {
                                    $sum_keluar += $total_keluar->total;
                                }

                                $saldo = $sum_masuk - $sum_keluar;
                                ?>
                                <tr>
                                    <th colspan="4" scope="col">TOTAL PEMASUKAN</th>
                                    <th colspan="2" scope="col" class="text-success">+ Rp <?= rupiah($sum_masuk); ?></th>
                                </tr>
                                <tr>
                                    <th colspan="4" scope="col">TOTAL PENGELUARAN</th>
                                    <th colspan="2" scope="col" class="text-danger">− Rp <?= rupiah($sum_keluar); ?></th>
                                </tr>
                                <tr>
                                    <th colspan="4" scope="col">TOTAL <small>(Saldo)</small></th>
                                    <th colspan="2" scope="col">
                                        <?= ($saldo >= 0 ? '+' : '−') . ' Rp ' . rupiah(abs($saldo)); ?>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->
</div>