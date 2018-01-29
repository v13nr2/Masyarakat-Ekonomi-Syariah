<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu">
	      <?php
		      $main = $this->db->get_where('tbl_menu', array('parent' => 0));
				foreach ($main->result() as $m) {
		          $sub = $this->db->get_where('tbl_menu', array('parent' => $m->id_menu));
		          if ($sub->num_rows() > 0) {
		              $uri = $this->uri->segment(1);
		              $idclass = $this->db->get_where('tbl_menu', array('link' => $uri))->row_array();
		              if ($m->id_menu == $idclass['parent']) {
		                  $class = "active treeview";
		              } else {
		                  $class = "";
		              }
		              echo '<li class=' . $class . '>' . anchor($m->link, '<i class="' . $m->icon . '"></i>' . strtoupper($m->nama_menu) . '
		              <span class="pull-right-container">
		                <i class="fa fa-angle-left pull-right"></i>
		              </span>');
		              echo "<ul class='treeview-menu'>";
		              foreach ($sub->result() as $s) {
		                  $uri = $this->uri->segment(1);
		                  if ($s->link == $uri) {
		                      $class1 = "active treeview";
		                  } else {
		                      $class1 = "";
		                  }
		                  echo '<li class=' . $class1 . '>' . anchor($s->link, '<i class="' . $s->icon . '"></i>' . strtoupper($s->nama_menu)) . '</li>';
		              }
		              echo "</ul>";
		              echo '</li>';
		          } else {
		              $uri = $this->uri->segment(1);
		              if ($m->link == $uri) {
		                  $class2 = "active";
		              } else {
		                  $class2 = "";
		              }
		              echo '<li class=' . $class2 . '>' . anchor($m->link, '<i class="' . $m->icon . ' fa-lg"></i>' . strtoupper($m->nama_menu)) . '</li>';
		          }
		      }
			?>
		</ul>
</aside>
