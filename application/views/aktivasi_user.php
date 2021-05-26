<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-table"></i> <?= $judul; ?></h3>
</div>

<div class="panel-body">
  <div class="row">
  	<div class="col-lg-12">
  		<?php if($this->session->flashdata('alert')){ ?>
		    <div class="alert alert-success alert-dismissable">
		      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		      <?= $this->session->flashdata('alert'); ?>
		    </div>
	  	<?php } ?>
	  	<form method="POST" action="<?php echo site_url('admin/searchuser'); ?>"> 	
			<div class="form-group input-group">
		        <input type="text" class="form-control" placeholder="Masukan Email" name="key" id="key">
		        <span class="input-group-btn">
		          <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
		        </span>
		    </div>
		</form>	
  	</div>
  </div>
  <div class="row">
	<hr>
  </div>
  <div class="row">
  	<div class="col-lg-12">
  		<table class="table table-striped">
		    <thead>
		      <tr>
		        <th>#</th>
		        <th>Email</th>
		        <th>Nama</th>
		        <th>Gender</th>
		        <th>HP</th>
		        <th>Jenis</th>
		        <th>Is Login</th>
		        <th>Activate</th>
		      </tr>
		    </thead>
		    <tbody>
<?php if(isset($user)) {?>
	<?php 
	$no=0;
	foreach ($user->result_array() as $row) { 
	$no++;
	?>
		<tr>
			<td><?=$no;?></td>	
			<td><?=$row['email'];?></td>	
			<td><?=$row['nama'];?></td>	
			<td><?=$row['gender'];?></td>	
			<td><?=$row['hp'];?></td>	
			<td><?=$row['jenis'];?></td>	
			<td><?=$row['is_login'];?></td>	
			<td><a href="<?= site_url('admin/activated/'.$row['id_user']); ?>" class="btn btn-primary btn-small" onclick="return confirm('Aktifkan User ini?')"><i class="fa fa-check-square"></i></a></td>
		</tr>
	<?php } ?>
<?php } ?>
		    </tbody>
	  	</table>
  	</div>
  </div>
</div>