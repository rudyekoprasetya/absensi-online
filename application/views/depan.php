<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-table"></i> <?= $judul; ?></h3>
</div>

<div class="panel-body">
	<div class="row">
		<div class="col-lg-12">
			<div class="jumbotron">
			  <h1>Selamat Datang!</h1>
			  <p>Aplikasi Mengelola Absensi Karyawan dan Magang Berbasis Lokasi dan Mobile Apps</p>
			</div>
		</div>
	</div>
  <div class="row">

  	<div class="col-lg-4">
  		<div class="panel panel-success">
			  <div class="panel-heading">
			    <h3 class="panel-title"><i class="fa fa-users"></i> Jumlah User</h3>
			  </div>
			  <div class="panel-body">
			    <h2><?= $user; ?> User</h2>
			  </div>
			</div>
  	</div>

  	<div class="col-lg-4">
  		<div class="panel panel-warning">
			  <div class="panel-heading">
			    <h3 class="panel-title"><i class="fa fa-calendar"></i> Jumlah Absen</h3>
			  </div>
			  <div class="panel-body">
			    <h2><?= $absensi; ?> Absen</h2>
			  </div>
			</div>
  	</div>

  	<div class="col-lg-4">
  		<div class="panel panel-danger">
			  <div class="panel-heading">
			    <h3 class="panel-title"><i class="fa fa-tags"></i> Jumlah Izin</h3>
			  </div>
			  <div class="panel-body">
			    <h2><?= $izin; ?> Izin</h2>
			  </div>
			</div>
  	</div>


	</div>
</div>