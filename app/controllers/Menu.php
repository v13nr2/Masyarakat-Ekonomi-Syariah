<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');

    }

    function index() {
      $data['judul'] 		= "Daftar Menu";
      $data['record']=  $this->db->get('tbl_menu')->result();
      $this->template->view_baru('menu/daftar_menu', $data);
   }

    function add() {
      $data['judul'] 		= 'Tambah Menu';
      $data['errors'] 	= '';
        if(isset($_POST['submit'])) {
            $data   =   array(  'nama_menu' =>  $_POST['nama'],
                                'link'      =>  $_POST['link'],
                                'icon'      =>  $_POST['icon'],
                                'parent'  =>  $_POST['kat_menu']);
            $this->db->insert('tbl_menu',$data);
            $message = alert_php2('Proses berhasil. ', 'success', 'Menu berhasil Ditamabh');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
            redirect('menu');
        }
        else {
            $data['record']=$this->db->get_where('tbl_menu', array('parent' =>0))->result();
            $this->template->view_baru('menu/tambah_menu', $data);
        }
    }
    function edit()
    {
      $data['judul'] 		= 'Edit Menu';
      $data['errors'] 	= '';
        if(isset($_POST['submit']))
        {
            $data   =   array(  'nama_menu' =>  $_POST['nama'],
                                'link'      =>  $_POST['link'],
                                'icon'      =>  $_POST['icon'],
                                'parent'  =>  $_POST['kat_menu']);

            $this->db->where('id_menu',$_POST['id']);
            $this->db->update('tbl_menu',$data);
            $message = alert_php2('Proses berhasil. ', 'success', 'Menu berhasil DiEdit');
				$this->session->set_userdata($this->config->item('ses_message'), $message);
            redirect('menu');
        }
        else {
            $id= $this->uri->segment(3);
            $data['record']=  $this->db->get_where('tbl_menu',array('id_menu'=> $id))->row_array();
            $data['katmenu']=$this->db->get_where('tbl_menu', array('parent' =>0))->result();
            $this->template->view_baru('menu/edit_menu', $data);
        }
    }


    function delete($id){
        $this->db->where('id_menu',$id);
        $this->db->delete('tbl_menu');
        redirect('menu');
    }
}
