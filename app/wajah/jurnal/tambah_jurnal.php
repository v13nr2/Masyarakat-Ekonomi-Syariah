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
			$display = "";
			if($mobile==1)
			{
				$display = "hidden";
				echo alert_php2('Peringatan.', 'danger', '<br/>Sangat disarankan menggunakan laptop atau pc untuk menginput jurnal');
			}
			?>
			<form id="exmb" autocomplete="off" method="post" action="<?=base_url('jurnal/tambah')?>">
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
									<input type="text" class="form-control datenan" readonly maxlength="15" name="tgl_jurnal" id="tgl_jurnal" value="<?=$tgl_jurnal?>" onchange="form_input(true)" />
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">No Jurnal</label>
									<input type="text" class="form-control" data-validetta="required" maxlength="40" name="no_jurnal" id="no_jurnal" value="<?=$no_jurnal?>" onchange="form_input(true)" readonly="" />
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label class="control-label">No Bukti</label>
									<input type="text" class="form-control" data-validetta="required" maxlength="40" name="no_bukti" id="no_bukti" value="<?=$no_bukti?>" onchange="form_input(true)" />
								</div>
							</div>
							<div class="col-md-3">
								<label class="control-label">Memo</label>
								<textarea class="form-control" rows="3" data-validetta="required" maxlength="160" onchange="form_input(true)" name="memo" id="memo" style="resize:none;"><?=$memo?></textarea>
								<label class="checkbox-inline">
									<input type="checkbox" name="set_uraian" value="A"><small>Set Deskripsi sebagai Uraian</small></label>
								</div>
							</div>
							<br/>
							<div class="row">
								<div class="col-lg-12">
									<table class="table">
										<tr style="background-color: #cecece;">
											<td width="30%">
												<select class="form-control" data-placeholder="-- pilih akun --" id="input_akun" onchange="form_input(true)"></select>
											</td>
											<td width="30%">
												<input type="text" name="input_uraian" id="input_uraian" class="form-control" placeholder="Keterangan" onchange="form_input(true)"  />
											</td>
											<td width="20%">
												<input type="text" name="input_debet" id="input_debet" class="form-control text-right readwhite" placeholder="Debet" min="0" />
											</td>
											<td width="20%">
												<input type="text" name="input_kredit" id="input_kredit" class="form-control text-right readwhite" placeholder="Kredit" />
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
											<th>No Bukti</th>
											<th>Akun/Rekening</th>
											<th>Uraian</th>
											<th class="text-right">Debet</th>
											<th class="text-right">Kredit</th>
										</tr>
									</table>
								</div>
							</div>
							<br/>
							<div class="row">
								<div class="col-lg-3"></div>
								<div class="col-md-9 form-horizontal" style="padding-right: 30px;">
									<div class="row">
										<div class="col-12">
											<div class="form-group">
												<label class="control-label col-lg-8">Total Debet</label>
												<div class="col-lg-4">
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
														<input type="text" name="total_debet" id="total_debet" class="form-control text-right" readonly="" value="0" />
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-lg-8">Total Kredit</label>
												<div class="col-lg-4">
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
														<input type="text" name="total_kredit" id="total_kredit" class="form-control text-right" readonly="" value="0" />
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-lg-8">Out Balance</label>
												<div class="col-lg-4"> <div class="input-group">
													<span class="input-group-addon">Rp</span>
													<input type="text" name="out_balance" id="out_balance" class="form-control text-right" readonly="" value="0" />
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<legend></legend>
						<div class="row">
							<div class="col-lg-12">
								<div class="pull-right">
									<?=form_button('btnSimpan', '<i class="fa fa-save"></i> Simpan', array('class' => 'btn btn-success btn-min', 'onclick' => 'simpan_jurnal()') )?>
									<?=anchor('jurnal', '<i class="fa fa-angle-left"></i> Kembali', array('class'=>'btn btn-danger btn-min'))?>
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

	var input_akun 	= $("#input_akun").val();
	var input_uraian 	= $("#input_uraian").val();
	var input_debet 	= $("#input_debet").val();
	var input_kredit 	= $("#input_kredit").val();
	var no_bukti 		= $("#no_bukti").val();
	if(no_bukti=="")
	{
		swal({title: "Nomor bukti wajib diisi", text: "", type: "error"});
	}
	else if(input_akun==null)
	{
		swal({
			title: "Lengkapi Data.",
			text: "",
			type: "error"
		});
	}
	else
	{
		if(input_debet=="")
		{
			input_debet=0;
		}
		if(input_kredit=="")
		{
			input_kredit=0;
		}
		var html = '<tr>';
		html += '<td width="10%"><span class="no-bukti">'+ no_bukti +'</span></td>';
		html += '<td width="20%"><select class="form-control" name="akun[]" id="akun' +_rowCount +'" data-placeholder="-- pilih akun --"></select></td>';
		html += '<td width="30%"><input type="text" name="uraian[]" id="uraian' +_rowCount +'" class="form-control" value="'+ input_uraian +'"  /></td>';
		html += '<td width="15%"><input type="text" name="debet[]" onchange="change_debet()" class="form-control text-right readwhite" onfocus="focus_harga(this)" onblur="blur_harga(this)" id="debet' +_rowCount +'" value="'+ input_debet +'" /></td>';
		html += '<td width="15%"><input type="text" name="kredit[]" onchange="change_kredit()" class="form-control text-right readwhite" onfocus="focus_harga(this)" onblur="blur_harga(this)" id="kredit' +_rowCount +'" value="'+ input_kredit +'" /></td>';
		html += '</tr>'; $(html).fadeIn("slow").appendTo(".nanda");

		load_data_dynamic("akun" + _rowCount);
		$('#akun'+_rowCount).select2().select2('val', input_akun);
		document.getElementById('baris').value = _rowCount; _rowCount++;
		document.getElementById("input_uraian").value 	= "";
		document.getElementById("input_debet").value 	= "";
		document.getElementById("input_kredit").value 	= "";
		$("#input_akun").val(null).trigger("change"); change_debet();

		change_kredit();
		$(".no-bukti").html(no_bukti);
	}
}

var change_input = false;

function form_input(status)
{
	change_input = status;
}
function simpan_jurnal()
{if(change_input)
	{
		var r = confirm("Apakah Anda yakin ingin menyimpan jurnal ini?");
		if(r)
		{
			var debet 	= $("#total_debet").val();
			var kredit 	= $("#total_kredit").val();
			if(debet > 0)
			{
				if(parseFloat(debet) != parseFloat(kredit))
				{
					swal({
						title: "Jurnal tidak balance.",
						text: "Nilai total Debet harus sama dengan Kredit.",
						type: "error"
					});
				}
				else
				{
					$("#exmb").submit();
				}
			}
			else
			{
				swal({
					title: "Tidak boleh NOL",
					type: "error"
				});
			}
		}
	}
}

function change_debet()
{
	form_input(true);
	total = 0;
	for (i = 1;
		i < _rowCount; i++)
		{
			total += parseFloat(to_normal($("#debet" + i).val()));
		}
		document.getElementById("total_debet").value = to_decimal(total);
		check_out_balance();
}

function change_kredit()
{
	form_input(true);
	total = 0;
	for (i = 1; i < _rowCount; i++)
	{
		total += parseFloat(to_normal($("#kredit" + i).val()));
	}
	document.getElementById("total_kredit").value = to_decimal(total);
	check_out_balance();
}

function check_out_balance()
{
	var debet = document.getElementById("total_debet").value;
	var kredit = document.getElementById("total_kredit").value;
	var out_balance = parseFloat(to_normal(debet)) - parseFloat(to_normal(kredit));
	document.getElementById("out_balance").value = to_decimal(Math.abs(out_balance));
	document.getElementById('total').value = to_normal(debet);
}

function load_data_dynamic(id)
{
	$.ajax({
		url:"<?=base_url('ajaxdata/get_akun_json'); ?>",
		dataType: "json",
		async: false,
		dataType:"json",
		success: function (data1)
		{
			$('#' + id).append("<option value=''>-- pilih akun --</option>");
			$.each(data1, function(key, value)
			{
				$('#' + id).append($("<option></option>").attr("value", value.id_akun).text(value.kode_akun + " - " + value.nama_akun));
			});
		}
	});
}

function load_data_akun(id_ke)
{
	$("#"+id_ke).select2({
		"language": "id",
		minimumInputLength: 1,
		ajax: {
			url: '<?=base_url('ajaxdata/get_akun_json2')?>',
			dataType: 'json',
			type: 'GET',
			data: function (params)
			{
				return {
					q: params.term
				};
			},

			processResults: function (data)
			{
				return {
					results: data
				};
			},
			cache: true
		}
	});
}
window.onload = function (event) { load_data_akun("input_akun");  }
</script>
