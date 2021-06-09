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
	        <th>Tipe Absen</th>
	        <th>Hari</th>
	        <th>Tanggal</th>
	        <th>Waktu</th>
	        <th>Absen</th>
	        <th>Ket</th>
	        <th>Lokasi</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td>-</td>
	        <td>-</td>
	        <td>-</td>
	        <td>-</td>
	        <td>-</td>
	        <td>-</td>
	        <td>-</td>
	        <td>-</td>
	        <td>
	        	<button class="btn btn-success btn-small"><i class="fa fa-map-marker"></i></button>
	        </td>
	      </tr>
	    </tbody>
	  </table>
  	</div>
  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lokasi Absen</h4>
      </div>
      <div class="modal-body">
      	<div id="maps-absen" style="height: 250px; width: 100%;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
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
		a+='<table class="table table-bordered tablesorter">';
		    a+='<thead>';
		      a+='<tr>';
		        a+='<th>#</th>';
		        a+='<th>Nama</th>';
		        a+='<th>Tipe Absen</th>';
		        a+='<th>Hari</th>';
		        a+='<th>Tanggal</th>';
		        a+='<th>Waktu</th>';
		        a+='<th>Absen</th>';
		        a+='<th>Ket</th>';
		        a+='<th>Lokasi</th>';
		      a+='</tr>';
		    a+='</thead>';
		    a+='<tbody>';
		let no=0;
		$('#tempat_report').hide();
		$.ajax({
				method: 'GET',
				url: '<?= site_url('api/reportabsen');?>?apikey=92d639339020f1b481b4faecb68f15c6ac55cf16',
				data: {
					id_user:id_user,
					awal:awal,
					akhir:akhir
				},
				dataType: 'json',
				success: function(result) {
					$.each(result.data, function(index,value){
						no++;
						let ket='';
						if(value.waktu<=value.default_waktu) {
							ket='Tepat';
						} else {
							ket='Terlambat';
						}
						a+='<tr>';
			        a+='<td>'+no+'</td>';
			        a+='<td>'+value.nama+'</td>';
			        a+='<td>'+value.tipe_absen+'</td>';
			        a+='<td>'+value.hari+'</td>';
			        a+='<td>'+value.tanggal+'</td>';
			        a+='<td>'+value.waktu+'</td>';
			        a+='<td>'+value.status+'</td>';
			        a+='<td>'+ket+'</td>';
			        a+='<td>';
			        	a+='<button class="btn btn-success btn-small" data-toggle="modal" data-target="#myModal" onclick="showMap('+value.lat+', '+value.lng+')"><i class="fa fa-map-marker"></i></button>';
			        a+='</td>';
			      a+='</tr>';
					});

						    a+='</tbody>';
				  a+='</table>';
				  a+='<p><a href="<?= site_url("report/xlsabsen")?>?id_user='+id_user+'&awal='+awal+'&akhir='+akhir+'" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Export Excel</a></p>';
					$('#tempat_report').html(a);
					$('#tempat_report').fadeIn(500);
				}, error: function(err) {
					alert('Maaf Ada kesalahan sistem!' + err);
				}
			});
	}

	function showMap(lat,lng) {
		map.setView([lat, lng], 15);
	   //geocoder
	   let geocodeService = L.esri.Geocoding.geocodeService({
	     apikey: 'AAPK3a0ab55b2a8a4b1e845509869a0ca3247H2doS3cks4epzzfxT6qIYuMBRXHoPWZrgsoqA6aZiwWLIjQF0KFCqv4DSbgat8I'
	   });

	   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {    attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);
	   L.esri.basemapLayer('Streets').addTo(map);

	   //tampilkan alamat
	   geocodeService.reverse().latlng([lat, lng]).run(function (error, result) {
	    if (error) {
	      return;
	    }
	    // console.log(result);
	    L.marker(result.latlng).addTo(map).bindPopup(result.address.Match_addr).openPopup();
		});
	}
</script>