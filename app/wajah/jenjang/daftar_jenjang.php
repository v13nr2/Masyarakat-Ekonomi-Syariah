<section class="content-header">
    <div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				 <a href="<?=base_url()?>jenjang/tambah"  ><img src="<?php echo base_url().'assets/images/icon/add.png';?>" height="50px" title="Tambah Jenjang"></a>
			</div>
		</div>
	</div>
</div>
</section>
<section class="content">

	<div class="row">
		<div class="col-lg-12">
			<?php if($this->session->userdata($this->config->item('ses_message')))
				{
					echo $this->session->userdata($this->config->item('ses_message'));
					$this->session->unset_userdata($this->config->item('ses_message'));
				}
			?>
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-credit-card"></i>
					<h3 class="box-title">Daftar Jenjang Kepengurusan</h3>
				</div>
				<div class="box-body">
					<table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
						<thead>
							<th width="40%">Nama Jenjang</th>
							<th width="50%">Keterangan</th>
							<th width="10%">Opsi</th>
						</thead>
						<tbody>
							<?php foreach ($akun as $b)
							{
								$nama_jenjang = $b->level==0 ? '<b>'.$b->nama_jenjang.'</b>' : $b->nama_jenjang;
								if($b->level==1){
									$sign = '-';
								}else if($b->level==2){
									$sign = '--';	
								}else if($b->level==3){
									$sign = '---';	
								}else if($b->level==4){
									$sign = '----';	
								}else if($b->level==5){
									$sign = '-----';	
								}else if($b->level==6){
									$sign = '------';	
								}else if($b->level==7){
									$sign = '-------';	
								}else{
									$sign = '';
								}
								if($b->aktif=="A")
								{
									echo '<tr>';
								}
								else
								{
									echo '<tr class="danger">';
								}
								
								echo '<td>'.$sign.'-'.$nama_jenjang.'</td>';
								echo '<td>'.$b->keterangan.'</td>';
								echo '<td align="center">'; ?>
								<a href="<?=base_url()?>jenjang/ubah/<?=md5($b->id_jenjang)?>" title="Ubah Jenjang" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/edit.png" /></a>
								<?php if($b->aktif=="A") { ?>
									<a href="<?=base_url()?>jenjang/hapus/<?=md5($b->id_jenjang)?>" title="Hapus Jenjang" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/hapus.png" onclick="return confirm('Anda yakin ingin menghapus jenjang <?=$b->nama_jenjang?> ?')" /></a>
									<?php
								}
								else
								{ ?>
									<a href="<?=base_url()?>jenjang/aktif/<?=md5($b->id_jenjang)?>" title="Aktifkan Jenjang" data-toggle="tooltip"><img src="<?=base_url();?>assets/resources/check.png" onclick="return confirm('Anda yakin ingin mengaktifkan akun <?=$b->nama_jenjang?> ?')" /></a>
									<?php
								} ?>
								<?php echo '</td>'; echo '</tr>';
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
