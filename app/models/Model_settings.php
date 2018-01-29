<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Model_settings extends CI_Model {

    private $table = null;

    function __construct() {
        $this->table = 'settings';
        parent::__construct($this->table);
    }

    function get_setting($setting_name) {
        $result = $this->db->get_where($this->table, array('setting_name' => $setting_name), 1);
        if ($result->num_rows() == 1) {
            return $result->row()->setting_value;
        }
    }

    function save_setting($setting_name, $setting_value) {
        $fields = array(
            'setting_name' => $setting_name,
            'setting_value' => $setting_value
        );

        $exists = $this->get_setting($setting_name);
        if ($exists === NULL) {
            return $this->db->insert($this->table, $fields);
        } else {
            $this->db->where('setting_name', $setting_name);
            $this->db->update($this->table, $fields);
        }
    }
    function getSettingById($id){
        if(!empty($id)){
            $query = "
            SELECT 
            *
            FROM tbl_seting_dokumen
            WHERE organisasi_id='$id'
            ";

            return $this->db->query($query)->result();
        }
    }

    function getOrganisasi($id){
        if(!empty($id)){
            $query = "
            SELECT 
            *
            FROM tbl_organisasi
            WHERE id='$id'
            ";

            return $this->db->query($query)->result();
        }
    }
}
