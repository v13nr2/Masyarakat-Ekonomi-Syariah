<section class="content-header">
    <div class="row">
        <div class="col-md-3">
            <label class="label-header"><?= $judul ?></label>
        </div>
        <div class="col-md-9">
            <div class="pull-right">
                <a href="<?= base_url('acl/form_group') ?>" class="btn btn-sm btn-success"><img src="<?= base_url('assets/resources/add.png'); ?>" /> Tambah</a>
            </div>
        </div>
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
                    <table width="100%" id="dtcustomt" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Group</th>
                                <th>Deskripsi</th>
                                <th style="width: 80px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($roles as $v) {
                                ?>

                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $v->cizacl_role_name; ?></td>
                                    <td><?php echo $v->cizacl_role_description; ?></td>
                                    <td style="text-align: center;">
                                        <a href="<?php echo base_url() . "acl/form_menu?id=" . md5($v->cizacl_role_id); ?>" title='Ubah Menu' data-toggle='tooltip'><img src='<?php echo base_url() . "assets/resources/edit.png"; ?>' /></a><a onclick="return confirm('Apakah Anda yakin akan menghapus Menu ini?')" href='<?= base_url() . "acl/menu_hapus?id=" . md5($v->cizacl_role_id); ?>' title='Hapus Menu' data-toggle='tooltip'><img src='<?= base_url() . "assets/resources/hapus.png"; ?>' /></a>
                                    </td>
                                </tr>

                                <?php
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
