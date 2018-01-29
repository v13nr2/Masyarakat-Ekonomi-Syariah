<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Acl_api extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cizacl_Mdl');
    }

    function ceked() {

        $data['cizacl_resources_ceked'] = $this->cizacl_mdl->cizacl_resources_ceked();
        echo json_encode($data);
    }

    function update() {
        $q = $this->input->get('cmd');
        //$data = $this->model_akun->get_akun_json2($q);
        // resource_id#role_id
        $string = explode("#", $this->input->post('name'));
        $resource_id = $string[0];
        $role_id = $string[1];
        $controller = $string[2];
        $function = $string[3];
        if ($q == "update") {

            $addnew = array(
                'cizacl_rule_cizacl_role_id' => $role_id,
                'cizacl_rule_type' => 'allow',
                'cizacl_rule_cizacl_resource_controller' => '["' . $controller . '"]',
                'cizacl_rule_cizacl_resource_function' => $function != "null" ? '["' . $function . '"]' : '[null]',
                'cizacl_rule_status' => 1,
                'cizacl_rule_description' => 'by sistem'
            );

            if ($this->db->insert('cizacl_rules', $addnew)) {
                die('Update Berhasil');
            } else {
                die('update Gagal');
            }
        }
        if ($q == "hapus") {
            $hapus = $this->Cizacl_Mdl->isRecorded($resource_id, $role_id, $controller, $function);
            if ($hapus) {
                die('Wewenang Telah di lepas.');
            } else {
                die('Wewenang GAGAL di lepas.');
            }
        }
    }

}
