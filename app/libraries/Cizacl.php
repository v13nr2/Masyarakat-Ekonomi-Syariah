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

class Cizacl
{
	public $name;
	public $version;
	
	function __construct()
	{
		$this->name		= 'CIzACL';
		$this->version	= '1.4';
		
		//Load
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('cizacl_mdl');
		$this->lang->load('cizacl',$this->config->item('language'));
		
		$lang_abbr = $this->config->item('language_abbr');
		if(!isset($lang_abbr) || empty($lang_abbr))
			show_error($this->lang->line('no_lang_abbr'));
		
		//Load config file
		$this->load->config('cizacl', TRUE);
		$this->_config = $this->config->item('cizacl');
		
		//Append Zend's folder in PHP's include path
		ini_set('include_path',ini_get('include_path'). PATH_SEPARATOR . APPPATH . 'libraries' . PATH_SEPARATOR); 
		
		//Load the Acl class
		require_once 'Zend/Acl.php';
		require_once 'Zend/Acl/Role.php';
		require_once 'Zend/Acl/Resource.php';
		
		//Database
		$this->db->order_by('cizacl_role_order');
		$qRoles = $this->db->get('cizacl_roles');
		
		$this->db->order_by('cizacl_resource_controller');
		$this->db->order_by('cizacl_resource_id');
		$qResources = $this->db->get('cizacl_resources');
		
		$this->db->where('cizacl_rule_status = 1');
		$this->db->order_by('cizacl_rule_cizacl_resource_function');
		$qRules = $this->db->get('cizacl_rules');
				
		//Create a new Acl object
		$this->cizacl = new Zend_Acl();
		
		//Set Roles
		//Check Zend's documentation for excellent information on all these. http://framework.zend.com/manual/en/zend.cizacl.html
		foreach($qRoles->result() as $role)	{
			if(!empty($role->cizacl_role_inherit_id))	{
				foreach(json_decode($role->cizacl_role_inherit_id) as $role_inherit)	{
					$role_inherit_array[] = $role_inherit;
				}
			}
			if(!empty($role->cizacl_role_inherit_id))
				$this->cizacl->addRole(new Zend_Acl_Role($role->cizacl_role_id),$role_inherit_array);
			else
				$this->cizacl->addRole(new Zend_Acl_Role($role->cizacl_role_id));
		}
		if(isset($qRoles)) $qRoles->free_result();
		unset($role);
		unset($role_inherit);
		unset($role_inherit_array);

		//Set Resources
		foreach($qResources->result() as $resources)	{
			if($resources->cizacl_resource_type == 'controller')
				$this->cizacl->add(new Zend_Acl_Resource($resources->cizacl_resource_controller));
			else
				$this->cizacl->add(new Zend_Acl_Resource($resources->cizacl_resource_function),$resources->cizacl_resource_controller);
		}
		if(isset($qResources)) $qResources->free_result();
		if(isset($qPrivileges)) $qPrivileges->free_result();
		unset($resources);
		 		
		//Set Rules
		foreach($qRules->result() as $rules)	{
			$privileges = array();
			if(!empty($rules->cizacl_rule_cizacl_resource_function))	{
				foreach(json_decode($rules->cizacl_rule_cizacl_resource_function) as $privilege)	{
					if(!empty($privilege))
						$privileges[] = $privilege;
				}
			}
			$resources = array();
			foreach(json_decode($rules->cizacl_rule_cizacl_resource_controller) as $resource)	{
				if(!empty($resource))
					$resources[] = $resource;
			}
			if($rules->cizacl_rule_type == 'allow')	{
				$this->cizacl->allow($rules->cizacl_rule_cizacl_role_id,$resources,$privileges);
			}
			else
				$this->cizacl->deny($rules->cizacl_rule_cizacl_role_id,$resources,$privileges);
		}
		if(isset($qRules)) $qRules->free_result();
		unset($rules);
		unset($privilege);
		unset($privileges);
		unset($resource);
		unset($resources);
		
		// run the access control check now
		if($this->_config['cizacl_status'])
			$this->check_cizacl();
	}
	
	function check_cizacl()
	{
		//Load config file
		$this->load->config('cizacl', TRUE);
		$this->_config = $this->config->item('cizacl');
		
		$resource = $this->uri->segment(1) ? $this->uri->segment(1) : $this->router->default_controller;
		
		$privilege = $this->uri->segment(2) ? $this->uri->segment(2) : 'index';
		
		if (!$this->cizacl->has($resource))
			return;
		
		if($this->cizacl_mdl->getDefaultUser($this->session->userdata('user_cizacl_role_id')))
			$role = $this->cizacl_mdl->getDefaultUser($this->session->userdata('user_cizacl_role_id'));
		else
			die(show_error($this->lang->line('no_default_role')));
		
		if(!$this->cizacl->isAllowed($role,$resource,$privilege))
			show_error($this->lang->line('no_permissions'));
	}

	public function css()
	{
		$array = array(
			'cizacl',
			'ui-cizacl/jquery-ui-1.8.14.custom',
			'colorbox',
			'ui.jqgrid',
			'jquery.searchFilter',
		);
		$data = '';
		foreach($array as $value)	{
			$data .= '<link href="'.base_url().'css/cizacl/'.$value.'.css" rel="stylesheet" type="text/css" />'.PHP_EOL;
		}
		$data .=	'<!--[if lte IE 8]>'.PHP_EOL.
					'<link href="'.base_url().'css/cizacl/cizaclIE.css" rel="stylesheet" type="text/css" />'.PHP_EOL.
					'<![endif]-->'.PHP_EOL;
		return $data;
	}
	
	public function scripts()
	{
		$array = array(
			'jquery-1.6.1.min',
			'jquery-ui-1.8.14.custom.min',
			'jquery.colorbox.min',
			'i18n/jqgrid/grid.locale-'.$this->cizacl_mdl->getAbbr('js/cizacl/i18n/jqgrid/','grid.locale-xx.js'),
			'jquery.jqGrid.min',
		);
		$data = '';
		foreach($array as $value)	{
			$data .= '<script type="text/javascript" src="'.base_url().'js/cizacl/'.$value.'.js"></script>'.PHP_EOL;
		}
		$data .= '<script type="text/javascript" src="'.site_url('cizacl_js/scripts').'"></script>'.PHP_EOL;
		return $data;
	}

	function json_msg($type,$title,$msg,$form_validation=false,$more=NULL)
	{
		$data = new stdClass();

		if($type == 'success')	{
			$data->response	= 'success';
			$data->msg		= '<div class="ui-state-highlight ui-corner-all ui-msg"><h3>'.$title.'</h3><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>'.$msg.'</p></div>';
		}
		elseif($type == 'alert')	{
			$data->response	= 'alert';
			$data->msg		= '<div class="ui-state-highlight ui-corner-all ui-msg"><h3>'.$title.'</h3><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>'.$msg.'</p></div>';
		}
		elseif($type == 'error')	{
			$data->response	= 'error';
			if(!$form_validation)
				$data->msg		= '<div class="ui-state-error ui-corner-all ui-msg"><h3>'.$title.'</h3><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>'.$msg.'</p></div>';
			else
				$data->msg		= '<div class="ui-state-error ui-corner-all ui-msg"><h3>'.$title.'</h3>'.$msg.'</div>';
		}
		$data->more	= $more;
		return json_encode($data);
	}
	
	//Check
	function check_hasRole($role)
	{
		if(is_numeric($role))
			return $this->cizacl->hasRole($role);
		else	{
			$this->db->where('LOWER(cizacl_role_name)',strtolower($role));
			$query = $this->db->get('cizacl_roles');
			if($query->num_rows())	{
				$row = $query->row();
				return $this->cizacl->hasRole($row->cizacl_role_id);
			}
			return false;
		}
	}

	function check_has($resource)
	{
		return $this->cizacl->has($resource);
	}

	function check_isAllowed($role = null, $resource = null, $privilege = null)
	{
		if($role == null || empty($role))
			$role = 'Guest';
		if(!is_numeric($role))	{
			$this->db->where('LOWER(cizacl_role_name)',strtolower($role));
			$query = $this->db->get('cizacl_roles');
			if($query->num_rows())	{
				$row = $query->row();
				$role = $row->cizacl_role_id;
			}
		}
		return $this->cizacl->isAllowed($role, $resource, $privilege);
	}

    function __get($var)    {
        static $CI;
        (is_object($CI)) OR $CI = get_instance();
        return $CI->$var;
    }
	
}