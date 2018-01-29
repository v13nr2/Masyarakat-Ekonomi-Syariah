<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<label class="label-header"><?=$judul?></label>
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
             <div class='box-header with-border'>
                 <h3 class='box-title'><a href="<?php echo base_url('menu/add'); ?>" class="btn btn-success btn-small">
                  <i class="glyphicon glyphicon-plus"></i> Tambah Menu</a></h3>
                  <label calss='control-label' ></label>
             </div>
				 <div class="box-body">
					 <table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
                  <thead>
                     <th>No.</th>
                     <th>Nama Menu</th>
                     <th>Icon</th>
                     <th>Link</th>
                     <th>Kat. Menu</th>
                     <th>Edit</th>
                     <th>Delete</th>
                  </thead>
						 <tbody>
                      <?php
                      $no=1;
                      function chek($id) {
                           $CI = get_instance();
                           $result = $CI->db->get_where('tbl_menu', array('id_menu' => $id))->row_array();
                           return $result['nama_menu'];
                       }
                      foreach ($record as $r){
                       $katmenu = $r->parent == 0 ? 'Menu Utama' : chek($r->parent);
                          echo"
                              <tr>
                              <td width='3%'>$no</td>
                              <td width='17%'>".$r->nama_menu."</td>
                              <td width='20%'>".$r->icon."</td>
                              <td width='20%' >".$r->link."</td>
                              <td width='20%' >".$katmenu."</td>
                              <td align= 'center' width='5%'>" . anchor('menu/edit/' . $r->id_menu, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                              <td align= 'center' width='5%' >" . anchor('menu/delete/' . $r->id_menu, '<i class="btn-sm btn-danger glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")) . "</td>
                              </tr>";
                          $no++;
                      }
                      ?>
						 </tbody>
					 </table>
				 </div>
			 </div>
		 </div>
	 </div>
 </section>
