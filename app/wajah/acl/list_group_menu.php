<script>
    path = "<?php echo base_url(); ?>";
    send_data = function (cb, name, aksi) {
        var dt = {cek: cb, sts: aksi}
        //alert(cb + " & " + aksi);
        $.ajax({
            //url: path + "/acl_api/update?cmd=" + aksi + "&id=" + cb + "&val=" + name,
            url: path + "/acl/update_check_akses",
            dataType: "html",
            data: dt,
            type: "POST",
            cache: false
        }).success(function (data) {
            data = JSON.parse(data);
            //alert(data.pesan);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert("fail send data");
        }).always(function () {

        });
    }

    $(document).ready(function () {

        $(".cb").click(function () {
            var cb = $("#" + this.getAttribute("id"));
            var id = this.id;

            //console.log(id);
            //console.log(cb.val());
            //console.log(cb.is(":checked"));
            if (cb.is(":checked")) {
                send_data(id, this.value, "aktif");
            } else {
                send_data(id, this.value, "hapus");
            }
        });

        //checked
//        $.ajax({
//            url: path + "/acl_api/ceked",
//            dataType: "json",
//            data: {'name': 'nanang'},
//            type: "POST",
//            cache: false
//
//        }).success(function (data) {
//            for (var x = 0; x < data.cizacl_resources_ceked.length; x++) {
//                $('#ck_' + data.cizacl_resources_ceked[x]["cizacl_resource_id"] + '_' + data.cizacl_resources_ceked[x]["cizacl_rule_cizacl_role_id"]).attr('checked', true);
//            }
//
//        }).fail(function (jqXHR, textStatus, errorThrown) {
//            alert("fail list checked");
//        }).always(function () {
//
//        });



    });
</script>

<section class="content-header">
    <div class="row">
        <div class="col-md-3">
            <label class="label-header"><?= $judul ?></label>
        </div>
        <div class="col-md-9"></div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <?php
            if ($this->session->userdata($this->config->item('ses_message'))) {
                echo $this->session->userdata($this->config->item('ses_message'));
                $this->session->unset_userdata($this->config->item('ses_message'));
            }
            ?>
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-user"></i>
                    <h3 class="box-title"><?= $judul ?></h3>
                </div>
                <div class="box-body">
                    <table class="table table-condensed table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <th>Group</th>
                        <th>Sifat</th>
                        <th>Menu</th>
<!--                        <th></th>-->
<!--                        <th style="width: 80px; text-align: center;">Aksi</th>-->
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data_group as $b) {
                                echo '<tr><td width="30%"><a href="#demo_' . $b->cizacl_role_id . '"  data-toggle="collapse">' . $b->cizacl_role_name . '</a></td>';
                                echo '<td width="15%">' . $b->cizacl_role_name . '</td>';

                                echo '<td width="15%">';

                                //echo '<td width="15%">';
//                                echo '<td align="center">';
//                                ?>
<!--                            <a href="//<?= base_url() ?>acl/ubah?id=<?= md5($b->cizacl_role_id) ?>" title="Ubah Group" data-toggle="tooltip"><img src="<?= base_url(); ?>assets/resources/edit.png" /></a>

                            <a onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" href="//<?= base_url() ?>acl/hapus?id=<?= md5($b->cizacl_role_id) ?>" title="Hapus Group" data-toggle="tooltip"><img src="<?= base_url(); ?>assets/resources/hapus.png" /></a>-->
                            <?php
//                            echo '</td>';
                            echo '</tr>';

                            echo '<tr id="demo_' . $b->cizacl_role_id . '" class="collapse">';
                            echo '<td width="15%">';
                            echo '<td width="15%">';
                            //echo '<td width="15%">';

                            echo '<td width="35%"><table border=0>';
                            foreach ($data_menu as $c) {
                                $checkMenu = $this->db->where(array('id_role' => $b->cizacl_role_id, 'id_menu' => $c->id, 'status_delete' => 0))->get('tbl_akses_menu')->row();

                                $sChecked = "";
                                if (isset($checkMenu->status_akses)) {
                                    $sChecked = $checkMenu->status_akses == "aktif" ? "checked='true'" : "";
                                }

                                echo '<tr style="height:60px; "><td>';
                                echo '<label><input type="checkbox" onclick="cek();" class="cb" id="ck_' . $c->id . '_' . $b->cizacl_role_id . '"  value="' . $c->id . '#' . $b->cizacl_role_id . '#' . $c->nama_menu . '" ' . $sChecked . '>';
                                echo "&nbsp;" . $c->nama_menu . "</label>";
                                echo "";
                                echo '</td></tr>';
                            }
                            echo "</table>";

//                            echo '</table></td>';
//                            echo '<td width="15%"><table border=0>';
//                            foreach ($cizacl_resources as $d) {
//                                echo '<tr style="height:60px; "><td>';
//                                echo $d->cizacl_resource_description != '' ? $d->cizacl_resource_description : '&nbsp;';
//                                echo '</tr></td>';
//                            }
//                            echo '</table>';
                            echo '</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

