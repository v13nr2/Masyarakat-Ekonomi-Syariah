<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
 * */
class Acl extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load('cizacl', $this->config->item('language'));
        if (!class_exists('Cizacl'))
            show_error($this->lang->line('library_not_loaded'));
        $this->load->model('cizacl_mdl');
        $this->load->database();
        $this->load->helper('url');

        $this->load->library("form_validation");
    }

    public function index() {

        $data = array(
            'css' => $this->cizacl->css(),
            'js' => $this->cizacl->scripts()
        );
        $data['summary'] = '<p align="center" class="summary">' . $this->lang->line('accounts') . ': <strong>' . $this->db->count_all_results('users') . '</strong></p>';
        $data['summary'] .= '<p>&nbsp;</p>';
        $this->db->order_by('cizacl_role_name');
        $query = $this->db->get('cizacl_roles');
        if ($query->num_rows()) {
            $data['summary'] .= '<p align="center" class="summary">';
            foreach ($query->result() as $row) {
                $this->db->where('user_cizacl_role_id = ' . $row->cizacl_role_id);
                $data['summary'] .= $row->cizacl_role_name . ': <strong>' . $this->db->count_all_results('users') . '</strong>, ';
            }
            $data['summary'] = substr($data['summary'], 0, -2);
            $data['summary'] .= '</p>';
        }
        $data['summary'] .= '<p>&nbsp;</p>';
        $this->db->order_by('user_status_name');
        $query = $this->db->get('user_status');
        if ($query->num_rows()) {
            $data['summary'] .= '<p align="center" class="summary">';
            foreach ($query->result() as $row) {
                $this->db->where('user_profile_user_status_code = ' . $row->user_status_code);
                $data['summary'] .= ucwords(str_replace(array('enabled', 'disabled', 'blocked'), array($this->lang->line('enabled'), $this->lang->line('disabled'), $this->lang->line('blocked')), $row->user_status_name)) . ': <strong>' . $this->db->count_all_results('user_profiles') . '</strong>, ';
            }
            $data['summary'] = substr($data['summary'], 0, -2);
            $data['summary'] .= '</p>';
        }
        $data['summary'] .= '<p>&nbsp;</p>';
        $this->db->order_by('cizacl_resource_controller');
        $data['summary'] .= '<p align="center" class="summary">' . $this->lang->line('controllers') . ': <strong>' . $this->db->count_all_results('cizacl_resources') . '</strong>, ';
        $this->db->where('cizacl_resource_function IS NOT NULL');
        $this->db->order_by('cizacl_resource_function');
        $data['summary'] .= $this->lang->line('functions') . ': <strong>' . $this->db->count_all_results('cizacl_resources') . '</strong></p>';
        $this->template->view_baru('cizacl/main', $data);
    }

    //Users
    public function users() {
        $this->load->view('cizacl/users');
    }

    public function management2() {
        $data["judul"] = "Wewenang";
        $data['grup'] = $this->cizacl_mdl->listRoles();
        $data['cizacl_resources'] = $this->cizacl_mdl->cizacl_resources();
        $this->template->view_baru('wewenang2/data', $data);
    }

    public function user_view($id) {
        $this->db->from('users');
        $this->db->from('user_profiles');
        $this->db->from('cizacl_roles');
        $this->db->from('user_status');
        $this->db->where('user_id = ' . $id);
        $this->db->where('user_id = user_profile_user_id');
        $this->db->where('user_cizacl_role_id = cizacl_role_id');
        $this->db->where('user_profile_user_status_code = user_status_code');
        $query = $this->db->get();
        $data['row'] = $query->row();

        $this->load->view('cizacl/user_view', $data);
    }

    public function user_add() {
        $this->load->helper('form');

        $this->db->order_by('cizacl_role_name');
        $query = $this->db->get('cizacl_roles');
        $roles[0] = $this->lang->line('select_option');
        foreach ($query->result() as $row)
            $roles[$row->cizacl_role_id] = $row->cizacl_role_name;

        $this->db->order_by('user_status_name');
        $query = $this->db->get('user_status');
        $status[0] = $this->lang->line('select_option');
        foreach ($query->result() as $row)
            $status[$row->user_status_id] = $this->lang->line(strtolower($row->user_status_name));

        $data['body'] = array(
            'title' => $this->lang->line('add_user')
        );

        $data['form'] = array(
            'action' => '#',
            'attributes' => array(
                'name' => 'form1',
                'id' => 'form1'
            ),
            'submit' => $this->lang->line('add'),
            'hidden' => array(
                'oper' => 'add'
            ),
            'name' => array(
                'name' => 'name',
                'id' => 'name',
            ),
            'surname' => array(
                'name' => 'surname',
                'id' => 'surname',
            ),
            'email' => array(
                'name' => 'email',
                'id' => 'email',
                'size' => 40
            ),
            'username' => array(
                'name' => 'username',
                'id' => 'username',
            ),
            'pwd' => array(
                'name' => 'pwd',
                'id' => 'pwd',
                'size' => 16
            ),
            'role' => array(
                'name' => 'role',
                'attributes' => 'id = "role"',
                'options' => $roles,
                'selected' => 2
            ),
            'status' => array(
                'name' => 'status',
                'attributes' => 'id = "status"',
                'options' => $status,
                'selected' => 1
            )
        );

        $this->load->view('cizacl/user_oper', $data);
    }

    public function user_edit($id) {
        $this->load->helper('form');

        $this->db->order_by('cizacl_role_order');
        $query = $this->db->get('cizacl_roles');
        $roles[0] = $this->lang->line('select_option');
        foreach ($query->result() as $row)
            $roles[$row->cizacl_role_id] = $row->cizacl_role_name;

        $this->db->order_by('user_status_name');
        $query = $this->db->get('user_status');
        $status[0] = $this->lang->line('select_option');
        foreach ($query->result() as $row)
            $status[$row->user_status_id] = $this->lang->line(strtolower($row->user_status_name));

        $this->db->from('users');
        $this->db->from('user_profiles');
        $this->db->where('user_id = ' . $id);
        $this->db->where('user_id = user_profile_user_id');
        $query = $this->db->get();
        $row = $query->row();

        $data['body'] = array(
            'title' => $this->lang->line('edit_user')
        );

        $data['form'] = array(
            'action' => '#',
            'attributes' => array(
                'name' => 'form1',
                'id' => 'form1'
            ),
            'submit' => $this->lang->line('edit'),
            'hidden' => array(
                'oper' => 'edit',
                'id' => $row->user_id
            ),
            'name' => array(
                'name' => 'name',
                'id' => 'name',
                'value' => $row->user_profile_name
            ),
            'surname' => array(
                'name' => 'surname',
                'id' => 'surname',
                'value' => $row->user_profile_surname
            ),
            'email' => array(
                'name' => 'email',
                'id' => 'email',
                'size' => 40,
                'value' => $row->user_profile_email
            ),
            'username' => array(
                'name' => 'username',
                'id' => 'username',
                'value' => $row->user_username
            ),
            'pwd' => array(
                'name' => 'pwd',
                'id' => 'pwd',
            ),
            'role' => array(
                'name' => 'role',
                'attributes' => 'id = "role"',
                'options' => $roles,
                'selected' => $row->user_cizacl_role_id
            ),
            'status' => array(
                'name' => 'status',
                'attributes' => 'id = "status"',
                'options' => $status,
                'selected' => $row->user_profile_user_status_code
            )
        );

        $this->load->view('cizacl/user_oper', $data);
    }

    public function users_op() {
        if ($this->input->post('oper') == 'add') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', $this->lang->line('name'), 'required|max_length[50]');
            $this->form_validation->set_rules('surname', $this->lang->line('surname'), 'required|max_length[50]');
            $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|valid_email|max_length[100]');
            $this->form_validation->set_rules('username', $this->lang->line('username'), 'required|valid_username|max_length[80]');
            $this->form_validation->set_rules('pwd', $this->lang->line('password'), 'required|min_length[5]|max_length[16]');
            $this->form_validation->set_rules('role', $this->lang->line('role'), 'required|valid_option');
            $this->form_validation->set_rules('status', $this->lang->line('state'), 'required|valid_option');

            if ($this->form_validation->run() == false) {
                die($this->cizacl->json_msg('error', $this->lang->line('attention'), validation_errors("<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>", "</p>"), true));
            } else {
                $addnew = array(
                    'user_username' => $this->input->post('username', true),
                    'user_password' => hash('sha256', $this->input->post('pwd', true)),
                    'user_cizacl_role_id' => $this->input->post('role', true)
                );
                if ($this->db->insert('users', $addnew)) {
                    unset($addnew);
                    $addnew = array(
                        'user_profile_user_id' => $this->db->insert_id(),
                        'user_profile_user_status_code' => $this->input->post('status', true),
                        'user_profile_name' => $this->input->post('name', true),
                        'user_profile_surname' => $this->input->post('surname', true),
                        'user_profile_email' => $this->input->post('email', true),
                        'user_profile_added' => time(),
                        'user_profile_added_by' => $this->session->userdata('user_id')
                    );
                    if ($this->db->insert('user_profiles', $addnew))
                        die($this->cizacl->json_msg('success', $this->lang->line('completed'), $this->lang->line('operation_done')));
                } else
                    die($this->cizacl->json_msg('error', $this->lang->line('attention'), $this->lang->line('error')));
            }
        }
        elseif ($this->input->post('oper') == 'edit') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', $this->lang->line('name'), 'required|max_length[50]');
            $this->form_validation->set_rules('surname', $this->lang->line('surname'), 'required|max_length[50]');
            $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|valid_email|max_length[100]');
            $this->form_validation->set_rules('username', $this->lang->line('username'), 'required|max_length[80]');
            $this->form_validation->set_rules('pwd', $this->lang->line('password'), 'min_length[5]|max_length[16]');
            $this->form_validation->set_rules('role', $this->lang->line('role'), 'required|valid_option');
            $this->form_validation->set_rules('status', $this->lang->line('state'), 'required|valid_option');

            if ($this->form_validation->run() == false) {
                die($this->cizacl->json_msg('error', $this->lang->line('attention'), validation_errors("<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>", "</p>"), true));
            } else {
                $update = array(
                    'user_username' => $this->input->post('username', true),
                    'user_cizacl_role_id' => $this->input->post('role', true)
                );
                $pwd = $this->input->post('pwd');
                if (!empty($pwd)) {
                    $update['user_password'] = hash('sha256', $this->input->post('pwd', true));
                }
                if ($this->db->update('users', $update, 'user_id = ' . $this->input->post('id'))) {
                    unset($update);
                    $update = array(
                        'user_profile_user_id' => $this->input->post('id', true),
                        'user_profile_user_status_code' => $this->input->post('status', true),
                        'user_profile_name' => $this->input->post('name', true),
                        'user_profile_surname' => $this->input->post('surname', true),
                        'user_profile_email' => $this->input->post('email', true),
                        'user_profile_edited' => time(),
                        'user_profile_edited_by' => $this->session->userdata('user_id')
                    );

                    if ($this->db->update('user_profiles', $update, 'user_profile_user_id = ' . $this->input->post('id', true)))
                        die($this->cizacl->json_msg('success', $this->lang->line('completed'), $this->lang->line('operation_done')));
                } else
                    die($this->cizacl->json_msg('error', $this->lang->line('attention'), $this->lang->line('error')));
            }
        }
        elseif ($this->input->post('oper') == 'del') {
            $this->db->where('user_profile_user_id = ' . $this->input->post('id', true));
            $query = $this->db->get('user_profiles');
            if ($query->num_rows()) {
                $row = $query->row();
                if ((string) $row->user_profile_added_by !== "0") { // Protect system's data
                    if ($this->db->delete('users', array('user_id' => $this->input->post('id'))))
                        if ($this->db->delete('user_profiles', array('user_profile_user_id' => $this->input->post('id', true))))
                            die($this->cizacl->json_msg('success', $this->lang->line('completed'), $this->lang->line('operation_done')));
                        else
                            die($this->cizacl->json_msg('error', $this->lang->line('attention'), $this->lang->line('error')));
                } else
                    show_error($this->lang->line('system_data'));
            }
        }
    }

    public function users_load_data() {
        $data = new stdClass();

        $page = $this->input->post('page');
        $limit = $this->input->post('rows');
        $sidx = $this->input->post('sidx');
        $sord = $this->input->post('sord');

        $count = $this->db->count_all_results('users');

        $total_pages = $count > 0 ? ceil($count / $limit) : 0;

        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;
        if ($start < 0)
            $start = 0;

        if ($this->input->post('_search') == 'true') {
            $json = json_decode($this->input->post('filters'), true);

            foreach ($json['rules'] as $key => $value) {
                if ($json['groupOp'] == 'AND')
                    $this->db->where($value['field'] . ' ' . $this->cizacl_mdl->jqgrid_operator($value['op'], $value['data']));
                else
                    $this->db->or_where($value['field'] . ' ' . $this->cizacl_mdl->jqgrid_operator($value['op'], $value['data']));
            }
        }
        $this->db->from('users');
        $this->db->from('user_profiles');
        $this->db->from('user_status');
        $this->db->from('cizacl_roles');
        $this->db->where('user_id = user_profile_user_id');
        $this->db->where('user_cizacl_role_id = cizacl_role_id');
        $this->db->where('user_profile_user_status_code = user_status_code');
        $this->db->order_by($sidx, $sord);
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        $data->page = (string) $page;
        $data->total = (string) $total_pages;
        $data->records = (string) $count;
        $i = 0;
        foreach ($query->result() as $row) {
            $data->rows[$i]['id'] = $row->user_id;
            $data->rows[$i]['cell'] = array(
                $row->user_id,
                $row->user_profile_surname,
                $row->user_profile_name,
                $row->user_profile_email,
                $row->cizacl_role_name,
                $row->user_status_name,
                $this->cizacl_mdl->mktime_format($row->user_profile_lastaccess),
                $this->cizacl_mdl->getUser($row->user_profile_added_by),
                $row->user_profile_added_by
            );
            $i++;
        }
        echo json_encode($data);
    }

    //Sessions
    public function sessions() {
        $this->load->view('cizacl/sessions');
    }

    public function sessions_op() {
        if ($this->input->post('oper') == 'del') {
            $id = explode(',', $this->input->post('id'));
            foreach ($id as $value) {
                if ($this->db->delete('ci_sessions', array('id' => $value)))
                    die($this->cizacl->json_msg('success', $this->lang->line('completed'), $this->lang->line('operation_done')));
                else {
                    die($this->cizacl->json_msg('error', $this->lang->line('attention'), $this->lang->line('error')));
                }
            }
        }
    }

    public function sessions_load_data() {
        $data = new stdClass();

        $page = $this->input->post('page');
        $limit = $this->input->post('rows');
        $sidx = $this->input->post('sidx');
        $sord = $this->input->post('sord');

        $count = $this->db->count_all_results('ci_sessions');

        $total_pages = $count > 0 ? ceil($count / $limit) : 0;

        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;

        if ($start < 0)
            $start = 0;

        if ($this->input->post('_search') == 'true') {
            $json = json_decode($this->input->post('filters'), true);

            foreach ($json['rules'] as $key => $value) {
                if ($json['groupOp'] == 'AND')
                    $this->db->where($value['field'] . ' ' . $this->cizacl_mdl->jqgrid_operator($value['op'], $value['data']));
                else
                    $this->db->or_where($value['field'] . ' ' . $this->cizacl_mdl->jqgrid_operator($value['op'], $value['data']));
            }
        }

        $this->db->order_by($sidx, $sord);
        $this->db->limit($limit, $start);
        $query = $this->db->get('cizacl_session');

        $data->page = (string) $page;
        $data->total = (string) $total_pages;
        $data->records = (string) $count;
        $i = 0;
        foreach ($query->result() as $row) {
            $array = unserialize($row->user_data);
            $data->rows[$i]['id'] = $row->id;
            $data->rows[$i]['cell'] = array(
                $this->cizacl_mdl->getUser($array['user_id']),
                $row->id,
                $row->ip_address,
                $row->data,
                date('d/m/Y H:i:s', $row->ci_sessions_timestamp),
            );
            $i++;
        }
        echo json_encode($data);
    }

    //ACL
    public function management() {
        $this->template->view_baru('cizacl/management');
    }

    public function role_add() {
        $this->load->helper('form');

        $array = json_decode($this->cizacl_mdl->getResources());
        $resources[0] = $this->lang->line('select_option');
        foreach ($array->rows as $value) {
            $resources[$value->value] = $value->name;
        }

        $this->db->order_by('cizacl_role_order');
        $query = $this->db->get('cizacl_roles');
        foreach ($query->result() as $row)
            $roles[$row->cizacl_role_id] = $row->cizacl_role_name;

        $data['body'] = array(
            'title' => $this->lang->line('add_role')
        );

        $data['form'] = array(
            'action' => '#',
            'attributes' => array(
                'name' => 'form1',
                'id' => 'form1'
            ),
            'submit' => $this->lang->line('add'),
            'hidden' => array(
                'oper' => 'add'
            ),
            'name' => array(
                'name' => 'name',
                'id' => 'name'
            ),
            'inherit' => array(
                'name' => 'inherit_id[]',
                'attributes' => 'id = "inherit_id[]"',
                'options' => $roles,
                'selected' => ''
            ),
            'redirect' => array(
                'name' => 'redirect',
                'attributes' => 'id = "redirect"',
                'options' => $resources,
                'selected' => ''
            ),
            'description' => array(
                'name' => 'description',
                'id' => 'description',
            ),
            'default' => array(
                'name' => 'default',
                'attributes' => 'id = "default"',
                'options' => array(
                    0 => $this->lang->line('no'),
                    1 => $this->lang->line('yes')
                ),
                'selected' => 0
            ),
            'order' => array(
                'name' => 'order',
                'id' => 'order',
                'value' => 998,
                'size' => 3
            )
        );

        $this->load->view('cizacl/role_oper', $data);
    }

    public function role_edit() {
        $this->load->helper('form');

        $array = json_decode($this->cizacl_mdl->getResources());
        $resources[0] = $this->lang->line('select_option');
        foreach ($array->rows as $value) {
            $resources[$value->value] = $value->name;
        }

        $this->db->order_by('cizacl_role_order');
        $query = $this->db->get('cizacl_roles');
        foreach ($query->result() as $row)
            $roles[$row->cizacl_role_id] = $row->cizacl_role_name;

        $this->db->where('cizacl_role_id = ' . $this->uri->segment(3));
        $query = $this->db->get('cizacl_roles');
        $row = $query->row();

        $data['body'] = array(
            'title' => $this->lang->line('edit_role')
        );

        $data['form'] = array(
            'action' => '#',
            'attributes' => array(
                'name' => 'form1',
                'id' => 'form1'
            ),
            'submit' => $this->lang->line('edit'),
            'hidden' => array(
                'oper' => 'edit',
                'id' => $row->cizacl_role_id
            ),
            'name' => array(
                'name' => 'name',
                'id' => 'name',
                'value' => $row->cizacl_role_name
            ),
            'inherit' => array(
                'name' => 'inherit_id[]',
                'attributes' => 'id = "inherit_id[]"',
                'options' => $roles,
                'selected' => json_decode($row->cizacl_role_inherit_id)
            ),
            'redirect' => array(
                'name' => 'redirect',
                'attributes' => 'id = "redirect"',
                'options' => $resources,
                'selected' => $row->cizacl_role_redirect
            ),
            'description' => array(
                'name' => 'description',
                'id' => 'description',
                'value' => $row->cizacl_role_description
            ),
            'default' => array(
                'name' => 'default',
                'attributes' => 'id = "default"',
                'options' => array(
                    0 => $this->lang->line('no'),
                    1 => $this->lang->line('yes')
                ),
                'selected' => $row->cizacl_role_default
            ),
            'order' => array(
                'name' => 'order',
                'id' => 'order',
                'size' => 3,
                'value' => $row->cizacl_role_order
            )
        );

        $this->load->view('cizacl/role_oper', $data);
    }

    public function roles_op() {
        if ($this->input->post('oper') == 'add') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', $this->lang->line('name'), 'required|max_length[20]');
            $this->form_validation->set_rules('redirect', $this->lang->line('redirect'), 'required|valid_option');
            $this->form_validation->set_rules('description', $this->lang->line('description'), 'max_length[255]');
            $this->form_validation->set_rules('order', $this->lang->line('order'), 'required|integer|max_length[3]');

            if ($this->form_validation->run() == false) {
                die($this->cizacl->json_msg('error', $this->lang->line('attention'), validation_errors("<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>", "</p>"), true));
            } else {
                $inherit_id = $this->cizacl_mdl->check_null($this->input->post('inherit_id', true));
                if (!empty($inherit_id))
                    $inherit_id = json_encode($inherit_id);
                else
                    $inherit_id = NULL;

                $addnew = array(
                    'cizacl_role_name' => $this->input->post('name', true),
                    'cizacl_role_inherit_id' => $inherit_id,
                    'cizacl_role_redirect' => $this->input->post('redirect', true),
                    'cizacl_role_description' => $this->input->post('description', true),
                    'cizacl_role_default' => $this->input->post('default', true),
                    'cizacl_role_order' => $this->input->post('order', true)
                );
                if ($this->db->insert('cizacl_roles', $addnew)) {
                    if ($this->input->post('default') == 1)
                        $this->db->update('cizacl_roles', array('cizacl_role_default' => 0), 'cizacl_role_id <> ' . $this->db->insert_id());

                    die($this->cizacl->json_msg('success', $this->lang->line('completed'), $this->lang->line('operation_done')));
                } else
                    die($this->cizacl->json_msg('error', $this->lang->line('attention'), $this->lang->line('error')));
            }
        }
        elseif ($this->input->post('oper') == 'edit') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', $this->lang->line('name'), 'required|max_length[20]');
            $this->form_validation->set_rules('redirect', $this->lang->line('redirect'), 'required|valid_option');
            $this->form_validation->set_rules('description', $this->lang->line('description'), 'max_length[255]');
            $this->form_validation->set_rules('order', $this->lang->line('order'), 'required|integer|max_length[3]');

            if ($this->form_validation->run() == false) {
                die($this->cizacl->json_msg('error', $this->lang->line('attention'), validation_errors("<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>", "</p>"), true));
            } else {
                $inherit_id = $this->input->post('inherit_id', true);
                if (!empty($inherit_id))
                    $inherit_id = json_encode($inherit_id);
                else
                    $inherit_id = NULL;

                $update = array(
                    'cizacl_role_name' => $this->input->post('name', true),
                    'cizacl_role_inherit_id' => $inherit_id,
                    'cizacl_role_redirect' => $this->input->post('redirect', true),
                    'cizacl_role_description' => $this->input->post('description', true),
                    'cizacl_role_default' => $this->input->post('default', true),
                    'cizacl_role_order' => $this->input->post('order', true)
                );
                if ($this->db->update('cizacl_roles', $update, 'cizacl_role_id = ' . $this->input->post('id'))) {
                    if ($this->input->post('default', true) == 1)
                        $this->db->update('cizacl_roles', array('cizacl_role_default' => 0), 'cizacl_role_id <> ' . $this->input->post('id'));

                    die($this->cizacl->json_msg('success', $this->lang->line('completed'), $this->lang->line('operation_done')));
                } else
                    die($this->cizacl->json_msg('error', $this->lang->line('attention'), $this->lang->line('error')));
            }
        }
        elseif ($this->input->post('oper') == 'del') {
            $id = explode(',', $this->input->post('id', true));
            foreach ($id as $value) {
                $this->db->where('user_cizacl_role_id = ' . $value);
                $query = $this->db->get('users');
                if ($query->num_rows()) {
                    $users = array();
                    foreach ($query->result() as $row)
                        $users[] = $row->user_id;
                }

                if (isset($users) && !empty($users)) {
                    foreach ($users as $user_id) {
                        $this->db->delete('users', array('user_id' => $user_id));
                        $this->db->delete('user_profiles', array('user_profile_user_id ' => $user_id));
                    }
                }

                $this->db->delete('cizacl_roles', array('cizacl_role_id' => $value));
                $this->db->delete('cizacl_rules', array('cizacl_rule_cizacl_role_id' => $value));
            }
        }
    }

    public function roles_load_data() {
        $data = new stdClass();

        $page = $this->input->post('page');
        $limit = $this->input->post('rows');
        $sidx = $this->input->post('sidx');
        $sord = $this->input->post('sord');

        $count = $this->db->count_all_results('cizacl_roles');

        $total_pages = $count > 0 ? ceil($count / $limit) : 0;

        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;

        if ($start < 0)
            $start = 0;

        if ($this->input->post('_search') == 'true') {
            $json = json_decode($this->input->post('filters'), true);

            foreach ($json['rules'] as $key => $value) {
                if ($json['groupOp'] == 'AND')
                    $this->db->where($value['field'] . ' ' . $this->cizacl_mdl->jqgrid_operator($value['op'], $value['data']));
                else
                    $this->db->or_where($value['field'] . ' ' . $this->cizacl_mdl->jqgrid_operator($value['op'], $value['data']));
            }
        }

        $this->db->order_by($sidx, $sord);
        $this->db->order_by('cizacl_role_inherit_id');
        $this->db->limit($limit, $start);
        $query = $this->db->get('cizacl_roles');

        $data->page = (string) $page;
        $data->total = (string) $total_pages;
        $data->records = (string) $count;
        $i = 0;
        foreach ($query->result() as $row) {
            $row->cizacl_role_inherit = array();
            if ($row->cizacl_role_inherit_id) {
                foreach (json_decode($row->cizacl_role_inherit_id) as $cizacl_role_inherit_id) {
                    $this->db->where('cizacl_role_id = ' . $cizacl_role_inherit_id);
                    $subquery = $this->db->get('cizacl_roles');
                    $subrow = $subquery->row();
                    $row->cizacl_role_inherit[] = $subrow->cizacl_role_name;
                }
            }

            $row->cizacl_role_default = $row->cizacl_role_default == 1 ? true : false;

            $data->rows[$i]['id'] = $row->cizacl_role_id;
            $data->rows[$i]['cell'] = array(
                $row->cizacl_role_id,
                $row->cizacl_role_name,
                implode(", ", $row->cizacl_role_inherit),
                $row->cizacl_role_redirect,
                $row->cizacl_role_description,
                $row->cizacl_role_order,
                $row->cizacl_role_default,
            );
            $i++;
        }
        echo json_encode($data);
    }

    public function resource_add() {
        $this->load->helper('form');

        $this->db->where('cizacl_resource_function');
        $this->db->order_by('cizacl_resource_controller');
        $query = $this->db->get('cizacl_resources');
        $controllers[0] = $this->lang->line('select_option');
        foreach ($query->result() as $controller) {
            $controllers[strtolower($controller->cizacl_resource_controller)] = $controller->cizacl_resource_controller;
        }

        $data['body'] = array(
            'title' => $this->lang->line('add_resource')
        );

        $data['form'] = array(
            'action' => '#',
            'attributes' => array(
                'name' => 'form1',
                'id' => 'form1'
            ),
            'submit' => $this->lang->line('add'),
            'hidden' => array(
                'oper' => 'add'
            ),
            'type' => array(
                'name' => 'type',
                'attributes' => 'id = "type"',
                'options' => array(
                    'controller' => $this->lang->line('controller'),
                    'function' => $this->lang->line('function')
                ),
                'selected' => ''
            ),
            'name' => array(
                'name' => 'name',
                'id' => 'name'
            ),
            'controller' => array(
                'name' => 'controller',
                'attributes' => 'id = "controller"',
                'options' => $controllers,
                'selected' => '0'
            ),
            'description' => array(
                'name' => 'description',
                'id' => 'description',
                'rows' => 3,
                'cols' => 45
            )
        );

        $this->load->view('cizacl/resource_oper', $data);
    }

    public function resource_edit() {
        $this->load->helper('form');

        $this->db->where('cizacl_resource_function');
        $this->db->order_by('cizacl_resource_controller');
        $query = $this->db->get('cizacl_resources');
        $controllers[0] = $this->lang->line('select_option');
        foreach ($query->result() as $controller) {
            $controllers[strtolower($controller->cizacl_resource_controller)] = $controller->cizacl_resource_controller;
        }

        $this->db->where('cizacl_resource_id = ' . $this->uri->segment(3));
        $query = $this->db->get('cizacl_resources');
        $row = $query->row();

        if ($row->cizacl_resource_type == 'controller')
            $name = $row->cizacl_resource_controller;
        else
            $name = $row->cizacl_resource_function;

        $data['body'] = array(
            'title' => $this->lang->line('edit_resource')
        );

        $data['form'] = array(
            'action' => '#',
            'attributes' => array(
                'name' => 'form1',
                'id' => 'form1'
            ),
            'submit' => $this->lang->line('edit'),
            'hidden' => array(
                'oper' => 'edit',
                'id' => $row->cizacl_resource_id
            ),
            'type' => array(
                'name' => 'type',
                'attributes' => 'id = "type"',
                'options' => array(
                    'controller' => $this->lang->line('controller'),
                    'function' => $this->lang->line('function')
                ),
                'selected' => $row->cizacl_resource_type
            ),
            'name' => array(
                'name' => 'name',
                'id' => 'name',
                'value' => $name
            ),
            'controller' => array(
                'name' => 'controller',
                'attributes' => 'id = "controller"',
                'options' => $controllers,
                'selected' => $row->cizacl_resource_controller
            ),
            'description' => array(
                'name' => 'description',
                'id' => 'description',
                'rows' => 3,
                'cols' => 45,
                'value' => $row->cizacl_resource_description
            )
        );

        $this->load->view('cizacl/resource_oper', $data);
    }

    public function resources_op() {
        if ($this->input->post('oper') == 'add') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', $this->lang->line('name'), 'required|max_length[50]');
            if ($this->input->post('type') == 'function')
                $this->form_validation->set_rules('controller', $this->lang->line('controller'), 'valid_option');

            if ($this->form_validation->run() == false) {
                die($this->cizacl->json_msg('error', $this->lang->line('attention'), validation_errors("<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>", "</p>"), true));
            } else {
                if ($this->input->post('type') == 'controller') {
                    $addnew = array(
                        'cizacl_resource_type' => $this->input->post('type', true),
                        'cizacl_resource_controller' => strtolower($this->input->post('name', true)),
                        'cizacl_resource_function' => NULL,
                        'cizacl_resource_description' => $this->input->post('description', true),
                        'cizacl_resource_added_on' => time(),
                        'cizacl_resource_added_by' => $this->session->userdata('user_id')
                    );
                } else {
                    $addnew = array(
                        'cizacl_resource_type' => $this->input->post('type', true),
                        'cizacl_resource_controller' => $this->input->post('controller', true),
                        'cizacl_resource_function' => strtolower($this->input->post('name', true)),
                        'cizacl_resource_description' => $this->input->post('description', true),
                        'cizacl_resource_added_on' => time(),
                        'cizacl_resource_added_by' => $this->session->userdata('user_id')
                    );
                }
                if ($this->db->insert('cizacl_resources', $addnew))
                    die($this->cizacl->json_msg('success', $this->lang->line('completed'), $this->lang->line('operation_done')));
                else
                    die($this->cizacl->json_msg('error', $this->lang->line('attention'), $this->lang->line('error')));
            }
        }
        elseif ($this->input->post('oper') == 'edit') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', $this->lang->line('name'), 'required|max_length[50]');
            if ($this->input->post('type') == 'function')
                $this->form_validation->set_rules('controller', $this->lang->line('controller'), 'valid_option');

            if ($this->form_validation->run() == false) {
                die($this->cizacl->json_msg('error', $this->lang->line('attention'), validation_errors("<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>", "</p>"), true));
            } else {
                if ($this->input->post('type', true) == 'controller') {
                    $update = array(
                        'cizacl_resource_type' => $this->input->post('type', true),
                        'cizacl_resource_controller' => strtolower($this->input->post('name', true)),
                        'cizacl_resource_function' => NULL,
                        'cizacl_resource_description' => $this->input->post('description', true),
                        'cizacl_resource_edited_on' => time(),
                        'cizacl_resource_edited_by' => $this->session->userdata('user_id')
                    );
                } else {
                    $update = array(
                        'cizacl_resource_type' => $this->input->post('type', true),
                        'cizacl_resource_controller' => $this->input->post('controller', true),
                        'cizacl_resource_function' => strtolower($this->input->post('name', true)),
                        'cizacl_resource_description' => $this->input->post('description', true),
                        'cizacl_resource_edited_on' => time(),
                        'cizacl_resource_edited_by' => $this->session->userdata('user_id')
                    );
                }
                if ($this->db->update('cizacl_resources', $update, 'cizacl_resource_id = ' . $this->input->post('id', true)))
                    die($this->cizacl->json_msg('success', $this->lang->line('completed'), $this->lang->line('operation_done')));
                else
                    die($this->cizacl->json_msg('error', $this->lang->line('attention'), $this->lang->line('error')));
            }
        }
        elseif ($this->input->post('oper') == 'del') {
            $this->db->where('cizacl_resource_id = ' . $this->input->post('id', true));
            $query = $this->db->get('cizacl_resources');
            if ($query->num_rows()) {
                $row = $query->row();
                if ((string) $row->cizacl_resource_added_by !== "0") { // Protect system's data
                    if ($row->cizacl_resource_type == 'controller') {
                        if ($this->db->delete('cizacl_resources', array('cizacl_resource_controller' => $row->cizacl_resource_controller)))
                            die($this->cizacl->json_msg('success', $this->lang->line('completed'), $this->lang->line('operation_done')));
                        else
                            die($this->cizacl->json_msg('error', $this->lang->line('attention'), $this->lang->line('error')));
                    }
                    else {
                        if ($this->db->delete('cizacl_resources', array('cizacl_resource_id' => $this->input->post('id', true))))
                            die($this->cizacl->json_msg('success', $this->lang->line('completed'), $this->lang->line('operation_done')));
                        else
                            die($this->cizacl->json_msg('error', $this->lang->line('attention'), $this->lang->line('error')));
                    }
                } else
                    show_error($this->lang->line('system_data'));
            }
        }
    }

    public function resources_load_data() {
        $data = new stdClass();

        $page = $this->input->post('page');
        $limit = $this->input->post('rows');
        $sidx = $this->input->post('sidx');
        $sord = $this->input->post('sord');

        $count = $this->db->count_all_results('cizacl_resources');

        $total_pages = $count > 0 ? ceil($count / $limit) : 0;

        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;

        if ($start < 0)
            $start = 0;

        if ($this->input->post('_search') == 'true') {
            $json = json_decode($this->input->post('filters'), true);

            foreach ($json['rules'] as $key => $value) {
                if ($json['groupOp'] == 'AND')
                    $this->db->where($value['field'] . ' ' . $this->cizacl_mdl->jqgrid_operator($value['op'], $value['data']));
                else
                    $this->db->or_where($value['field'] . ' ' . $this->cizacl_mdl->jqgrid_operator($value['op'], $value['data']));
            }
        }

        $this->db->order_by($sidx, $sord);
        $this->db->order_by('cizacl_resource_function');
        $this->db->limit($limit, $start);
        $query = $this->db->get('cizacl_resources');

        $data->page = (string) $page;
        $data->total = (string) $total_pages;
        $data->records = (string) $count;
        $i = 0;
        foreach ($query->result() as $row) {
            $data->rows[$i]['id'] = $row->cizacl_resource_id;
            $data->rows[$i]['cell'] = array(
                $row->cizacl_resource_id,
                $row->cizacl_resource_controller,
                $row->cizacl_resource_function,
                $row->cizacl_resource_description,
                $row->cizacl_resource_added_by,
            );
            $i++;
        }
        echo json_encode($data);
    }

    public function rule_add() {
        $this->load->helper('form');

        $this->db->order_by('cizacl_role_order');
        $query = $this->db->get('cizacl_roles');
        $roles[0] = $this->lang->line('select_option');
        $roles['NULL'] = $this->lang->line('all_roles');
        foreach ($query->result() as $row)
            $roles[$row->cizacl_role_id] = $row->cizacl_role_name;

        $data['body'] = array(
            'title' => $this->lang->line('add_rule')
        );

        $data['form'] = array(
            'action' => '#',
            'attributes' => array(
                'name' => 'form1',
                'id' => 'form1',
                'oper' => 'add'
            ),
            'submit' => $this->lang->line('add'),
            'hidden' => array(
                'oper' => 'add'
            ),
            'role' => array(
                'name' => 'cizacl_role_id',
                'attributes' => 'id = "cizacl_role_id"',
                'options' => $roles,
                'selected' => ''
            )
        );

        $this->load->view('cizacl/rule_oper', $data);
    }

    public function rule_edit() {
        $this->load->helper('form');

        $this->db->order_by('cizacl_role_order');
        $query = $this->db->get('cizacl_roles');
        $roles[0] = $this->lang->line('select_option');
        $roles['NULL'] = $this->lang->line('all_roles');
        foreach ($query->result() as $row)
            $roles[$row->cizacl_role_id] = $row->cizacl_role_name;

        $this->db->where('cizacl_rule_id = ' . $this->uri->segment(3));
        $data['query'] = $this->db->get('cizacl_rules');
        $row = $data['query']->row();

        if ($row->cizacl_rule_cizacl_role_id == NULL)
            $row->cizacl_rule_cizacl_role_id = 'NULL';

        $data['body'] = array(
            'title' => $this->lang->line('edit_rule')
        );

        $data['form'] = array(
            'action' => '#',
            'attributes' => array(
                'name' => 'form1',
                'id' => 'form1',
                'oper' => 'edit'
            ),
            'submit' => $this->lang->line('edit'),
            'hidden' => array(
                'oper' => 'edit',
                'id' => $row->cizacl_rule_cizacl_role_id,
            ),
            'role' => array(
                'name' => 'cizacl_role_id',
                'attributes' => 'id = "cizacl_role_id"',
                'options' => $roles,
                'selected' => $row->cizacl_rule_cizacl_role_id
            )
        );

        $this->load->view('cizacl/rule_oper', $data);
    }

    public function rules_op() {
        if ($this->input->post('oper') == 'add') {
            $this->load->library('form_validation');

            //$this->form_validation->set_message('required', $this->lang->line('valid_rule'));
            //$this->form_validation->set_rules('cizacl_role_id', $this->lang->line('role'), 'valid_option');
            //$this->form_validation->set_rules('type', $this->lang->line('rules'), 'required');
            //if ($this->form_validation->run() == false)	{
            //die($this->cizacl->json_msg('error',$this->lang->line('attention'),validation_errors("<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>","</p>"),true));
            //}
            //else	{
            $type_array = $this->input->post('type', true);
            $controller_array = $this->input->post('controller', true);
            $function_array = $this->input->post('function', true);
            $status_array = $this->input->post('status', true);
            $description_array = $this->input->post('description', true);

            foreach ($type_array as $id => $type) {
                foreach ($controller_array[$id] as $tkey => $tvalue) {
                    if (strtolower($controller_array[$id][$tkey]) == 'null')
                        $controller_array[$id][$tkey] = NULL;
                }
                if (strtolower($controller_array[$id][0]) == 'null')
                    $controller_array[$id] = json_encode(array(NULL));
                else
                    $controller_array[$id] = json_encode($controller_array[$id]);

                foreach ($function_array[$id] as $tkey => $tvalue) {
                    if (strtolower($function_array[$id][$tkey]) == 'null')
                        $function_array[$id][$tkey] = NULL;
                }
                if (strtolower($function_array[$id][0]) == 'null')
                    $function_array[$id] = NULL;
                else
                    $function_array[$id] = json_encode($function_array[$id]);

                $addnew = array(
                    'cizacl_rule_cizacl_role_id' => $this->cizacl_mdl->check_null($this->input->post('cizacl_role_id', true)),
                    'cizacl_rule_type' => $type,
                    'cizacl_rule_cizacl_resource_controller' => $controller_array[$id],
                    'cizacl_rule_cizacl_resource_function' => $function_array[$id],
                    'cizacl_rule_status' => $status_array[$id],
                    'cizacl_rule_description' => $description_array[$id]
                );
                $this->db->insert('cizacl_rules', $addnew);
                unset($addnew);
            }
            die($this->cizacl->json_msg('success', $this->lang->line('completed'), $this->lang->line('operation_done')));
            //}
        }
        elseif ($this->input->post('oper') == 'edit') {
            $this->load->library('form_validation');

            $this->form_validation->set_message('required', $this->lang->line('valid_rule'));
            $this->form_validation->set_rules('cizacl_role_id', $this->lang->line('role'), 'valid_option');
            $this->form_validation->set_rules('type', $this->lang->line('rules'), 'required');

            if ($this->form_validation->run() == false) {
                die($this->cizacl->json_msg('error', $this->lang->line('attention'), validation_errors("<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>", "</p>"), true));
            } else {
                $this->db->where('cizacl_rule_cizacl_role_id = ' . $this->input->post('id', true));
                $this->db->delete('cizacl_rules');

                $type_array = $this->input->post('type', true);
                $controller_array = $this->input->post('controller', true);
                $function_array = $this->input->post('function', true);
                $status_array = $this->input->post('status', true);
                $description_array = $this->input->post('description', true);

                foreach ($type_array as $id => $type) {
                    foreach ($controller_array[$id] as $tkey => $tvalue) {
                        if (strtolower($controller_array[$id][$tkey]) == 'null')
                            $controller_array[$id][$tkey] = NULL;
                    }
                    if (strtolower($controller_array[$id][0]) == 'null')
                        $controller_array[$id] = json_encode(array(NULL));
                    else
                        $controller_array[$id] = json_encode($controller_array[$id]);

                    foreach ($function_array[$id] as $tkey => $tvalue) {
                        if (strtolower($function_array[$id][$tkey]) == 'null')
                            $function_array[$id][$tkey] = NULL;
                    }
                    if (strtolower($function_array[$id][0]) == 'null')
                        $function_array[$id] = NULL;
                    else
                        $function_array[$id] = json_encode($function_array[$id]);

                    $addnew = array(
                        'cizacl_rule_cizacl_role_id' => $this->cizacl_mdl->check_null($this->input->post('cizacl_role_id', true)),
                        'cizacl_rule_type' => $type,
                        'cizacl_rule_cizacl_resource_controller' => $controller_array[$id],
                        'cizacl_rule_cizacl_resource_function' => $function_array[$id],
                        'cizacl_rule_status' => $status_array[$id],
                        'cizacl_rule_description' => $description_array[$id]
                    );
                    $this->db->insert('cizacl_rules', $addnew);
                    unset($addnew);
                }
                die($this->cizacl->json_msg('success', $this->lang->line('completed'), $this->lang->line('operation_done')));
            }
        }
        elseif ($this->input->post('oper') == 'del') {
            $id = explode(',', $this->input->post('id'));
            foreach ($id as $value) {
                $this->db->delete('cizacl_rules', array('cizacl_rule_id' => $value));
            }
        }
    }

    public function rules_load_data() {
        $data = new stdClass();

        $page = $this->input->post('page');
        $limit = $this->input->post('rows');
        $sidx = $this->input->post('sidx');
        $sord = $this->input->post('sord');

        $count = $this->db->count_all_results('cizacl_rules');

        $total_pages = $count > 0 ? ceil($count / $limit) : 0;

        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;

        if ($start < 0)
            $start = 0;

        if ($this->input->post('_search') == 'true') {
            $json = json_decode($this->input->post('filters'), true);

            foreach ($json['rules'] as $key => $value) {
                if ($value['data'] == 'All' || $value['data'] == 'all')
                    $value['data'] = 'null';
                if ($json['groupOp'] == 'AND')
                    $this->db->where($value['field'] . ' ' . $this->cizacl_mdl->jqgrid_operator($value['op'], $value['data']));
                else
                    $this->db->or_where($value['field'] . ' ' . $this->cizacl_mdl->jqgrid_operator($value['op'], $value['data']));
            }
        }

        $this->db->from('cizacl_rules');
        $this->db->order_by('cizacl_rule_cizacl_role_id');
        $this->db->order_by($sidx, $sord);
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        $data->page = (string) $page;
        $data->total = (string) $total_pages;
        $data->records = (string) $count;
        $i = 0;
        foreach ($query->result() as $row) {
            $cizacl_rule_cizacl_role_id = $row->cizacl_rule_cizacl_role_id;
            if (!empty($cizacl_rule_cizacl_role_id)) {
                $this->db->where('cizacl_role_id = ' . $row->cizacl_rule_cizacl_role_id);
                $subquery = $this->db->get('cizacl_roles');
                $subrow = $subquery->row();
            } else {
                $subrow->cizacl_role_id = NULL;
                $subrow->cizacl_role_name = $this->lang->line('all_users');
            }
            $row->cizacl_rule_cizacl_resource_controller = json_decode($row->cizacl_rule_cizacl_resource_controller);
            if (empty($row->cizacl_rule_cizacl_resource_controller[0]))
                $row->cizacl_rule_cizacl_resource_controller[0] = $this->lang->line('all');
            else {
                foreach ($row->cizacl_rule_cizacl_resource_controller as $key => $value)
                    if (empty($value[$key]))
                        $row->cizacl_rule_cizacl_resource_controller[$key] = $this->lang->line('all');
            }
            $row->cizacl_rule_cizacl_resource_function = json_decode($row->cizacl_rule_cizacl_resource_function);
            if (empty($row->cizacl_rule_cizacl_resource_function[0]))
                $row->cizacl_rule_cizacl_resource_function[0] = $this->lang->line('all');
            else {
                foreach ($row->cizacl_rule_cizacl_resource_function as $key => $value)
                    if (empty($value[$key]))
                        $row->cizacl_rule_cizacl_resource_function[$key] = $this->lang->line('all');
            }
            $row->cizacl_rule_status = $row->cizacl_rule_status ? $this->lang->line('enabled') : $this->lang->line('disabled');
            $data->rows[$i]['id'] = $row->cizacl_rule_id;
            $data->rows[$i]['cell'] = array(
                $row->cizacl_rule_id,
                ucwords($row->cizacl_rule_type),
                $subrow->cizacl_role_id,
                $subrow->cizacl_role_name,
                implode(', ', $row->cizacl_rule_cizacl_resource_controller),
                implode(', ', $row->cizacl_rule_cizacl_resource_function),
                $row->cizacl_rule_status,
                $row->cizacl_rule_description,
            );
            $i++;
        }
        echo json_encode($data);
    }

    //jQuery Loader
    public function getControllers($null = '') {
        echo $this->cizacl_mdl->getControllers();
    }

    public function getFunctions($null = '') {
        echo $this->cizacl_mdl->getFunctions();
    }

    public function getRules($id) {
        echo $this->cizacl_mdl->getRules($id);
    }

    public function getResources() {
        echo $this->cizacl_mdl->getResources();
    }

    // Buatan Sendiri
    // Group Akun
    function group() {
        $data["judul"] = "List Group";
        $data["roles"] = $this->cizacl_mdl->listRoles();
        $this->template->view_baru('acl/list_grup', $data);
    }

    function form_group($id = "") {
        $data = array('nama_group' => '', 'judul' => '', 'act' => '', 'id' => $id, 'parent_group' => '');

        $data["judul"] = "Tambah Group";
        $data['act'] = "";

        $this->template->view_baru('acl/tambah_group', $data);
    }

    function tambah() {
        $post = $this->input->post();

        $btnSimpan = $this->input->post('btnSimpan');
        if ($btnSimpan == "simpan") {
            $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required|max_length[50]');
            //$this->form_validation->set_rules('parent_menu', 'Induk', 'required|max_length[50]');
            //$this->form_validation->set_rules('user_function_list_id', 'Function', 'required|max_length[50]');


            if ($this->form_validation->run() == FALSE) {
                $message = alert_php2('Proses Gagal. ', 'error', 'Data gagal disimpan');
                $this->session->set_userdata($this->config->item('ses_message'), $message);
                redirect(base_url() . 'acl/menu');
            } else {
                $data_create = array(
                    'nama_menu' => $this->input->post('nama_menu'),
                    'parent' => $this->input->post('parent_menu'),
                    'link' => $this->input->post('link'),
                    'user_menu_index' => $this->input->post('user_menu_index'),
                    'icon' => $this->input->post('user_icon')
                );

                $this->db->insert('tbl_menu', $data_create);

                $message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil disimpan');
                $this->session->set_userdata($this->config->item('ses_message'), $message);
                redirect(base_url() . 'acl/menu');
            }
        }
    }

    public function ubah() {
        $id = $this->input->post('id');
        $data_update = array(
            'nama_menu' => $this->input->post('nama_menu'),
            'parent' => $this->input->post('parent_menu'),
            'link' => $this->input->post('link'),
            'user_menu_index' => $this->input->post('user_menu_index'),
            'icon' => $this->input->post('user_icon'),
        );
        $this->db->where('id', $this->input->post('id'));
        $update = $this->db->update('tbl_menu', $data_update);
//        echo $this->db->last_query();
//        die();
        if ($update) {
            $message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dihapus');
            $this->session->set_userdata($this->config->item('ses_message'), $message);
            redirect(base_url() . 'acl/menu');
        } else {
            $message = alert_php2('Proses gagal. ', 'error', 'Data gagal dihapus');
            $this->session->set_userdata($this->config->item('ses_message'), $message);
            redirect(base_url() . 'acl/menu');
        }
    }

    public function menu_hapus() {
        $id = $this->input->get('id');
        $data_update = array(
            'status_delete' => 1
        );
        $this->db->where('md5(id)', $id = $this->input->get('id'));
        $delete = $this->db->update('tbl_menu', $data_update);
        if ($delete) {
            $message = alert_php2('Proses berhasil. ', 'success', 'Data berhasil dihapus');
            $this->session->set_userdata($this->config->item('ses_message'), $message);
            redirect(base_url() . 'acl/menu');
        } else {
            $message = alert_php2('Proses gagal. ', 'error', 'Data gagal dihapus');
            $this->session->set_userdata($this->config->item('ses_message'), $message);
            redirect(base_url() . 'acl/menu');
        }
    }

    // Management Menu
    function menu() {
        $data["judul"] = "List Menu";
        $data['data_menu'] = $this->db->where('status_delete', 0)->get('tbl_menu')->result();
        $this->template->view_baru('acl/list_menu', $data);
    }

    function form_menu($id = "") {

        $data = array('user_menu' => '', 'id' => $id, 'parent_menu' => '', 'user_function_list_id' => '');

        $data["judul"] = "Tambah Menu";

        $id = $this->input->get('id');

        $data['act'] = "tambah/" . $id;
        $data['menu'] = $this->cizacl_mdl->getMenuById($id);
        $this->template->view_baru('acl/tambah_menu', $data);
    }

    function search_menu() {
        $this->load->model('model_modul');
        $idrole = $this->session->userdata('user_cizacl_role_id');

        if ($idrole > 1) {
            $dataMenu = $this->db
                    ->from('tbl_menu a')
                    ->join('tbl_akses_menu b', 'a.id=b.id_menu', 'left')
                    ->where(array('b.id_role' => $idrole, 'b.status_akses' => 'aktif'))
                    ->get();
        } else {
            $dataMenu = $this->db
                    ->from('tbl_menu a')
                    ->join('tbl_akses_menu b', 'a.id=b.id_menu', 'left')
                    ->where(array('b.status_akses' => 'aktif'))
                    ->get();
        }
        $data = array();
        foreach ($dataMenu->result() as $row) {
            $check = $this->model_modul->check_role($row->id, $idrole);
            if ($check <> false) {
                $data[] = array('name' => $row->nama_menu, 'url' => $row->link);
            }
        }
        echo json_encode($data);
    }

    function akses_menu() {
        $data["judul"] = "Hak Akses Menu";
        $data["data_group"] = $this->cizacl_mdl->listRoles();
        $data['data_menu'] = $this->db->where('status_delete', 0)->get('tbl_menu')->result();
        $this->template->view_baru('acl/list_group_menu', $data);
    }

    function update_check_akses() {
        $post = $this->input->post();
        $dt = explode("_", $post['cek']);
        $data['status_akses'] = $post['sts'];

        $check_akses = $this->db->where(array('id_role' => $dt[2], 'id_menu' => $dt[1], 'status_delete' => 0))->get('tbl_akses_menu')->row();

        if (isset($check_akses->id)) {
            $query = $this->db->where('id', $check_akses->id)->update('tbl_akses_menu', $data);
        } else {
            $data['id_role'] = $dt[2];
            $data['id_menu'] = $dt[1];
            $query = $this->db->insert('tbl_akses_menu', $data);
        }

        if ($query) {
            echo json_encode(array('success' => true, 'pesan' => 'Update berhasil !'));
        } else {
            echo json_encode(array('success' => false, 'pesan' => 'Update GAGAL !'));
        }
    }

}
