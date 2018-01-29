<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <label class="label-header"><?=$judul?></label>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-list-alt"></i>
                    <h3 class="box-title">Laporan</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="page-header"><a href="<?=base_url('laporan/jurnal')?>">Jurnal</a></h4>
                            <p>Menampilkan jurnal yang dipergunakan untuk pencatatan segala bukti transaksi keuangan perusahaan pada suatu periode.</p>
                            <a href="<?=base_url('laporan/jurnal')?>" class="btn btn-inverse">Lihat Laporan <i class="fa fa-angle-double-right"></i></a>
                        </div>

                        <div class="col-md-6">
                            <h4 class="page-header"><a href="<?=base_url('laporan/bukubesar')?>">Buku Besar</a></h4>
                            <p>Menampilkan pencatatan transaksi keuangan yang mengkonsolidasikan masukan  dari semua jurnal yang telah diinput.</p>
                            <a href="<?=base_url('laporan/bukubesar')?>" class="btn btn-inverse">Lihat Laporan <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>

                    <br/>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="page-header"><a href="<?=base_url('laporan/labarugi')?>">Laba Rugi</a></h4>
                            <p>Menampilkan laporan keuangan pada periode tertentu yang menjabarkan unsur - unsur pendapatan dan beban.</p>
                            <a href="<?=base_url('laporan/labarugi')?>" class="btn btn-inverse">Lihat Laporan <i class="fa fa-angle-double-right"></i></a>
                        </div>

                        <div class="col-md-6">
                            <h4 class="page-header"><a href="<?=base_url('laporan/neraca')?>">Neraca</a></h4>
                            <p>Laporan dengan posisi keuangan perusahaan yang menggambarkan posisi aktiva, kewajiban dan modal</p>
                            <a href="<?=base_url('laporan/neraca')?>" class="btn btn-inverse">Lihat Laporan <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>