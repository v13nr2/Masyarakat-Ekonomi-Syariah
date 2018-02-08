<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CIzACL
 * 
 * @copyright	Copyright (c) Schizzoweb Web Agency
 * @website		http://www.schizzoweb.com
 * @version		1.4
 * @revision	2016-05-21
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/


class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->lang->load('cizacl',$this->config->item('language'));
		if(!class_exists('Cizacl'))
			show_error($this->lang->line('library_not_loaded'));
		$this->load->library('cizacl');
		$this->load->model('login_mdl');
		$this->load->model('cizacl_mdl');
	}

	function index()
	{
		$this->load->view('cizacl/login');
	}

	function check_login()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', $this->lang->line('username'), 'required');
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'required');
		
		if ($this->form_validation->run() == false)	{
			die($this->cizacl->json_msg('error',$this->lang->line('attention'),validation_errors("<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>","</p>"),true));
		}
		else	{
			$this->load->model('login_mdl');
			$check_user_login = $this->login_mdl->check_user_login($this->input->post('username',true),$this->input->post('password',true));

			if($check_user_login)	{
				if($this->login_mdl->check_user_disabled($this->input->post('username',true),$this->input->post('password',true)))
					die($this->cizacl->json_msg('error',$this->lang->line('attention'),$this->lang->line('user_disabled'),true));
				elseif($this->login_mdl->check_user_block($this->input->post('username',true),$this->input->post('password',true)))	{
					die($this->cizacl->json_msg('error',$this->lang->line('attention'),$this->lang->line('user_block'),true));
				}
				else	{
					$this->db->from('mst_pengguna');
					//$this->db->from('users');
					$this->db->from('user_profiles');
					$this->db->from('cizacl_roles');
					$this->db->where('email',$this->input->post('username',true));
					$this->db->where('katasandi',md5($this->input->post('password',true)));
					//$this->db->where('user_id = user_profile_user_id');
					$this->db->where('id_pengguna = user_profile_pengguna_id');
					//$this->db->where('user_cizacl_role_id = cizacl_role_id');
					$this->db->where('user_cizacl_role_id_pg = cizacl_role_id');
					$query = $this->db->get();
					//echo $this->db->last_query();
					//die();
					$row = $query->row();
			
					// First access
					$user_lastaccess = !empty($row->user_profile_lastaccess) ? $this->cizacl_mdl->mktime_format($row->user_profile_lastaccess) : '-';
			
					$session = array(
						'user_id'				=> $row->id_pengguna,
						'user_name'				=> $row->nama,
						'user_surname'			=> $row->panggilan,
						'user_lastaccess'		=> $row->terakhir,
						'user_cizacl_role_id'	=> $row->user_cizacl_role_id_pg
					);
					
					$this->db->update('user_profiles', array('user_profile_lastaccess ' => time()), 'user_profile_user_id = '.$row->id_pengguna);
					
					$this->session->set_userdata($session);
					
					$this->session->set_userdata($this->config->item('ses_id'), $row->id_pengguna);
					
					
					//organisasi			
					$this->db->select('periode_tahun_buku');
					$this->db->where('id =',$row->id_organisasi);
					$this->db->from('tbl_organisasi');
					$data = $this->db->get();
					$organisasi = $data->row_array();


					//kueri tahun aktif			
					$this->db->select('awal, akhir');
					$this->db->where('status =','A');
					$this->db->from('trs_tutup_buku_bulanan');
					$data = $this->db->get();
					$tahunbuku = $data->row_array();
					
					$pdata = array(
							'ses_organisasi_id2'  =>  $row->id_organisasi,
							'ses_nama'		=> $row->nama,
							'awal_periode'  =>  $tahunbuku["awal"],
							'akhir_periode'  =>  $tahunbuku["akhir"],
							'ses_tahun_buku'  =>  $organisasi["periode_tahun_buku"],
							'ses_user_id'  =>  $row->id_pengguna
						   );  // pass ur data in the array

					$this->session->set_userdata('session_data', $pdata); //Sets the session
					helper_log("login", "User Login");
					
					
					die($this->cizacl->json_msg('success',$this->lang->line('wait'),$this->lang->line('login_progress'),false,site_url($row->cizacl_role_redirect)));
				}
			}
			else
				die($this->cizacl->json_msg('error',$this->lang->line('attention'),$this->lang->line('user_not_found')));

		}
	}
	
	function logout()
	{
	    
		helper_log("logout", "User Logout");
		$this->session->sess_destroy();
		redirect();
	}
	
}
