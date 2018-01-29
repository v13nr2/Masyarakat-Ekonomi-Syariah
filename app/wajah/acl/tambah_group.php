
<section class="content-header">
    <div class="row">
        <div class="col-md-5">
            <label class="label-header"><?= $judul ?></label>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <?php
            if (isset($errors) != "") {
                echo $errors;
            } if (validation_errors() != false) {
                echo alert_php2('', 'validate', validation_errors());
            }
            ?>
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-user"></i>
                    <h3 class="box-title"><?= $judul ?></h3>
                </div>
                <div class="box-body">
                    <form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?= base_url() . 'acl/' . $act ?>">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Parent Group</label>
                            <div class="col-lg-4">
                                <?php
                                $opGroup = "class='form-control input-sm select2'";
                                $dtGroup = $this->db->get('cizacl_roles')->result();
                                $grup = array("" => "Pilih Data");
                                foreach ($dtGroup as $dgroup) {
                                    $grup[$dgroup->cizacl_role_id] = $dgroup->cizacl_role_name;
                                }
                                echo form_dropdown('parent_group', $grup, $parent_group, $opGroup);
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Nama Group</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" data-validetta="required" name="nama_group" maxlength="50" id="nama_group" value="<?= $nama_group; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Deskripsi</label>
                            <div class="col-lg-4">
                                <textarea name="deskripsi_group" id="deskripsi_group" class="form-control input-sm"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4">
                                <button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
                                <?= anchor('acl/group', '<i class="fa fa-angle-left"></i> Kembali', array('class' => 'btn btn-danger btn-min')) ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
