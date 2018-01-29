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


class Login_Js extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('cizacl',$this->config->item('language'));
	}
	
	public function scripts()
	{
		$output = '
		$(document).ready(function()	{
			$("#form1").submit(function()	{
				$.ajax({
					url: 		"'.site_url('login/check_login').'",
					type:		"post",
					data:		$(this).serialize(),
					dataType:	"json",
					success:	function(data)	{
						jq_msg(data,70,5000);
						if(data.response == "success")
							setTimeout("window.location =\""+data.more+"\"", 3000);
						else
							$("#content-login").effect("shake",null,"fast");
					}
					
				});
				return false;
			});
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
			$(".cizacl_btn_check").button({
				icons: {
					primary: "ui-icon-check"
				}
			});
			$(".cizacl_btn_reset").button({
				icons: {
					primary: "ui-icon-arrowreturnthick-1-w"
				}
			});
			
			$("input, button, textarea, select").addClass("ui-corner-all");
		});
		function jq_msg(data, scrollTopValue, TimeoutValue)	{
			$("html,body").animate({scrollTop: scrollTopValue},"slow");
			$("#jq_msg").html(data.msg).slideDown("slow");
			if(TimeoutValue > 0)
				setTimeout("$(\"#jq_msg\").slideUp(\"slow\")", TimeoutValue);
		}
		';
		
		$output = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $output);
		$output = preg_replace('/ {2,}/', ' ', $output);
		$this->output->set_content_type('js')->set_output($output);
	}
}