<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class database_backup extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }

  public function index()
  {
     $data['judul'] = 'Database Backup' ;
     $data['errors'] 	= '';
     $this->load->helper('file');
     $data['backups'] = get_filenames('./files/backup/');
     $this->template->view_baru('settings/database_backup', $data);
  }

  public function db_backup()
   {
      $this->load->helper('file');
      $this->load->dbutil();
      $prefs = array('format' => 'zip', 'filename' => 'BD-backup_' . date('Y-m-d_H-i'));

      $backup =& $this->dbutil->backup($prefs);
      if (!write_file('./files/backup/BD-backup_' . date('Y-m-d_H-i') . '.zip', $backup)) {
           $type = 'success';
           $message = 'backup_error';
      } else {
           $type = 'success';
           $message = 'backup_success';
      }
      $activity = array(
           'user' => $this->session->userdata('user_id'),
           'module' => 'settings',
           'module_field_id' => $this->session->userdata('user_id'),
           'value1' => $prefs['filename']
      );
      redirect('database_backup');
   }

   function download_backup($file)
   {
        $this->load->helper('file');

        $this->load->helper('download');
        $data = file_get_contents('./files/backup/' . $file);
        force_download($file, $data);
        redirect('database_backup');
   }

   public function delete_backup($file)
   {
      if (unlink('./files/backup/' . $file)) {
           $type = 'success';
           $message = 'backup_delete_success';
      } else {
           $type = 'error';
           $message = 'backup_error';
      }
      $activity = array(
           'user' => $this->session->userdata('user_id'),
           'module_field_id' => $this->session->userdata('user_id'),
           'value1' => $file
      );
      redirect('database_backup');
   }

   function restore_database()
   {
      if ($_POST) {
           $this->load->helper('file');
           $this->load->helper('unzip');
           $this->load->database();

           $config['upload_path'] = './files/temp/';
           $config['allowed_types'] = '*';
           $config['max_size'] = '9000';
           $config['overwrite'] = TRUE;

           $this->load->library('upload', $config);
           $this->upload->initialize($config);

           if (!$this->upload->do_upload('upload_file')) {
              $error = $this->upload->display_errors('', ' ');
              $type = 'error';
              $message = $error;

              redirect('database_backup');
           } else {
              $data = array('upload_data' => $this->upload->data());
              $backup = "files/temp/" . $data['upload_data']['file_name'];

           }
           if (!unzip($backup, "files/temp/", true, true)) {
              $type = 'error';
              $message = 'backup_restore_error';
           } else {
              $this->load->dbforge();
              $backup = str_replace('.zip', '', $backup);
              $file_content = file_get_contents($backup . ".sql");
              $this->db->query('USE ' . $this->db->database . ';');
              foreach (explode(";\n", $file_content) as $sql) {
                   $sql = trim($sql);
                   if ($sql) {
                       $this->db->query($sql);
                   }
              }
              $type = 'success';
              $message = 'backup_restore_success';

           }
           unlink($backup . ".sql");
           unlink($backup . ".zip");

           $activity = array(
              'user' => $this->session->userdata('user_id'),
              'module_field_id' => $this->session->userdata('user_id'),
              'value1' => $backup
           );
           redirect('database_backup');
      } else {
           $data['title'] = 'restore_database';
           $this->template->view_baru('settings/database_backup', $data);
      }
   }

}
