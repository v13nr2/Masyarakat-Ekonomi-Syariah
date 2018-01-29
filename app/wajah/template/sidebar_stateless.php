
<script>
// http://stackoverflow.com/questions/12733238/retain-twitter-bootstrap-collapse-state-on-page-refresh-navigation

//$(document).ready(function () {
  //when a group is shown, save it as the active accordion group
$('#nng-menu1').click(function ()
{
    var active = $(this).attr('id');
    $.cookie('activePanelGroup', active);
    alert(active);
});

$(".panel .panel-collapse").on('hidden.bs.collapse', function ()
{
    $.removeCookie('activePanelGroup');
});

var last = $.cookie('activePanelGroup');
if (last != null)
{
    //remove default collapse settings
    $(".panel .panel-collapse").removeClass('in');
    //show the account_last visible group
    $("#" + last).addClass("in");
}
//});
</script>
<div id="sidebar-menu"	class="main_menu_side hidden-print main_menu">
<div class="menu_section">
<aside class="main-sidebar">
	<section class="sidebar">
		<div id="accordion" class="panel panel-group" role="tablist">
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
		      <h4 class="panel-title">
		        <a class="" id="nng-menu1" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseListGroup1" aria-expanded="true" aria-controls="collapseListGroup1"><font color="#41423d">PARAMETER</font></a>
		      </h4>
		    </div>
		    <div id="collapseListGroup1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseListGroupHeading1" aria-expanded="true">
		      <ul class="list-group">
		        <li class="list-group-item"><a href="http://localhost/akuntansi/akutansi_simple/Bank"><font color="#6c6d69">&nbsp; - One itmus ac facilin</font></a></li>
		        <li class="list-group-item"><font color="#6c6d69">&nbsp; - One itmus ac facilin</font></li>
		        <li class="list-group-item"><font color="#6c6d69">&nbsp; - One itmus ac facilin</font></li>
		      </ul>
		    </div>
		  </div>

		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="collapseListGroupHeading2">
		      <h4 class="panel-title">
		        <a class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseListGroup2" aria-expanded="true" aria-controls="collapseListGroup2"><font color="#41423d">DATA INDUK</font></a>
		      </h4>
		    </div>
		    <div id="collapseListGroup2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2" aria-expanded="true">
		      <ul class="list-group">
		        <li class="list-group-item" class="active"><a href="http://localhost/akuntansi/akutansi_simple/Bank">Bootply</a></li>
		        <li class="list-group-item">One itmus ac facilin</li>
		        <li class="list-group-item">Second eros</li>
		      </ul>
		    </div>
		  </div>

		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="collapseListGroupHeading3">
		      <h4 class="panel-title">
		        <a class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseListGroup3" aria-expanded="true" aria-controls="collapseListGroup3"><font color="#41423d">SETTING</font></a>
		      </h4>
		    </div>
		    <div id="collapseListGroup3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading3" aria-expanded="true">
		      <ul class="list-group">
		        <li class="list-group-item">Bootply</li>
		        <li class="list-group-item">One itmus ac facilin</li>
		        <li class="list-group-item">Second eros</li>
		      </ul>
		    </div>
		  </div>
		</div>
	</section>
</aside>
</div>
</div>