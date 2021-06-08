<div class="panel-heading">
	<h3 class="panel-title"><i class="fa fa-table"></i> <?= $judul; ?></h3>
</div>

<div class="panel-body">
  <div class="row">
  	<div class="col-lg-12">
  		 <div class="form-group">
<?php foreach($user as $row ) { ?>
				<input type="hidden" name="id_user" id="id_user" value="<?=$row->id_user ?>">
  		 	<label>Nama</label>
  		 	<input type="text" class="form-control" name="nama" id="nama" readonly value="<?=$row->nama ?>">
  		 </div>
  		 <div class="form-group">
  		 	<label>Email</label>
  		 	<input type="text" class="form-control" name="email" id="email" value="<?=$row->email ?>" readonly>
  		 </div>
<?php } ?>
  		 <div class="form-group">
			  <label for="tipe_kerja">Tipe Kerja</label>
			  <select class="form-control" id="tipe_kerja" name="tipe_kerja">
<?php foreach($tipe as $row ) { ?>			  	
			    <option value="<?= $row->id_tipe; ?>"><?= $row->tipe_absen; ?></option>
<?php } ?>
			  </select>
			 </div> 
			 <div class="form-group">
			  <label for="status">Status Absesn</label>
			  <select class="form-control" id="status" name="status">
<?php foreach($status as $row ) { ?>			  	
			    <option value="<?= $row->id_status; ?>"><?= $row->status; ?></option>
<?php } ?>
			  </select>
			 </div>
  	</div>
  	<hr>
  	<div class="col-lg-12">
  		<div class="panel panel-info">
  			<div class="panel-heading">
  				Lokasi Absensi
  			</div>
  			<div class="panel-body" id="maps">
  				maps disini
  			</div>
  		</div>
  	</div>

  	<div class="col-lg-12">
  		<button class="btn btn-block btn-danger" id="absen-sekarang" onclick="absenSekarang()">Absen Sekarang</button>
  	</div>
  </div>
</div>

<script type="text/javascript">
	var lng='';
	var lt='';
	navigator.geolocation.watchPosition(function(res){
		// alert('lokasi '+res.coords.latitude+', '+res.coords.longitude);	
		 let lokasi=[res.coords.latitude, res.coords.longitude];
		 lng=res.coords.longitude;
		 lt=res.coords.latitude;
	   let map = L.map('maps').setView(lokasi, 15);

	   //geocoder
	   let geocodeService = L.esri.Geocoding.geocodeService({
	     apikey: 'AAPK3a0ab55b2a8a4b1e845509869a0ca3247H2doS3cks4epzzfxT6qIYuMBRXHoPWZrgsoqA6aZiwWLIjQF0KFCqv4DSbgat8I'
	   });

	   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {    attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);
	   L.esri.basemapLayer('Streets').addTo(map);

	   //tampilkan alamat
	   geocodeService.reverse().latlng(lokasi).run(function (error, result) {
	    if (error) {
	      return;
	    }
	    // console.log(result);
	    L.marker(result.latlng).addTo(map).bindPopup(result.address.Match_addr).openPopup();
	   },
	   function(error){
	   	alert(error.code);
	   });



	});

	function absenSekarang(){
		var r = confirm("Yakin data sudah benar?");
		if (r == true) {			
			let id_user=$('#id_user').val();
			let id_tipe=$('#tipe_kerja').val();
			let id_status=$('#status').val();
			let long=lng;
			let lat=lt;
			$.ajax({
				method: 'POST',
				url: '<?= site_url('api/absensi');?>?apikey=92d639339020f1b481b4faecb68f15c6ac55cf16',
				data: {
					id_user:id_user,
					id_tipe:id_tipe,
					id_status:id_status,
					long:long,
					lat:lat
				},
				dataType: 'json',
				success: function(result) {
					if(result.data) {
						alert('Absensi Berhasil disimpan!');
						location.reload();
					} else {
						alert('Maaf Anda suda Absensi!');
						location.reload();
					}
				}, error: function(err) {
					alert('Maaf Ada kesalahan sistem!' + err);
				}
			});
		}
	}

	
</script>