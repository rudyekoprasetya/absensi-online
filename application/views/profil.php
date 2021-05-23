<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-table"></i> <?php echo $judul; ?></h3>
</div>

<div class="panel-body">
  <div class="row">
  	<div class="col-lg-12">
	  <?php if($this->session->flashdata('alert')){ ?>
	    <div class="alert alert-warning alert-dismissable">
	      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	      <?= $this->session->flashdata('alert'); ?>
	    </div>
	  <?php } ?>
 <form method="POST" action="<?= site_url('login/ubah_profil');?>">
<?php foreach ($user->result() as $row) { ?>
	  	<label>Email</label>
	  	<input type="hidden" name="id_user" value="<?= $row->id_user;?>">
		<input type="text" class="form-control" id="email" name="email" value="<?= $row->email;?>" readonly>
	  	<label>Password</label>
		<input type="password" class="form-control" id="password" name="password">
		<br>
		<button type="submit" class="btn btn-success " ><i class="fa fa-save"></i> SIMPAN</button>
<?php } ?>
</form>  	
  	</div>
  </div>
</div>