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

class Cizacl_Js extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('cizacl',$this->config->item('language'));
	}
	
	public function scripts()
	{
		$output = '
		$(document).ready(function()	{
			make_menu();
			$(".cizacl_btn_add").button({
				icons: {
					primary: "ui-icon-plus"
				}
			});
			$(".cizacl_btn_edit").button({
				icons: {
					primary: "ui-icon-pencil"
				}
			});
			$(".cizacl_btn_view").button({
				icons: {
					primary: "ui-icon-contact"
				}
			});
			$(".cizacl_btn_del").button({
				icons: {
					primary: "ui-icon-trash"
				}
			});
			$(".cizacl_btn_disactive").button({
				icons: {
					primary: "ui-icon-power"
				}
			});
			$(".cizacl_btn_save").button({
				icons: {
					primary: "ui-icon-disk"
				}
			});
			$(".cizacl_btn_reset").button({
				icons: {
					primary: "ui-icon-arrowreturnthick-1-w"
				}
			});
			
			$("#menu").mouseover(function()	{
				$("#menu #content").slideDown("slow");
				$("#menu #label a").text("'.$this->lang->line('close').'");
			})
			.mouseleave(function()	{
				$("#menu #content").slideUp(100);
				$("#menu #label a").text("'.$this->lang->line('menu').'");
			});
			$("#menu #label a").click(function()	{
				$("#menu").mouseleave();
			});
			
			inputs_style();
		});
		function inputs_style()	{
			$("input, button, textarea, select").addClass("ui-corner-all");
		}
		function colorbox(url,width,height,url_helper,onclosed_fn)	{
			if(width == null)
				width = "80%";
			if(height == null)
				height = "80%";
			if(url_helper == false)
				url_helper = "";
			else
				url_helper = "'.site_url().'";
			if(onclosed_fn == null)
				onclosed_fn = "";
			
			$.colorbox({
				iframe:true,
				width:width,
				height:height,
				href: url_helper+url,
				onClosed: function()	{
					if(onclosed_fn == "reloadGrid")
						$(".jqgrid").trigger("reloadGrid");
					else
						onclosed_fn;
				}
			});
		}
		function jq_msg(data, scrollTopValue, TimeoutValue)	{
			$("html,body").animate({scrollTop: scrollTopValue},"slow");
			$("#jq_msg").html(data.msg).slideDown("slow");
			if(TimeoutValue > 0)
				setTimeout("$(\"#jq_msg\").slideUp(\"slow\")", TimeoutValue);
		}
		function make_menu()	{
			menu	= $("<div/>", {"id":"menu"});
			content	= $("<div/>", {"id":"content"});
			ul		= $("<ul/>");
			item1	= $("<li/>");
			item2	= $("<li/>");
			item3	= $("<li/>");
			item4	= $("<li/>");
			item5	= $("<li/>");
			label	= $("<div/>", {"id":"label", "class":"ui-corner-bottom"});
			item1.append($("<a/>", {"href":"'.site_url('acl/users').'", "text":"'.$this->lang->line('users').'"}));
			item2.append($("<a/>", {"href":"'.site_url('acl/management').'", "text":"'.$this->lang->line('roles_resources_rules').'"}));
			item3.append($("<a/>", {"href":"'.site_url('acl/sessions').'", "text":"'.$this->lang->line('sessions').'"}));
			item4.append($("<a/>", {"href":"'.site_url('acl').'", "text":"'.$this->lang->line('summary').'"}));
			item5.append($("<a/>", {"href":"'.site_url('login/logout').'", "text":"'.$this->lang->line('logout').'"}));
			label.append($("<a/>", {"href":"javascript:void(0)", "text":"'.$this->lang->line('menu').'"}));
			ul.append(item1,item2,item3,item4,item5);
			content.append(ul);
			menu.append(content,label);
			
			$("#header").after(menu);
		}
		';
		
		$output = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $output);
		$output = preg_replace('/ {2,}/', ' ', $output);
		$this->output->set_content_type('js')->set_output($output);
	}
	
	public function users()
	{
		$jqgrid_name	= '#users_table';
		$navgrid_name	= '#users_navigator';
		$id_field_name	= 'user_id';
		
		$output = '
		$(document).ready(function()	{
			$("'.$jqgrid_name.'").jqGrid({
				url: "'.site_url('acl/users_load_data').'",
				datatype: "json",
				mtype: "POST",
				colNames:["'.$this->lang->line('id').'", "'.$this->lang->line('surname').'", "'.$this->lang->line('name').'", "'.$this->lang->line('email').'", "'.$this->lang->line('role').'", "'.$this->lang->line('state').'", "'.$this->lang->line('last_access').'", "'.$this->lang->line('created_by').'", "'.$this->lang->line('created_by').'"],
				colModel :[ 
					{name:"user_id", index:"user_id", hidden: true}, 
					{name:"user_profile_surname", index:"user_profile_surname"},
					{name:"user_profile_name", index:"user_profile_name"}, 
					{name:"user_profile_email", index:"user_profile_email", align:"center"},
					{name:"cizacl_role_name", index:"cizacl_role_name", align:"center"},
					{name:"user_status_name", index:"user_status_name", align:"center"},
					{name:"user_profile_lastaccess", index:"user_profile_lastaccess", align:"center"},
					{name:"user_profile_added_by", index:"user_profile_added_by", align:"center"},
					{name:"user_profile_added_by_id", index:"user_profile_added_by_id", hidden: true}
				],
				autowidth: true,
				height: "auto",
				setGridHeight: "100%",
				rowNum: 20,
				rowList:[10,20,30],
				sortname: "user_profile_surname",
				sortorder: "asc",
				viewrecords: true,
				editurl: "'.site_url('acl/users_op').'",
				pager: "'.$navgrid_name.'"
			})
			.navGrid("'.$navgrid_name.'",{edit:false, add:false, del:false},{},{},{},{closeOnEscape: true, multipleSearch:true})
			.jqGrid("sortableRows");
		});
		function view()	{
			var id	= $("'.$jqgrid_name.'").jqGrid("getGridParam","selrow");
			var row	= $("'.$jqgrid_name.'").jqGrid("getRowData",id);
			
			if(id != null)
				colorbox("/acl/user_view/"+row.'.$id_field_name.',400,400);
			else
				alert("'.$this->lang->line('select_row').'");
		}

		function add()	{
			colorbox("/acl/user_add/",440,400,null,"reloadGrid");
		}
		
		function edit()	{
			var id	= $("'.$jqgrid_name.'").jqGrid("getGridParam","selrow");
			var row	= $("'.$jqgrid_name.'").jqGrid("getRowData",id);
			
			if(id != null)
				colorbox("/acl/user_edit/"+row.'.$id_field_name.',440,400,null,"reloadGrid");
			else
				alert("'.$this->lang->line('select_row').'");
		}
		
		function del()
		{
			var id	= $("'.$jqgrid_name.'").jqGrid("getGridParam","selrow");
			var row	= $("'.$jqgrid_name.'").jqGrid("getRowData",id);
			
			if(id != null && row.user_profile_added_by_id != 0)	{
				$("'.$jqgrid_name.'").jqGrid("delGridRow",row.'.$id_field_name.');
			}
			else if(row.user_profile_added_by_id == 0)
				alert("'.$this->lang->line('system_data').'");
			else
				alert("'.$this->lang->line('select_row').'");
		}
		';
		
		$output = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $output);
		$output = preg_replace('/ {2,}/', ' ', $output);
		$this->output->set_content_type('js')->set_output($output);
	}
	
	public function sessions()
	{
		$jqgrid_name	= '#sessions_table';
		$navgrid_name	= '#sessions_navigator';
		$id_field_name	= 'session_id';
		
		$output = '
		$(document).ready(function()	{
			$("'.$jqgrid_name.'").jqGrid({
				url: "'.site_url('acl/sessions_load_data').'",
				datatype: "json",
				mtype: "POST",
				colNames:["'.$this->lang->line('user').'", "'.$this->lang->line('id').'", "'.$this->lang->line('ip_address').'", "'.$this->lang->line('user_agent').'", "'.$this->lang->line('last_activity').'"],
				colModel :[ 
					{name:"user", index:"user", sortable:false},
					{name:"session_id", index:"session_id"}, 
					{name:"ip_address", index:"ip_address", align:"center"},
					{name:"user_agent", index:"user_agent"}, 
					{name:"last_activity", index:"last_activity", align:"center"},
				],
				autowidth: true,
				height: "auto",
				setGridHeight: "100%",
				rowNum: 20,
				rowList:[10,20,30],
				sortname: "last_activity",
				sortorder: "desc",
				viewrecords: true,
				multiselect: true,
				editurl: "'.site_url('acl/sessions_op').'",
				pager: "'.$navgrid_name.'"
			})
			.navGrid("'.$navgrid_name.'",{edit:false, add:false, del:false, view:false, search:false},{},{},{},{closeOnEscape:true, multipleSearch:true})
			.jqGrid("sortableRows");
		});

		function del()
		{
			var id	= $("'.$jqgrid_name.'").jqGrid("getGridParam","selrow");
			var row	= $("'.$jqgrid_name.'").jqGrid("getRowData",id);
			
			if(id != null)
				$("'.$jqgrid_name.'").jqGrid("delGridRow",row.'.$id_field_name.');
			else
				alert("'.$this->lang->line('select_row').'");
		}
		';
		
		$output = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $output);
		$output = preg_replace('/ {2,}/', ' ', $output);
		$this->output->set_content_type('js')->set_output($output);
	}
	
	public function cizacl()
	{
		$jqgrid_name	= array('#roles_table','#resources_table','#rules_table');
		$navgrid_name	= array('#roles_navigator','#resources_navigator','#rules_navigator');
		$id_field_name	= array('cizacl_role_id','cizacl_resource_id','cizacl_rule_id');
		
		$output = '
		var jqgrid_initialized = [false, false, false];
		$(document).ready(function()	{
			$(".cizacl_tabs").tabs({
				show: function(event, ui) {
					if(ui.index == 0 && !jqgrid_initialized[0]){
						$("'.$jqgrid_name[0].'").jqGrid({
							url: "'.site_url('acl/roles_load_data').'",
							datatype: "json",
							mtype: "POST",
							colNames:["'.$this->lang->line('id').'", "'.$this->lang->line('role').'", "'.$this->lang->line('inherit_by').'", "'.$this->lang->line('redirect_to').'", "'.$this->lang->line('description').'", "'.$this->lang->line('order').'", "'.$this->lang->line('default_role').'"],
							colModel :[ 
								{name:"cizacl_role_id", index:"cizacl_role_id", hidden:true}, 
								{name:"cizacl_role_name", index:"cizacl_role_name"},
								{name:"cizacl_role_inherit_id", index:"cizacl_role_inherit_id", align:"center"},
								{name:"cizacl_role_redirect", index:"cizacl_role_redirect", align:"center"},
								{name:"cizacl_role_description", index:"cizacl_role_description"},
								{name:"cizacl_role_order", index:"cizacl_role_order", align:"center"},
								{name:"cizacl_role_default", index:"cizacl_role_default", align:"center"}
							],
							autowidth: true,
							height: "auto",
							setGridHeight: "100%",
							rowNum: 20,
							rowList:[10,20,30],
							sortname: "cizacl_role_order",
							sortorder: "asc",
							viewrecords: true,
							editurl: "'.site_url('acl/roles_op').'",
							pager: "'.$navgrid_name[0].'"
						})
						.navGrid("'.$navgrid_name[0].'",{edit:false, add:false, del:false},{},{},{},{closeOnEscape:true, multipleSearch:true})
						.jqGrid("sortableRows");
					}
					else if(ui.index == 1 && !jqgrid_initialized[1]){
						$("'.$jqgrid_name[1].'").jqGrid({
							url: "'.site_url('acl/resources_load_data').'",
							datatype: "json",
							mtype: "POST",
							colNames:["'.$this->lang->line('id').'", "'.$this->lang->line('controller').'", "'.$this->lang->line('function').'", "'.$this->lang->line('description').'", "'.$this->lang->line('created_by').'"],
							colModel :[ 
								{name:"cizacl_resource_id", index:"cizacl_resource_id", hidden:true}, 
								{name:"cizacl_resource_controller", index:"cizacl_resource_controller"},
								{name:"cizacl_resource_function", index:"cizacl_resource_function"},
								{name:"cizacl_resource_description", index:"cizacl_resource_description"},
								{name:"cizacl_resource_added_by", index:"cizacl_resource_added_by", hidden:true}
							],
							autowidth: true,
							height: "auto",
							setGridHeight: "100%",
							rowNum: 20,
							rowList:[10,20,30],
							sortname: "cizacl_resource_controller",
							sortorder: "asc",
							viewrecords: true,
							editurl: "'.site_url('acl/resources_op').'",
							pager: "'.$navgrid_name[1].'"
						})
						.navGrid("'.$navgrid_name[1].'",{edit:false, add:false, del:false},{},{},{},{closeOnEscape:true, multipleSearch:true})
						.jqGrid("sortableRows");
					}
					else if(ui.index == 2 && !jqgrid_initialized[2]){
						$("'.$jqgrid_name[2].'").jqGrid({
							url: "'.site_url('acl/rules_load_data').'",
							datatype: "json",
							mtype: "POST",
							colNames: ["'.$this->lang->line('id').'", "'.$this->lang->line('rule').'", "'.$this->lang->line('id_role').'", "'.$this->lang->line('role').'", "'.$this->lang->line('controllers').'", "'.$this->lang->line('functions').'", "'.$this->lang->line('state').'", "'.$this->lang->line('description').'"],
							colModel: [ 
								{name:"cizacl_rule_id", index:"cizacl_rule_id", hidden:true}, 
								{name:"cizacl_rule_type", index:"cizacl_rule_type"},
								{name:"cizacl_rule_cizacl_role_id", index:"cizacl_rule_cizacl_role_id", hidden:true},
								{name:"cizacl_rule_cizacl_role_name", index:"cizacl_rule_cizacl_role_id"},
								{name:"cizacl_rule_cizacl_resource_controller", index:"cizacl_rule_cizacl_resource_controller"},
								{name:"cizacl_rule_cizacl_resource_function", index:"cizacl_rule_cizacl_resource_function"},
								{name:"cizacl_rule_status", index:"cizacl_rule_status", align:"center"},
								{name:"cizacl_rule_description", index:"cizacl_rule_description"}
							],
							autowidth: true,
							height: "auto",
							setGridHeight: "100%",
							rowNum: 20,
							rowList:[10,20,30],
							sortname: "cizacl_rule_cizacl_role_id",
							sortorder: "asc",
							viewrecords: true,
							editurl: "'.site_url('acl/rules_op').'",
							pager: "'.$navgrid_name[2].'"
						})
						.navGrid("'.$navgrid_name[2].'",{edit:false, add:false, del:false},{},{},{},{closeOnEscape:true, multipleSearch:true})
						.jqGrid("sortableRows");
					}
					jqgrid_initialized[ui.index] = true;
				}
			});
		});
		
		
		function add_role()	{
			colorbox("/acl/role_add/",550,500,null,"reloadGrid");
		}
		
		function edit_role()	{
			var id	= $("'.$jqgrid_name[0].'").jqGrid("getGridParam","selrow");
			var row	= $("'.$jqgrid_name[0].'").jqGrid("getRowData",id);
			
			if(id != null)
				colorbox("/acl/role_edit/"+row.'.$id_field_name[0].',550,400,null,"reloadGrid");
			else
				alert("'.$this->lang->line('select_row').'");
		}
		
		function del_role()
		{
			var id	= $("'.$jqgrid_name[0].'").jqGrid("getGridParam","selrow");
			var row	= $("'.$jqgrid_name[0].'").jqGrid("getRowData",id);
			
			if(id != null)	{
				if(window.confirm("'.$this->lang->line('delete_data_related').'"))
					$("'.$jqgrid_name[0].'").jqGrid("delGridRow",row.'.$id_field_name[0].');
			}
			else
				alert("'.$this->lang->line('select_row').'");
		}

		function add_resource()	{
			colorbox("/acl/resource_add/",450,350,null,"reloadGrid");
		}
		
		function edit_resource()	{
			var id	= $("'.$jqgrid_name[1].'").jqGrid("getGridParam","selrow");
			var row	= $("'.$jqgrid_name[1].'").jqGrid("getRowData",id);
			
			if(id != null)
				colorbox("/acl/resource_edit/"+row.'.$id_field_name[1].',450,350,null,"reloadGrid");
			else
				alert("'.$this->lang->line('select_row').'");
		}
		
		function del_resource()
		{
			var id	= $("'.$jqgrid_name[1].'").jqGrid("getGridParam","selrow");
			var row	= $("'.$jqgrid_name[1].'").jqGrid("getRowData",id);
			
			if(id != null && row.cizacl_resource_added_by != 0)
				$("'.$jqgrid_name[1].'").jqGrid("delGridRow",row.'.$id_field_name[1].');
			else if(row.cizacl_resource_added_by == 0)
				alert("'.$this->lang->line('system_data').'");
			else
				alert("'.$this->lang->line('select_row').'");
		}

		function add_rule()	{
			colorbox("/acl/rule_add/","850","450",null,"reloadGrid");
		}
		
		function edit_rule()	{
			var id	= $("'.$jqgrid_name[2].'").jqGrid("getGridParam","selrow");
			var row	= $("'.$jqgrid_name[2].'").jqGrid("getRowData",id);
			
			if(id != null)
				colorbox("/acl/rule_edit/"+row.'.$id_field_name[2].',"850","450",null,"reloadGrid");
			else
				alert("'.$this->lang->line('select_row').'");
		}
		
		function del_rule()
		{
			var id	= $("'.$jqgrid_name[2].'").jqGrid("getGridParam","selrow");
			var row	= $("'.$jqgrid_name[2].'").jqGrid("getRowData",id);
			
			if(id != null)
				$("'.$jqgrid_name[2].'").jqGrid("delGridRow",row.'.$id_field_name[2].');
			else
				alert("'.$this->lang->line('select_row').'");
		}
		';
		
		$output = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $output);
		$output = preg_replace('/ {2,}/', ' ', $output);
		$this->output->set_content_type('js')->set_output($output);
	}
	
	public function resource_oper()
	{
		$output = '
		$(document).ready(function()	{
			$("#form1").submit(function()	{
				$("button[type=\"submit\"], input[type=\"submit\"]").attr("disabled","disabled");
				$.ajax({
					url:		"'.site_url('acl/resources_op').'",
					type:		"post",
					data:		$(this).serialize(),
					dataType:	"json",
					success:	function(data)	{
						jq_msg(data,90,5000);
						if(data.response == "success")
							setTimeout("parent.$.colorbox.close()", 3000);
						else
							$("button[type=\"submit\"], input[type=\"submit\"]").removeAttr("disabled");
					}
				});
				return false;
			});
			$("#type").change(function()	{
				getType();
			});
			$("#type").change();
		});
		
		function getType()	{
			if($("#type").val() == "controller")
				$("#tr_controller").fadeOut("fast");
			else
				$("#tr_controller").fadeIn("fast");
		}
		';
		
		$output = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $output);
		$output = preg_replace('/ {2,}/', ' ', $output);
		$this->output->set_content_type('js')->set_output($output);
	}
	
	public function user_oper()
	{
		$output = '
		$(document).ready(function()	{
			$("#form1").submit(function()	{
				$("button[type=\"submit\"], input[type=\"submit\"]").attr("disabled","disabled");
				$.ajax({
					url:		"'.site_url('acl/users_op').'",
					type:		"post",
					data:		$(this).serialize(),
					dataType:	"json",
					success:	function(data)	{
						jq_msg(data,90,5000);
						if(data.response == "success")
							setTimeout("parent.$.colorbox.close()", 3000);
						else
							$("button[type=\"submit\"], input[type=\"submit\"]").removeAttr("disabled");
					}
				});
				return false;
			});
		});
		';
		
		$output = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $output);
		$output = preg_replace('/ {2,}/', ' ', $output);
		$this->output->set_content_type('js')->set_output($output);
	}
	
	public function role_oper()
	{
		$output = '
		$(document).ready(function()	{
			$("#form1").submit(function()	{
				$("button[type=\"submit\"], input[type=\"submit\"]").attr("disabled","disabled");
				$.ajax({
					url:		"'.site_url('acl/roles_op').'",
					type:		"post",
					data:		$(this).serialize(),
					dataType:	"json",
					success:	function(data)	{
						jq_msg(data,90,5000);
						if(data.response == "success")
							setTimeout("parent.$.colorbox.close()", 3000);
						else
							$("button[type=\"submit\"], input[type=\"submit\"]").removeAttr("disabled");
					}
				});
				return false;
			});
		});
		';
		
		$output = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $output);
		$output = preg_replace('/ {2,}/', ' ', $output);
		$this->output->set_content_type('js')->set_output($output);
	}

	public function rule_oper()
	{
		$output = '
		var array_idx = 1, array_ctrlr_idx = 1, array_fncn_idx = 1, ctrlr_options = "", fncn_options = "";
		$(document).ready(function()	{
			getControllers();
			
			$("#form1").submit(function()	{
				$("button[type=\"submit\"], input[type=\"submit\"]").attr("disabled","disabled");
				$.ajax({
					url:		"'.site_url("acl/rules_op").'",
					type:		"post",
					data:		$(this).serialize(),
					dataType:	"json",
					success:	function(data)	{
						jq_msg(data,90,5000);
						if(data.response == "success")
							setTimeout("parent.$.colorbox.close()", 3000);
						else
							$("button[type=\"submit\"], input[type=\"submit\"]").removeAttr("disabled");
					}
				});
				return false;
			});
			
		});
		function getControllers()	{
			$.ajax({
				url:		"'.site_url("acl/getControllers").'",
				type:		"post",
				dataType:	"json",
				success:	function(data)	{
					if(data.response == true)	{
						var options = "";
						for(var i = 0; i < (data.rows).length; i++)	{
							options += "<option value=\""+data.rows[i]["value"]+"\">"+data.rows[i]["name"]+"</option>";
						}
					}
					ctrlr_options = options;
					getFunctions();
				}
			});
			return true;
		}
		function getFunctions()	{
			$.ajax({
				url:		"'.site_url("acl/getFunctions").'",
				type:		"post",
				dataType:	"json",
				success:	function(data)	{
					if(data.response == true)	{
						var options = "";
						for(var i = 0; i < (data.rows).length; i++)	{
							options += "<option value=\""+data.rows[i]["value"]+"\">"+data.rows[i]["name"]+"</option>";
						}
					}
					fncn_options = options;
					if($("input[name=\"oper\"]").val() == "edit") getRules();
				}
			});
			return true;
		}
		function getRules()	{
			$.ajax({
				url:		"'.site_url("acl/getRules").'/"+$("#cizacl_role_id").val(),
				type:		"post",
				dataType:	"json",
				success:	function(data)	{
					var i, j, controllers, functions;
					if(data.response == "success")	{
						for(i = 0; i < (data.rows).length; i++)	{
							controllers	= $.parseJSON(data.rows[i]["cizacl_rule_cizacl_resource_controller"]).toString();
							controllers	= controllers.split(/,/);
							functions	= $.parseJSON(data.rows[i]["cizacl_rule_cizacl_resource_function"]).toString();
							functions	= functions.split(/,/);
							addRule(data.rows[i]["cizacl_rule_type"],controllers[0],functions[0],data.rows[i]["cizacl_rule_status"],data.rows[i]["cizacl_rule_description"]);
							for(j = 1; j < controllers.length; j++)	{
								if(controllers[j] == null) controllers[j] = "NULL";
								addController(array_idx-1,array_ctrlr_idx,controllers[j]);
							}
							for(j = 1; j < functions.length; j++)	{
								if(functions[j] == null) functions[j] = "NULL";
								addFunction(array_idx-1,array_fncn_idx,functions[j]);
							}
						}
					}
					else
						jq_msg(data, 65, 3000);
				}
			});
		}
		function addRule(rule_input,controllers_input,functions_input,state_input,description_input)	{
			if(rule_input == null) rule_input = "allow";
			if(controllers_input == null) controllers_input = "NULL";
			if(functions_input == null) functions_input = "NULL";
			if(state_input == null) state_input = "1";
			if(description_input == null) description_input	= "";
			
			main							= $("<tr/>", {"id":"rule_"+array_idx});
				this.td1					= $("<td/>", {"valign":"top"});
				this.td2					= $("<td/>", {"valign":"top"});
				this.td3					= $("<td/>", {"valign":"top", "style":"padding-bottom: 20px"});
				this.td31					= $("<td/>", {"valign":"top","width":"60"});
				this.td32					= $("<td/>", {"valign":"top"});
				this.td4					= $("<td/>", {"valign":"top", "style":"padding-bottom: 20px"});
				this.td41					= $("<td/>", {"valign":"top","width":"60"});
				this.td42					= $("<td/>", {"valign":"top"});
				this.td5					= $("<td/>", {"valign":"top"});
				this.td6					= $("<td/>", {"valign":"top"});
				
				this.del_rule				= $("<button/>", {"type":"button","onclick":"delRule("+array_idx+")", "title":"'.$this->lang->line("del").'"});
				this.del_rule.text("'.$this->lang->line("del").'").button({icons: {primary: "ui-icon-trash"},text: false});
				
				this.rules					= $("<select/>", {"name":"type["+array_idx+"]", "id":"type["+array_idx+"]"});
				this.rules_opt1				= $("<option/>", {"value":"allow"});
				this.rules_opt1.text("'.$this->lang->line("allow").'");
				this.rules_opt2				= $("<option/>", {"value":"deny"});
				this.rules_opt2.text("'.$this->lang->line("deny").'");
				
				this.table_controller		= $("<table/>", {"width":"100%", "cellpadding":"0", "cellspacing":"0", "id":"controller_"+array_idx+"_table"});
				this.tbody_controller		= $("<tbody/>");
				this.tr_controller			= $("<tr/>", {"id":"ctrlr_"+array_ctrlr_idx});
				this.add_controller			= $("<button/>", {"type":"button","onclick":"addController("+array_idx+","+array_ctrlr_idx+")", "title":"'.$this->lang->line("add").'"});
				this.add_controller.text("'.$this->lang->line("add").'").button({icons: {primary: "ui-icon-plus"},text: false});
				this.controllers			= $("<select/>", {"name":"controller["+array_idx+"][]", "id":"controller["+array_idx+"]["+array_ctrlr_idx+"]"});
				this.controllers.html(ctrlr_options).val(controllers_input);
		
				this.table_function			= $("<table/>", {"width":"100%", "cellpadding":"0", "cellspacing":"0", "id":"function_"+array_idx+"_table"});
				this.tbody_function			= $("<tbody/>");
				this.tr_function			= $("<tr/>", {"id":"fncn_"+array_fncn_idx});
				this.add_function			= $("<button/>", {"type":"button","onclick":"addFunction("+array_idx+","+array_fncn_idx+")", "title":"'.$this->lang->line("add").'"});
				this.add_function.text("'.$this->lang->line("add").'").button({icons: {primary: "ui-icon-plus"},text: false});
				this.functions 			= $("<select/>", {"name":"function["+array_idx+"][]", "id":"function["+array_idx+"]["+array_fncn_idx+"]"});
				this.functions.html(fncn_options).val(functions_input);
				
				this.state					= $("<select/>", {"name":"status["+array_idx+"]", "id":"status["+array_idx+"]"});
				this.status_opt1			= $("<option/>", {"value":"1"});
				this.status_opt1.text("'.$this->lang->line("enabled").'");
				this.status_opt2			= $("<option/>", {"value":"0"});
				this.status_opt2.text("'.$this->lang->line("disabled").'");
				this.state.val(state_input);
				
				this.description			= $("<input/>", {"name":"description["+array_idx+"]", "type":"text", "id":"description["+array_idx+"]", "size":"40", "maxlength":"255"});
				this.description.val(description_input);
			
			this.td1.append(this.del_rule);
			main.append(this.td1);
			
			this.rules.append(this.rules_opt1,this.rules_opt2).val(rule_input);
			this.td2.append(this.rules);
			main.append(this.td2);
			
			this.td31.append(this.add_controller);
			this.td32.append(this.controllers);
			this.tr_controller.append(this.td31,this.td32);
			this.tbody_controller.append(this.tr_controller);
			this.table_controller.append(this.tbody_controller);
			this.td3.append(this.table_controller);
			main.append(this.td3);
			
			this.td41.append(this.add_function);
			this.td42.append(this.functions);
			this.tr_function.append(this.td41,this.td42);
			this.tbody_function.append(this.tr_function);
			this.table_function.append(this.tbody_function);
			this.td4.append(this.table_function);
			main.append(this.td4);
			
			this.state.append(this.status_opt1,this.status_opt2).val(state_input);
			this.td5.append(this.state);
			main.append(this.td5);
			
			this.td6.append(this.description);
			main.append(this.td6);
			
			$("#rules > tbody:last").append(main);
			inputs_style();
			
			array_idx++;
			array_ctrlr_idx++;
			array_fncn_idx++;
		}
		function addController(idx,ctrlr_idx,controllers_input)	{
			if(controllers_input == null) controllers_input = "NULL";
			ctrlr_idx++;
			
			controllers			= $("<tr/>", {"id":"ctrlr_"+ctrlr_idx});
				this.td1		= $("<td/>", {"width":"60"});
				this.td2		= $("<td/>");
				this.add		= $("<button/>", {"type":"button","onclick":"addController("+idx+","+ctrlr_idx+")", "title":"'.$this->lang->line("add").'"});
				this.add.text("'.$this->lang->line("add").'").button({icons: {primary: "ui-icon-plus"},text: false});
				this.del		= $("<button/>", {"type":"button","onclick":"delController("+ctrlr_idx+")", "title":"'.$this->lang->line("del").'"});
				this.del.text("'.$this->lang->line("del").'").button({icons: {primary: "ui-icon-trash"},text: false});
				this.controller	= $("<select/>", {"id":"controller["+idx+"]["+ctrlr_idx+"]", "name":"controller["+idx+"][]"});
				this.controller.html(ctrlr_options).val(controllers_input);
			
			this.td1.append(this.add,this.del);
			controllers.append(this.td1);
			
			this.td2.append(this.controller);
			controllers.append(this.td2);
			
			$("#controller_"+idx+"_table > tbody:last").append(controllers);
			inputs_style();
			array_ctrlr_idx++;
		}
		function addFunction(idx,fncn_idx,functions_input)	{
			if(functions_input == null) functions_input = "NULL";
			fncn_idx++;
			
			functions			= $("<tr/>", {"id":"fncn_"+fncn_idx});
				this.td1		= $("<td/>", {"width":"60"});
				this.td2		= $("<td/>");
				this.add		= $("<button/>", {"type":"button","onclick":"addFunction("+idx+","+fncn_idx+")", "title":"'.$this->lang->line("add").'"});
				this.add.text("'.$this->lang->line("add").'").button({icons: {primary: "ui-icon-plus"},text: false});
				this.del		= $("<button/>", {"type":"button","onclick":"delFunction("+fncn_idx+")", "title":"'.$this->lang->line("del").'"});
				this.del.text("'.$this->lang->line("del").'").button({icons: {primary: "ui-icon-trash"},text: false});
				this.fn	= $("<select/>", {"id":"function["+idx+"]["+fncn_idx+"]", "name":"function["+idx+"][]"});
				this.fn.html(fncn_options).val(functions_input);
			
			this.td1.append(this.add,this.del);
			functions.append(this.td1);
			
			this.td2.append(this.fn);
			functions.append(this.td2);
			
			$("#function_"+idx+"_table > tbody:last").append(functions);
			inputs_style();
			
		}
		function delRule(idx)	{
			$("#rule_"+idx).remove();
		}
		function delController(ctrlr_idx)	{
			$("#ctrlr_"+ctrlr_idx).remove();
		}
		function delFunction(fncn_idx)	{
			$("#fncn_"+fncn_idx).remove();
		}
		';
		
		$output = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $output);
		$output = preg_replace('/ {2,}/', ' ', $output);
		$this->output->set_content_type('js')->set_output($output);
	}

	
}