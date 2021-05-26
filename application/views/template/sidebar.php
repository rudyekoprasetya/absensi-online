<?php 
$akses=$this->session->userdata('akses');
?>

<ul class="nav navbar-nav side-nav">
<?php if($akses=='admin') {?>
          <li><a href="<?=site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a href="<?=site_url('admin/jenis') ?>"><i class="fa fa fa-user-md"></i> Jenis User</a></li>
          <li><a href="<?= site_url('admin/status') ?>"><i class="fa fa-calendar"></i> Status Absen</a></li>
          <li><a href="<?= site_url('admin/tipe') ?>"><i class="fa fa-gears"></i> Tipe Kerja</a></li>
          <li><a href="<?= site_url('admin/user') ?>"><i class="fa fa-users"></i> User</a></li>
          <li><a href="<?= site_url('admin/useractivation') ?>"><i class="fa fa-check-square"></i> Aktivasi User</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Laporan <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#"><i class="fa fa-book"></i> Absensi</a></li>
          <li><a href="#"><i class="fa fa-book"></i> Rekapitulasi</a></li>
        </ul>
   </li>
      <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Admin Menu <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="<?= site_url('login/profil') ?>"><i class="fa fa-lock"></i> Ubah Password</a></li>
        <li><a href="<?= site_url('login/logout') ?>" onclick="return confirm('Yakin Mau Keluar?');"><i class="fa fa-sign-out"></i> Log Out</a></li>
      </ul>
    </li>
<?php } else if($akses=='user') {?>

    <li><a href="<?= site_url('admin/user') ?>"><i class="fa fa-users"></i> Pengguna</a></li>           
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> User Menu <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="<?= site_url('login/profil') ?>"><i class="fa fa-lock"></i> Ubah Password</a></li>
        <li><a href="<?= site_url('login/logout') ?>" onclick="return confirm('Yakin Mau Keluar?');"><i class="fa fa-sign-out"></i> Log Out</a></li>
      </ul>
    </li>
<?php } ?>
</ul>