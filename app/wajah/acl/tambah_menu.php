
<?php
$id = "";
$nama_menu = "";
$parent_menu = "";
$icon = "";
$user_menu_index = "";
$link = "";
$act = "tambah";
if (!empty($menu)) {
    foreach ($menu as $k) {
        $id = $k->id;
        $nama_menu = $k->nama_menu;
        $parent_menu = $k->parent;
        $icon = $k->icon;
        $link = $k->link;
        $user_menu_index = $k->user_menu_index;
        $act = "ubah";
        //echo  $parent_menu;
    }
}
?>
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
                    <form id="s" class="form-horizontal" autocomplete="off" method="post" action="<?= base_url() . 'acl/' . $act; ?>">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Parent Menu</label>
                            <div class="col-lg-4">
                                <?php
                                $opMenu = "class='form-control input-sm select2'";
                                $dtMenu = $this->db->where('status_delete', 0)->get('tbl_menu')->result();
                                $menus = array("" => 'Pilih Data');
                                foreach ($dtMenu as $dmenu) {
                                    $menus[$dmenu->id] = $dmenu->nama_menu;
                                }
                                echo form_dropdown('parent_menu', $menus, $parent_menu, $opMenu);
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Nama Menu</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" data-validetta="required" name="nama_menu" maxlength="50" id="nama_menu" value="<?= $nama_menu; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Link Function</label>
                            <div class="col-lg-4">
                                <?php
//                                $opFunction = "class='form-control input-sm select2'";
//                                $dtFunction = $this->db->get('cizacl_resources')->result();
//                                $functions = array("" => "Pilih Data");
//                                foreach ($dtFunction as $dfunction) {
//                                    if ($dfunction->cizacl_resource_function <> "") {
//                                        $functions[$dfunction->cizacl_resource_id] = $dfunction->cizacl_resource_controller . "/" . $dfunction->cizacl_resource_function;
//                                    } else {
//                                        $functions[$dfunction->cizacl_resource_id] = $dfunction->cizacl_resource_controller;
//                                    }
//                                }
//                                echo form_dropdown('user_function_list_id', $functions, $link, $opFunction);
                                ?>
                                <input type="text" class="form-control" name="link" maxlength="50" id="link" value="<?= $link; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Icon</label>
                            <div class="col-lg-4">
                                <input type="text" name="user_icon" id="user_icon" value="<?php echo $icon; ?>" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Index</label>
                            <div class="col-lg-4">
                                <input type="number" name="user_menu_index" id="user_menu_index" value="<?php echo $user_menu_index; ?>" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4">
                                <button type="submit" value="simpan" name="btnSimpan" class="btn btn-success btn-min"><i class="fa fa-save"></i> Simpan</button>
                                <?= anchor('acl/menu', '<i class="fa fa-angle-left"></i> Kembali', array('class' => 'btn btn-danger btn-min')) ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


