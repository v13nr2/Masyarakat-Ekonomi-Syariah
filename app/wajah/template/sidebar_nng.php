<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$menu_a = $this->uri->segment(1); $menu_b = $this->uri->segment(2); $menu_c = $this->uri->segment(3);?>
<script>
  
</script>

<div id="sidebar-menu"	class="main_menu_side hidden-print main_menu">
<div class="menu_section">
<aside class="main-sidebar">
	<section class="sidebar">
		<ul  class="nav side-menu" style="width: 230px; height:500px; overflow: auto">
			<li <?php if($menu_a=="" || $menu_a=="welcome") echo 'class="active"'; ?>><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> <span class="kuncinng">Dashboard</span></a></li>
			<li <?php if($menu_a=="master_data") echo 'class="active"'; ?> class="treeview">
				<a href="#"><i class="fa fa-list"></i> <span>Parameter</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				<ul class="treeview-menu">
				    <li <?php if($menu_a=="master_data") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Kepengurusan</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							
        					<li <?php if($menu_c=="Provinsi") echo 'class="active"'; ?>><a href="<?=base_url('master/Provinsi')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Nama Propinsi</span></a></li>
        					<li <?php if($menu_c=="Kabupaten") echo 'class="active"'; ?>><a href="<?=base_url('master/Kabupaten')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Nama Kab/Kota</span></a></li>
        					
        					<li <?php if($menu_a=="jenjang") echo 'class="active"'; ?>><a href="<?=base_url('jenjang')?>"><i class="fa fa-user"></i> <span class="kunci">Jenjang</span></a></li>
							<li <?php if($menu_a=="kepengurusan") echo 'class="active"'; ?>><a href="<?=base_url('kepengurusan')?>"><i class="fa fa-user"></i> <span class="kunci">Kepengurusan</span></a></li>
						</ul>
					</li>
				    <li <?php if($menu_a=="master_data") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Pengguna</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li <?php if($menu_a=="pengguna") echo 'class="active"'; ?>><a href="<?=base_url('pengguna')?>"><i class="fa fa-user"></i> <span class="kunci">User & Group</span></a></li>
        					<li <?php if($menu_a=="acl/management") echo 'class="active"'; ?>><a href="<?=base_url('acl/management2')?>"><i class="fa fa-user"></i> <span class="kunci">Wewenang</span></a></li>
						</ul>
					</li>
				    <li <?php if($menu_a=="master_data") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Jenis Dana</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li <?php if($menu_a=="kategori_penyedia") echo 'class="active"'; ?>><a href="<?=base_url('kategori_penyedia')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Kategori Penyedia</span></a></li>
							<li <?php if($menu_a=="kategori_dana") echo 'class="active"'; ?>><a href="<?=base_url('kategori_dana')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Kategori Dana</span></a></li>
					        <li <?php if($menu_a=="penyaluran_dana") echo 'class="active"'; ?>><a href="<?=base_url('penyaluran_dana')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Jenis Penyaluran Dana</span></a></li>
						</ul>
					</li>
					
				    <li <?php if($menu_a=="keuangankaryawan") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Pengaturan Menu Pegawai</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							
        					<li <?php if($menu_c=="keuangankaryawan") echo 'class="active"'; ?>><a href="<?=base_url('keuangankaryawan')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Keuangan Pegawai</span></a></li>
						</ul>
					</li>
				    <li <?php if($menu_a=="master_data") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Pengaturan Keuangan</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							
        					<li <?php if($menu_a=="tipeakun") echo 'class="active"'; ?>><a href="<?=base_url('tipeakun')?>"><i class="fa fa-compress"></i> <span class="kunci">Tipe Akun</span></a></li>
        					<li <?php if($menu_a=="akun") echo 'class="active"'; ?>><a href="<?=base_url('akun')?>"><i class="fa fa-credit-card"></i> <span class="kunci">Akun (COA)</span></a></li>
        					<li <?php if($menu_c=="tahunbuku") echo 'class="active"'; ?>><a href="<?=base_url('tahunbuku')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Periode Tahun Buku</span></a></li>
        					<li <?php if($menu_a=="asetconfig" && $menu_b != "asetconfig") echo 'class="active"'; ?>><a href="<?=base_url('asetconfig')?>"><i class="fa fa-files-o"></i> <span class="kunci">Konfigurasi Aset</span></a></li>
        					<li <?php if($menu_a=="aset" && $menu_b != "aset") echo 'class="active"'; ?>><a href="<?=base_url('aset')?>"><i class="fa fa-files-o"></i> <span class="kunci">Aset Tetap</span></a></li>
						</ul>
					</li>
			
					
				    
				
			
			<!-- Menu Organisasi -->
			

				</ul>
			</li>
			<li <?php if($menu_a=="organisasi") echo 'class="active"'; ?> class="treeview">
				<a href="#"><i class="fa fa-list"></i> <span>Data Induk</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				<ul class="treeview-menu">
				<li <?php if($menu_a=="organias") echo 'class="active"'; ?>><a href="<?=base_url('upload/ubah/c4ca4238a0b923820dcc509a6f75849b')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Organisasi	</span></a></li>
			
			    <li <?php if($menu_a=="donatur") echo 'class="active"'; ?>><a href="<?=base_url('donatur')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Penyedia Dana</span></a></li>
				<li <?php if($menu_a=="penyedia") echo 'class="active"'; ?>><a href="<?=base_url('penyedia')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Mitra Kerja</span></a></li>
					
					<li <?php if($menu_a=="pegawai") echo 'class="active"'; ?>><a href="<?=base_url('pegawai')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Pegawai</span></a></li>
					
					
					<li <?php if($menu_a=="penayluran_dana") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Anggaran</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
								<li <?php if($menu_a=="kategori_dana") echo 'class="active"'; ?>><a href="<?=base_url('proyek')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Penerimaan Dana</span></a></li>
						</ul>
					</li>
					<li <?php if($menu_a=="penayluran_dana") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Penyaluran Dana</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li <?php if($menu_a=="kategori_penyedia") echo 'class="active"'; ?>><a href="<?=base_url('program')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Program</span></a></li>
							<li <?php if($menu_a=="kategori_dana") echo 'class="active"'; ?>><a href="<?=base_url('proyek')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Proyek</span></a></li>
						</ul>
					</li>
					<li <?php if($menu_a=="program") echo 'class="active"'; ?>><a href="<?=base_url('bank')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Rekening Bank</span></a></li>
					
				</ul>
			</li>

			<!-- Menu Kasir -->
			<li <?php if($menu_a=="kasir") echo 'class="active"'; ?> class="treeview">
				<a href="#"><i class="fa fa-list"></i> <span>Kasir</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				<ul class="treeview-menu">
				<li <?php if($menu_a=="kas" && $menu_b != "hutang") echo 'class="active"'; ?>><a href="<?=base_url('kas')?>"><i class="fa fa-files-o"></i> <span class="kunci">Kas Masuk</span></a></li>
					<li <?php if($menu_a=="kaskeluar" && $menu_b != "kaskeluar") echo 'class="active"'; ?>><a href="<?=base_url('kaskeluar')?>"><i class="fa fa-files-o"></i> <span class="kunci">Kas Keluar</span></a></li>
					<li <?php if($menu_a=="penayluran_dana") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Cetak Bukti Transaksi</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							
						</ul>
					</li>
					<li <?php if($menu_a=="kaskeluar" && $menu_b != "kaskeluar") echo 'class="active"'; ?>><a href="<?=base_url('kaskeluar')?>"><i class="fa fa-files-o"></i> <span class="kunci">Uang Muka</span></a></li>
					
				    <li <?php if($menu_a=="master_data") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Pengaturan Dokumen</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							
							<li <?php if($menu_a=="settings/kuitansi") echo 'class="active"'; ?>><a href="<?=base_url('settings/kuitansi')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Kuitansi</span></a></li>
							<li <?php if($menu_a=="cetak") echo 'class="active"'; ?>><a href="<?=base_url('settings/margin')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Faktur</span></a></li>
							<li <?php if($menu_a=="cetak") echo 'class="active"'; ?>><a href="<?=base_url('settings/margin')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Invoice</span></a></li>
						</ul>
					</li>
				</ul>
			</li>

			<!-- Administatur -->
			<li <?php if($menu_a=="kasir") echo 'class="active"'; ?> class="treeview">
				<a href="#"><i class="fa fa-list"></i> <span>Administatur</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				<ul class="treeview-menu">
				<li <?php if($menu_a=="kas" && $menu_b != "hutang") echo 'class="active"'; ?>><a href="<?=base_url('kas')?>"><i class="fa fa-files-o"></i> <span class="kunci">Rekonsiliasi Bank</span></a></li>
				
					<li <?php if($menu_a=="penayluran_dana") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Otomasi</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li <?php if($menu_a=="tutupbuku") echo 'class="active"'; ?>><a href="<?=base_url('tutupbuku')?>"><i class="fa fa-recycle"></i> <span class="kunci">End of Month</span></a></li>
							<li <?php if($menu_a=="kategori_dana") echo 'class="active"'; ?>><a href="<?=base_url('kategori_dana')?>"><i class="fa fa-circle-o"></i> <span class="kunci">End of Year</span></a></li>
						</ul>
					</li>
					<li <?php if($menu_a=="kaskeluar" && $menu_b != "kaskeluar") echo 'class="active"'; ?>><a href="<?=base_url('kaskeluar')?>"><i class="fa fa-files-o"></i> <span class="kunci">Export Data</span></a></li>
					<li <?php if($menu_a=="kaskeluar" && $menu_b != "kaskeluar") echo 'class="active"'; ?>><a href="<?=base_url('kaskeluar')?>"><i class="fa fa-files-o"></i> <span class="kunci">Import Data</span></a></li>
					<li <?php if($menu_a=="jurnalbalik") echo 'class="active"'; ?>><a href="<?=base_url('jurnalbalik')?>"><i class="fa fa-recycle"></i> <span class="kunci">Jurnal Pembalik</span></a></li>
					<li <?php if($menu_a=="jurnal" && $menu_b != "konfirmasi") echo 'class="active"'; ?>><a href="<?=base_url('jurnal')?>"><i class="fa fa-files-o"></i> <span class="kunci">Jurnal Umum</span></a></li>
					
					<li <?php if($menu_a=="piutang" && $menu_b != "piutang") echo 'class="active"'; ?>><a href="<?=base_url('piutang')?>"><i class="fa fa-files-o"></i> <span class="kunci">Piutang</span></a></li>
					<li <?php if($menu_a=="hutang" && $menu_b != "hutang") echo 'class="active"'; ?>><a href="<?=base_url('hutang')?>"><i class="fa fa-files-o"></i> <span class="kunci">Hutang</span></a></li>
				
				    <li <?php if($menu_a=="master_data") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Pengaturan Umum</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							
        					<li <?php if($menu_a=="kas" && $menu_b != "hutang") echo 'class="active"'; ?>><a href="<?=base_url('kas')?>"><i class="fa fa-files-o"></i> <span class="kunci">Backup & Restore</span></a></li>
        					<li><a href="resetsistem"><i class="fa fa-circle-o"></i> Reset Sistem </a></li>
						</ul>
					</li>
				
				</ul>
				
			</li>

			<!-- Monitor -->
			<li <?php if($menu_a=="kasir") echo 'class="active"'; ?> class="treeview">
				<a href="#"><i class="fa fa-list"></i> <span>Monitor</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				<ul class="treeview-menu">
				<li <?php if($menu_a=="kas" && $menu_b != "hutang") echo 'class="active"'; ?>><a href="<?=base_url('kas')?>"><i class="fa fa-files-o"></i> <span class="kunci">Rasio Keuangan</span></a></li>
				<li <?php if($menu_a=="kas" && $menu_b != "hutang") echo 'class="active"'; ?>><a href="<?=base_url('kas')?>"><i class="fa fa-files-o"></i> <span class="kunci">Hutang & Piutang </span></a></li>
					<li <?php if($menu_a=="penayluran_dana") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Grafik</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li <?php if($menu_a=="kategori_dana") echo 'class="active"'; ?>><a href="<?=base_url('kategori_dana')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Jumlah & Pertumbuhan</span></a></li>
							<li <?php if($menu_a=="kategori_dana") echo 'class="active"'; ?>><a href="<?=base_url('kategori_dana')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Perbandingan Pendapatan </span></a></li>
							<li <?php if($menu_a=="kategori_dana") echo 'class="active"'; ?>><a href="<?=base_url('kategori_dana')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Perbandingan Pengeluaran</span></a></li>
							<li <?php if($menu_a=="kategori_dana") echo 'class="active"'; ?>><a href="<?=base_url('kategori_dana')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Perbandingan Selisih</span></a></li>
						</ul>
					</li>
					<li <?php if($menu_a=="kaskeluar" && $menu_b != "kaskeluar") echo 'class="active"'; ?>><a href="<?=base_url('kaskeluar')?>"><i class="fa fa-files-o"></i> <span class="kunci">Rekonsiliasi Nasional</span></a></li>
					
				</ul>
			</li>

			<!-- Administatur -->
			<!BankAdministatur -->
			<li <?php if($menu_a=="laporan") echo 'class="active"'; ?> class="treeview">
				<a href="#"><i class="fa fa-list"></i> <span>Laporan</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				<ul class="treeview-menu">
					<li <?php if($menu_a=="penayluran_dana") echo 'class="active"'; ?> class="treeview">
						<a href="#"><i class="fa fa-list"></i> <span>Utama</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li <?php if($menu_a=="kategori_dana") echo 'class="active"'; ?>><a href="<?=base_url('kategori_dana')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Jumlah & Pertumbuhan</span></a></li>
							<li <?php if($menu_a=="kategori_dana") echo 'class="active"'; ?>><a href="<?=base_url('kategori_dana')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Perbandingan Pendapatan </span></a></li>
							<li <?php if($menu_a=="kategori_dana") echo 'class="active"'; ?>><a href="<?=base_url('kategori_dana')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Perbandingan Pengeluaran</span></a></li>
							<li <?php if($menu_a=="kategori_dana") echo 'class="active"'; ?>><a href="<?=base_url('kategori_dana')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Perbandingan Selisih</span></a></li>
						</ul>
					</li>
					<li <?php if($menu_a=="kaskeluar" && $menu_b != "kaskeluar") echo 'class="active"'; ?>><a href="<?=base_url('kaskeluar')?>"><i class="fa fa-circle-o"></i> <span class="kunci">Rekonsiliasi Nasional</span></a></li>
					<li <?php if($menu_a=="jurnal_lap") echo 'class="active"'; ?>><a href="<?=base_url()?>jurnal_lap"><i class="fa fa-circle-o"></i> <span class="kunci">Laporan Jurnal</span></a></li>
					<li <?php if($menu_a=="buku_Besar") echo 'class="active"'; ?>><a href="<?=base_url()?>buku_Besar"><i class="fa fa-circle-o"></i> <span class="kunci">Buku Besar</span></a></li>
					<li <?php if($menu_a=="buku_kas") echo 'class="active"'; ?>><a href="<?=site_url()?>buku_kas"><i class="fa fa-circle-o"></i> <span class="kunci">Buku KAS</span></a></li>
					<li <?php if($menu_a=="buku_bank") echo 'class="active"'; ?>><a href="<?=site_url()?>buku_bank"><i class="fa fa-circle-o"></i> <span class="kunci">Buku Bank</span></a></li>
					<li <?php if($menu_a=="neraca_percobaan") echo 'class="active"'; ?>><a href="<?=base_url()?>neraca_percobaan"><i class="fa fa-circle-o"></i> <span class="kunci">Neraca Percobaan</span></a></li>
						<li <?php if($menu_a=="bukubesar") echo 'class="active"'; ?>><a href="<?=base_url()?>bukubesar"><i class="fa fa-circle-o"></i> <span class="kunci">Neraca Saldo</span></a></li>
					<li <?php if($menu_a=="neraca") echo 'class="active"'; ?>><a href="<?=base_url()?>neraca"><i class="fa fa-circle-o"></i> <span class="kunci">Neraca</span></a></li>
				  
							<li <?php if($menu_a=="kegiatan") echo 'class="active"'; ?>><a href="<?=base_url()?>kegiatan"><i class="fa fa-circle-o"></i> <span class="kunci">Laporan Utama</span></a></li>
				           
				</ul>
			</li>
			
			<li <?php if($menu_a=="database_backup") echo 'class="active"'; ?> class="treeview">

			</li>
		</ul>
	</section>
</aside>
</div>
</div>
<script>
/* $(document).ready(function(){
	$('.menusamping').click(function(){
		loadContent('http://www.syariah.local/asetconfig');
	});
});
function loadContent(x){
		$( "#contentLTE" ).empty();
		$( "#contentLTE" ).load( x );
	} */
</script>