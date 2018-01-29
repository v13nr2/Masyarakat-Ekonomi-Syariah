<section class="content-header">
	<div class="row">
		<div class="col-md-12">
			<label class="label-header"><?=$judul?></label>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<?php
			if($errors!="")
			echo $errors;
			if($this->session->userdata($this->config->item('ses_message')))
			{
				echo $this->session->userdata($this->config->item('ses_message'));
				$this->session->unset_userdata($this->config->item('ses_message'));
			}
			?>
			<form id="exmb" autocomplete="off" method="post" action="<?=base_url('program/tambah')?>">
				<div class="box box-primary">
					<div class="box-header">
						<i class="fa fa-files-o"></i>
						<h3 class="box-title"><?=$judul?></h3>
					</div> <div class="box-body">
						<input type="hidden" name="baris" id="baris" value="1"/>
						<input type="hidden" name="total" id="total" value="0"/>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">Tanggal</label>
									<input type="text" class="form-control datenan" readonly maxlength="15" name="tgl_dibuat" id="tgl_dibuat" value="<?=$tgl_dibuat?>" onchange="form_input(true)" />
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">No Program</label>
									<input type="text" class="form-control" data-validetta="required" maxlength="40" name="no_program" id="no_program" value="<?=$no_program?>" onchange="form_input(true)" readonly="" />
								</div>
							</div>
							<div class="col-md-3">
								<label class="control-label">Keterangan</label>
								<textarea class="form-control" rows="3" data-validetta="required" maxlength="160" onchange="form_input(true)" name="keterangan" id="keterangan" style="resize:none;"><?=$keterangan?></textarea>
								<label class="checkbox-inline">
									<input type="checkbox" name="set_uraian" value="A"><small>Set Deskripsi sebagai keterangan</small></label>
								</div>
							</div>
							<br/>

                     <div class="row">
								<div class="col-lg-12">
									<table class="table">
										<tr style="background-color: #cecece;">
											<td width="20%">
												<input type="text" name="input_tgl_perencaana" id="input_tgl_perencaana" class="form-control datenan" onchange="form_input(true)"  />
											</td>
											<td width="30%">
												<input type="text" name="input_uraian" id="input_uraian" class="form-control " placeholder="Keterangan" onchange="form_input(true)"  />
											</td>
											<td width="30%">
												<input type="text" name="input_budget" id="input_budget" class="form-control text-right readwhite" placeholder="Budget" min="0" />
											</td>
											<td width="20%">
												<input type="text" name="input_total_penerimaan" id="input_total_penerimaan" class="form-control text-right readwhite" placeholder="Toatal Penerimaan" />
											</td>
										</tr>
										<tr>
											<td colspan="4">
													<button type="button" class="btn btn-default btn-sm" onclick="tambah_baris_baru()"><i class="fa fa-plus"></i> Tambah</button>
											</td>
										</tr>
									</table>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<table class="table nanda">
										<tr class="th-warna">
											<th>Tangal Perencanaan</th>
											<th>Uraian</th>
											<th>Budget</th>
                                 <th>Total Penerimaan</th>
										</tr>
									</table>
								</div>
							</div>
							<br/>
						<legend></legend>
						<div class="row">
							<div class="col-lg-12">
								<div class="pull-right">
                           <input type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i>
                       Simpan Transaksi
                   </button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<script type="text/javascript">
var _rowCount = 1;
function tambah_baris_baru()
{

	var input_tgl_perencaana 	= $("#input_tgl_perencaana").val();
	var input_uraian 	= $("#input_uraian").val();
	var input_budget 	= $("#input_budget").val();
	var input_total_penerimaan 	= $("#input_total_penerimaan").val();

	if(input_tgl_perencaana==null)
	{
		swal({
			title: "Lengkapi Data.",
			text: "",
			type: "error"
		});
	}
	else
	{
		if(input_budget=="")
		{
			input_budget=0;
		}
		if(input_total_penerimaan=="")
		{
			input_total_penerimaan=0;
		}
		var html = '<tr>';
		html += '<td width="20%"><input type="text" name="tgl_perencaana[]" id="tgl_perencaana' +_rowCount +'" class="form-control" value="'+ input_tgl_perencaana +'"  /></td>';
		html += '<td width="30%"><input type="text" name="uraian[]" id="uraian' +_rowCount +'" class="form-control" value="'+ input_uraian +'"  /></td>';
		html += '<td width="15%"><input type="text" name="budget[]" id="budget' +_rowCount +'" class="form-control" value="'+ input_budget +'"  /></td>';
		html += '<td width="15%"><input type="text" name="total_penerimaan[]" id="total_penerimaan' +_rowCount +'" class="form-control" value="'+ input_total_penerimaan +'"  /></td>';
		html += '</tr>'; $(html).fadeIn("slow").appendTo(".nanda");

		document.getElementById('baris').value = _rowCount; _rowCount++;
		document.getElementById("input_uraian").value 	= "";
		document.getElementById("input_budget").value 	= "";
		document.getElementById("input_total_penerimaan").value 	= "";
   }
}

var change_input = false;

function form_input(status)
{
	change_input = status;
}

</script>
