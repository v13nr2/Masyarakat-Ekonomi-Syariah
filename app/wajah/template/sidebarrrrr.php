
<script>

    var base_url = "<?= base_url(); ?>";
    $(document).ready(function () {
        // Autocomplete Typeahead
        var dataMenu = $.ajax({type: "GET", url: base_url + "acl/search_menu", async: false}).responseText;

        var $input = $(".typeaheadMenu");
        $input.typeahead({
            source: JSON.parse(dataMenu),
            displayText: function (item) {
                return item.name
            },
            updater: function (item) {
                /* navigate to the selected item */
                window.location.href = base_url + item.url;
            }
        });
    })

</script>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$ci = & get_instance();

$menu_a = $this->uri->segment(1);
$menu_b = $this->uri->segment(2);
$menu_c = $this->uri->segment(3);
?>
<script>

</script>

<div id="sidebar-menu"	class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <aside class="main-sidebar">
            <section class="sidebar">
                <input type="text" id="searchMenu" class="form-control typeaheadMenu" placeholder="Search..." data-provide="typeahead" autocomplete="off">

                <ul  class="nav side-menu" style="width: 230px; height:500px; overflow: auto">

                    <li><a href='http://localhost/akuntansi_simple/'><i class='fa fa-dashboard'></i> Dashboard</a></li><li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Parameter</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>
                        <ul class='treeview-menu'>
                            <li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Kepengurusan</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>
                                <ul class='treeview-menu'>
                                    <li><a href='http://localhost/akuntansi_simple/master/provinsi'><i class='fa fa-circle-o'></i> Nama Provinsi</a></li>
                                    <li><a href='http://localhost/akuntansi_simple/master/Kabupaten'><i class='fa fa-circle-o'></i> Nama Kab/Kota</a></li>
                                    <li><a href='http://localhost/akuntansi_simple/jenjang'><i class='fa fa-user'></i> Jenjang</a></li>
                                    <li><a href='http://localhost/akuntansi_simple/kepengurusan'><i class='fa fa-user'></i> Kepengurusan</a></li>
                                </ul>
                            </li>
                            <li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Pengguna</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>
                                <ul class='treeview-menu'><li><a href='http://localhost/akuntansi_simple/pengguna'><i class='fa fa-user'></i> User & Group</a></li>
                                    <li><a href='http://localhost/akuntansi_simple/acl/management2'><i class='fa fa-user'></i> Wewenang</a></li></ul></li>
                            <li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Jenis Dana</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>
                                <ul class='treeview-menu'>
                                    <li><a href='http://localhost/akuntansi_simple/kategori_penyedia'><i class='fa fa-circle-o'></i> Kategori Penyedia</a></li>
                                    <li><a href='http://localhost/akuntansi_simple/penyaluran_dana'><i class='fa fa-circle-o'></i> Jenis penyaluran dana</a></li>
                                </ul>
                            </li>
                            <li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Pengaturan Menu Pegawai</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>
                                <ul class='treeview-menu'>
                                    <li><a href='http://localhost/akuntansi_simple/keuangankaryawan'><i class='fa fa-circle-o'></i> Keuangan Pegawai</a></li>
                                </ul>
                            </li>
                            <li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Pengaturan Keuangan</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a><ul class='treeview-menu'>
                                    <li><a href='http://localhost/akuntansi_simple/tipeakun'><i class='fa fa-compress'></i> Tipe Akun</a></li>
                                    <li><a href='http://localhost/akuntansi_simple/akun'><i class='fa fa-credit-card'></i> Akun (COA)</a></li>
                                    <li><a href='http://localhost/akuntansi_simple/tutupbuku'><i class='fa fa-circle-o'></i> Periode Tahun Buku</a></li>
                                    <li><a href='http://localhost/akuntansi_simple/asetconfig'><i class='fa fa-files-o'></i> Konfigurasi Aset</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href='http://localhost/akuntansi_simple/kategori_dana'><i class='fa fa-circle-o'></i> Kategori Dana</a></li>
                    <li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Data Induk</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>
                        <ul class='treeview-menu'>
                            <li><a href='http://localhost/akuntansi_simple/'><i class='fa fa-circle-o'></i> Kepengurusan</a></li>
                            <li><a href='http://localhost/akuntansi_simple/donator'><i class='fa fa-circle-o'></i> Penyedia Dana</a></li>
                            <li><a href='http://localhost/akuntansi_simple/penyedia'><i class='fa fa-circle-o'></i> Mitra Kerja</a></li>
                            <li><a href='http://localhost/akuntansi_simple/pegawai'><i class='fa fa-circle-o'></i> Pegawai</a></li>
                            <li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Anggaran</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>
                                <ul class='treeview-menu'>
                                    <li><a href='http://localhost/akuntansi_simple/penerimaan_dana'><i class='fa fa-circle-o'></i> penerimaan Dana</a></li>
                                    <li><a href='http://localhost/akuntansi_simple/penyaluran_dana'><i class='fa fa-circle-o'></i> Penyaluran Dana</a></li>
                                </ul>
                            </li>
                            <li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Penyaluran Dana</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a><ul class='treeview-menu'>
                                    <li><a href='http://localhost/akuntansi_simple/program'><i class='fa fa-circle-o'></i> Program</a></li>
                                    <li><a href='http://localhost/akuntansi_simple/proyek'><i class='fa fa-circle-o'></i> Proyek</a></li>
                                </ul>
                            </li>
                            <li><a href='http://localhost/akuntansi_simple/bank'><i class='fa fa-circle-o'></i> Rekening Bank</a></li>
                            <li><a href='http://localhost/akuntansi_simple/asset'><i class='fa fa-files-o'></i> Aset Tetap</a></li>
                        </ul>
                    </li>
                    <li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Kasir</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>
                        <ul class='treeview-menu'>
                            <li><a href='http://localhost/akuntansi_simple/kas'><i class='fa fa-files-o'></i> Kas Masuk</a></li>
                            <li><a href='http://localhost/akuntansi_simple/kaskeluar'><i class='fa fa-files-o'></i> Kas keluar</a></li>
                            <li><a href='http://localhost/akuntansi_simple/'><i class='fa fa-list'></i> Cetak Bukti Transaksi</a></li>
                            <li><a href='http://localhost/akuntansi_simple/'><i class='fa fa-files-o'></i> Uang Muka</a></li>
                            <li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Pengaturan Dokumen</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a><ul class='treeview-menu'>
                                    <li><a href='http://localhost/akuntansi_simple/kuitansi'><i class='fa fa-circle-o'></i> Kuitansi</a></li>
                                    <li><a href='http://localhost/akuntansi_simple/settings/margin'><i class='fa fa-circle-o'></i> Faktur</a></li>
                                    <li><a href='http://localhost/akuntansi_simple/settings/margin'><i class='fa fa-circle-o'></i> Invoice</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href='http://localhost/akuntansi_simple/buku_Besar'><i class='fa fa-circle-o'></i> Buku Besar</a></li>
                    <li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Administatur</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>
                        <ul class='treeview-menu'>
                            <li><a href='http://localhost/akuntansi_simple/kas'><i class='fa fa-files-o'></i> Rekonsiliasi Bank</a></li>
                            <li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Otomasi</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a><ul class='treeview-menu'><li><a href='http://localhost/akuntansi_simple/tutupbuku'><i class='fa fa-recycle'></i> End Of Month</a></li><li><a href='http://localhost/akuntansi_simple/kategori_dana'><i class='fa fa-circle-o'></i> End of Year</a></li></ul></li><li><a href='http://localhost/akuntansi_simple/'><i class='fa fa-files-o'></i> Export Data</a></li><li><a href='http://localhost/akuntansi_simple/'><i class='fa fa-files-o'></i> Import Data</a></li><li><a href='http://localhost/akuntansi_simple/jurnalbalik'><i class='fa fa-recycle'></i>  Jurnal Pemabalik</a></li><li><a href='http://localhost/akuntansi_simple/piutang'><i class='fa fa-files-o'></i> Piutang</a></li><li><a href='http://localhost/akuntansi_simple/hutang'><i class='fa fa-files-o'></i> Hutang</a></li><li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Pengaturan Umum</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a><ul class='treeview-menu'><li><a href='http://localhost/akuntansi_simple/kas'><i class='fa fa-files-o'></i> Backup & Restore</a></li><li><a href='http://localhost/akuntansi_simple/resetsistem'><i class='fa fa-circle-o'></i> Reset Sistem</a></li></ul></li></ul></li><li><a href='http://localhost/akuntansi_simple/'><i class='fa fa-files-o'></i> Jurnal Umum</a></li><li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Monitor</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a><ul class='treeview-menu'><li><a href='http://localhost/akuntansi_simple/kas'><i class='fa fa-files-o'></i> Rasio Keungan</a></li><li><a href='http://localhost/akuntansi_simple/kas'><i class='fa fa-files-o'></i> Hutang & piutang</a></li><li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Grafik</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a><ul class='treeview-menu'><li><a href='http://localhost/akuntansi_simple/kategori_dana'><i class='fa fa-circle-o'></i> Jumlah & Pertumbuhan</a></li><li><a href='http://localhost/akuntansi_simple/kategori_dana'><i class='fa fa-circle-o'></i> Perbandingan Pendapatan</a></li><li><a href='http://localhost/akuntansi_simple/kategori_dana'><i class='fa fa-circle-o'></i> Perbandingan Pengeluaran</a></li><li><a href='http://localhost/akuntansi_simple/kategori_dana'><i class='fa fa-circle-o'></i> Perbandingan Selisih</a></li></ul></li><li><a href='http://localhost/akuntansi_simple/kaskeluar'><i class='fa fa-files-o'></i> Rekonsliasi Nasional</a></li></ul></li><li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Laporan</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a><ul class='treeview-menu'><li class='treeview'><a href='javascript:void(0)'><i class='fa fa-list'></i> <span>Utama</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a><ul class='treeview-menu'><li><a href='http://localhost/akuntansi_simple/kategori_dana'><i class='fa fa-circle-o'></i> Jumlah & Pertumbuhan</a></li><li><a href='http://localhost/akuntansi_simple/kategori_dana'><i class='fa fa-circle-o'></i> Perbandingan pendapatan</a></li><li><a href='http://localhost/akuntansi_simple/kategori_dana'><i class='fa fa-circle-o'></i> Perbandingan Pengeluaran</a></li><li><a href='http://localhost/akuntansi_simple/kategori_dana'><i class='fa fa-circle-o'></i> Perbandingan Selisih</a></li></ul></li><li><a href='http://localhost/akuntansi_simple/kaskeluar'><i class='fa fa-circle-o'></i> Rekonsiliasi Nasional</a></li><li><a href='http://localhost/akuntansi_simple/fa fa-circle-o'><i class='jurnal_lap'></i> Laporan Jurnal</a></li><li><a href='http://localhost/akuntansi_simple/buku_kas'><i class='fa fa-circle-o'></i> Buku Kas</a></li><li><a href='http://localhost/akuntansi_simple/buku_bank'><i class='fa fa-circle-o'></i> Buku Bank</a></li><li><a href='http://localhost/akuntansi_simple/neraca_percobaan'><i class='fa fa-circle-o'></i> Neraca Percobaan</a></li><li><a href='http://localhost/akuntansi_simple/buku besar'><i class='fa fa-circle-o'></i> Neraca Saldo</a></li><li><a href='http://localhost/akuntansi_simple/neraca'><i class='fa fa-circle-o'></i> Neraca</a></li><li><a href='http://localhost/akuntansi_simple/kegiatan'><i class='fa fa-circle-o'></i> Laporan Utama</a></li></ul></li>

                </ul>
            </section>
        </aside>
    </div>
</div>


