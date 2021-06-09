<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> <?= $judul; ?></h3>
</div>

<div class="panel-body">
  <div class="row">
  	<div class="col-lg-4">
  		<input type="date" name="awal" class="form-control awal" placeholder="tanggal awal">
  	</div>
  	<div class="col-lg-4">
  		<input type="date" name="akhir" class="form-control akhir" placeholder="tanggal akhir">
  	</div>
  	<div class="col-lg-4">
  		<select class="form-control user" onchange="cariReport()">
  			<option>-- Pilih User--</option>
<?php foreach($user as $row) { ?>
  			<option value="<?= $row->id_user?>"><?= $row->nama ?></option>
<?php } ?>
  		</select>
  	</div>
  </div>
  <hr>
  <div class="row">
  	<div class="col-lg-12 table-responsive" id="tempat_report">
  		<table class="table table-bordered">
	    <thead>
	      <tr>
	        <th>#</th>
	        <th>Nama</th>
	        <th>Tanggal</th>
	        <th>Alasan</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td>-</td>
	        <td>-</td>
	        <td>-</td>
	        <td>-</td>
	      </tr>
	    </tbody>
	  </table>
  	</div>
  </div>
</div>

<script type="text/javascript">
	var map = L.map('maps-absen');

	function cariReport() {
		let id_user=$('.user').val();
		let awal=$('.awal').val();
		let akhir=$('.akhir').val();
		// console.log(id_user);
		let a='';
		a+='<table class="table table-bordered">';
		    a+='<thead>';
		      a+='<tr>';
		        a+='<th>#</th>';
		        a+='<th>Nama</th>';
		        a+='<th>Waktu</th>';
		        a+='<th>Alasan</th>';
		      a+='</tr>';
		    a+='</thead>';
		    a+='<tbody>';
		let no=0;
		$('#tempat_report').hide();
		$.ajax({
				method: 'GET',
				url: '<?= site_url('api/reportizin');?>?apikey=92d639339020f1b481b4faecb68f15c6ac55cf16',
				data: {
					id_user:id_user,
					awal:awal,
					akhir:akhir
				},
				dataType: 'json',
				success: function(result) {
					$.each(result.data, function(index,value){
						no++;						
						a+='<tr>';
			        a+='<td>'+no+'</td>';
			        a+='<td>'+value.nama+'</td>';
			        a+='<td>'+value.tanggal+'</td>';
			        a+='<td>'+value.alasan+'</td>';
			      a+='</tr>';
					});

						    a+='</tbody>';
				  a+='</table>';
				  a+='<p><button class="btn btn-success"><i class="fa fa-print"></i> Export Excel</button></p>';
					$('#tempat_report').html(a);
					$('#tempat_report').fadeIn(500);
				}, error: function(err) {
					alert('Maaf Ada kesalahan sistem!' + err);
				}
			});
	}

</script>