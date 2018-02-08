<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_modul extends CI_Model {

    function getModulById($id) {
        if (!empty($id)) {
            $query = "
			SELECT
			* 
			FROM tbl_modul
			WHERE md5(id)='$id'
			";

            return $this->db->query($query)->result();
        }
    }

    function listModul() {
        $query = "
		SELECT 
		*
		FROM tbl_modul 
		ORDER BY controller ASC
		";

        return $this->db->query($query)->result();
    }

    public function getComboBank() {
        $query = "
		SELECT 
		bank_id as id,
		bank_nama as bank 
		FROM 
		mst_rekening_bank
		ORDER BY 
		bank_nama ASC
		";

        return $this->db->query($query)->result();
    }

    function hapusModul($id) {
        if (!empty($id)) {
            $query = "
			DELETE FROM tbl_modul WHERE md5(id)='$id'
			";

            return $this->db->query($query);
        }
    }

    function check_role($idmenu = 0, $idrole = 0) {
        if ($idrole > 1) {
            $dataMenu = $this->db
                    ->from('tbl_menu a')
                    ->join('tbl_akses_menu b', 'a.id=b.id_menu', 'left')
                    ->where(array('b.id_role' => $idrole, 'b.status_akses' => 'aktif', 'b.id_menu' => $idmenu))
                    ->get()
                    ->num_rows();
            if ($dataMenu > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    function get_parent() {
        //$idrole = $this->session->userdata('user_cizacl_role_id');
        //$pdata = $this->session->userdata('session_data'); //
        //$idrole = $pdata['ses_user_group'];
        $idrole = $this->session->userdata('ses_user_group');

        $hasilMenu = "";

        if ($idrole > 1) {
            // Akses selain Administrator
            $qMenu = $this->db->where(array('parent' => 0))->get('tbl_menu');
            if ($qMenu->num_rows() > 0) {
                foreach ($qMenu->result() as $row) {
                    $query = $this->db->where(array('parent' => $row->id, 'status_delete' => 0))->get('tbl_menu');
                    $treev = "";
                    if ($query->num_rows() > 0) {
                        if ($this->check_role($idrole, $row->id) <> false) {
                            $idChild = array();
                            foreach ($query->result() as $qrow) {
                                array_push($idChild, $qrow->id);
                            }
                            $treev = "class='treeview'";
                            $hasilMenu .= "<li $treev><a href='javascript:void(0)'><i class='$row->icon'></i> <span>$row->nama_menu</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>";
                            $hasilMenu .= $this->get_child($idChild);
                            $hasilMenu .= "</li>";
                        }
                    } else {
                        if ($this->check_role($idrole, $row->id) <> false) {
                            $hasilMenu .= "<li><a href='" . base_url($row->link) . "'><i class='$row->icon'></i> $row->nama_menu</a></li>";
                        }
                    }
                }
            }
        } else {
            // Akses Administrator
            $qMenu = $this->db->where(array('parent' => 0))->get('tbl_menu');
            if ($qMenu->num_rows() > 0) {
                foreach ($qMenu->result() as $row) {
                    $query = $this->db->where(array('parent' => $row->id, 'status_delete' => 0))->get('tbl_menu');
                    $treev = "";
                    if ($query->num_rows() > 0) {
                        $idChild = array();
                        foreach ($query->result() as $qrow) {
                            array_push($idChild, $qrow->id);
                        }
                        $treev = "class='treeview'";
                        $hasilMenu .= "<li $treev><a href='javascript:void(0)'><i class='$row->icon'></i> <span>$row->nama_menu</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>";
                        $hasilMenu .= $this->get_child($idChild);
                        $hasilMenu .= "</li>";
                    } else {
                        $hasilMenu .= "<li><a href='" . base_url($row->link) . "'><i class='$row->icon'></i> $row->nama_menu</a></li>";
                    }
                }
            }
        }

        return $hasilMenu;
    }

    function get_child($idMenu = array()) {
        $idrole = $this->session->userdata('user_cizacl_role_id');

        $data = "<ul class='treeview-menu'>";

        if (count($idMenu) > 0) {

            $query = $this->db->where('status_delete', 0)->where_in('id', $idMenu)->get('tbl_menu');

            if ($query->num_rows() > 0) {

                foreach ($query->result() as $row) {

                    if ($idrole > 1) {
                        if ($this->check_role($idrole, $row->id) <> false) {

                            $queryChild = $this->db->where('status_delete', 0)->where_in('parent', $row->id)->get('tbl_menu');

                            if ($queryChild->num_rows() > 0) {

                                $idChild = array();
                                foreach ($queryChild->result() as $qrow) {
                                    array_push($idChild, $qrow->id);
                                }

                                $treev = "class='treeview'";
                                $data .= "<li $treev><a href='javascript:void(0)'><i class='$row->icon'></i> <span>$row->nama_menu</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>";
                                $data .= $this->get_child($idChild);
                                $data .= "</li>";
                            } else {

                                $data .= "<li><a href='" . base_url($row->link) . "'><i class='$row->icon'></i> $row->nama_menu</a></li>";
                            }
                        }
                    } else {
                        $queryChild = $this->db->where('status_delete', 0)->where_in('parent', $row->id)->get('tbl_menu');

                        if ($queryChild->num_rows() > 0) {

                            $idChild = array();
                            foreach ($queryChild->result() as $qrow) {
                                array_push($idChild, $qrow->id);
                            }

                            $treev = "class='treeview'";
                            $data .= "<li $treev><a href='javascript:void(0)'><i class='$row->icon'></i> <span>$row->nama_menu</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></a>";
                            $data .= $this->get_child($idChild);
                            $data .= "</li>";
                        } else {

                            $data .= "<li><a href='" . base_url($row->link) . "'><i class='$row->icon'></i> $row->nama_menu</a></li>";
                        }
                    }
                }
            }
        }
        $data .= "</ul>";
        return $data;
    }

}

/* End of file Model_bank.php */
/* Location: .//D/xampp/htdocs/FELLOW/akuntansi/app/models/Model_bank.php */