<style>
#tetangga{
	bottom : 20px;
	position : fixed;
	width : 200px;
	background : yellow;
	padding : 5px 5px 5px 5px;	
}

ul{
    list-style:none;
}
</style>

<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?=base_url().'/images/'.$this->session->userdata('depe');?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?=$this->session->userdata('nama');?></p>
				<!-- Status
				<a href="#"><i class="glyphicon glyphicon-check"></i> Online</a>-->
			</div>
		</div>
		
		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">MENU</li>
			<!-- Optionally, you can add icons to the links 
			<li class="active"><a href=""><i class="glyphicon glyphicon-list"></i> <span>Daftar User</span></a></li>
			<li><a href=""><i class="glyphicon glyphicon-plus"></i> <span>Add User</span></a></li>-->

			<li class="treeview">		
			<!--<a href='#'><i class='glyphicon glyphicon-record'></i> <span>XXXX</span> <i class='glyphicon glyphicon-chevron-down'></i></a>
			<ul class='treeview-menu'>
			<li><a href='#'>YYYY</a></li>
			</ul>-->

			<?php
			// data main menu
			// $main_menu = $this->db->get_where('tabel_menu', array('is_main_menu' => 0));
			// foreach ($main_menu->result() as $main) {
				
			foreach($menunye as $main){
				// Query untuk mencari data sub menu
				if($this->session->userdata['role'] == "2"){
					/* Menu Arsiparis */
					$sub_menu = $this->db->query("SELECT * FROM tb_menu WHERE id_parent = '".$main->id_menu."' AND aktif = '1' AND admin = '1' ORDER BY CAST(id_parent AS UNSIGNED),CAST(id_menu AS UNSIGNED)");
				}elseif($this->session->userdata['role'] == "3"){
					/* Menu Peminjam */
					$sub_menu = $this->db->query("SELECT * FROM tb_menu WHERE id_parent = '".$main->id_menu."' AND aktif = '1' AND admin = '0' ORDER BY CAST(id_parent AS UNSIGNED),CAST(id_menu AS UNSIGNED)");
				}
				// periksa apakah ada sub menu
				if ($sub_menu->num_rows() > 0) {
					// main menu dengan sub menu
					echo "<li class='treeview'><a href='".base_url().$main->tautan."'><i class='".$main->ikon."'></i><span>".$main->menu."</span><span>&nbsp;</span><span class='glyphicon glyphicon-chevron-down pull-right-container'></a>";
					
					// sub menu nya disini
					echo "<ul class='treeview-menu'>";
					foreach ($sub_menu->result() as $sub) {
						// echo "<li>" . anchor($sub->tautan, '<i></i>' . $sub->menu) . "</li>";
						if($sub->menu == "BACKUP DATABASE"){
							echo "<li><a href='".base_url().$sub->tautan."' onclick='return confirm(\"Yakin backup database ?\")'>".$sub->menu."</a></li>";
						}else{
							echo "<li><a href='".base_url().$sub->tautan."'>".$sub->menu."</a></li>";
						}
					}
					echo"</ul></li>";
				} else {
					// main menu tanpa sub menu
					echo "<li><a href='".base_url().$main->tautan."'><i class='".$main->ikon."'></i><span>".$main->menu."</span></a></li>";
				}
			}
			?>
			</li>
		</ul><!-- /.sidebar-menu -->
	  
	</section>
	<!-- /.sidebar -->


</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!--
<section class="content-header">
	<h1>
		<small></small>
	</h1>
</section>
-->
<!-- Main content -->
<section class="content">