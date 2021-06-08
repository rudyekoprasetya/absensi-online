<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" href="<?php echo base_url()."/assets/"; ?>favicon.ico">

    <title><?php echo $judul; ?></title>
<?php if(isset($output)) {?>
    <!-- CSS Grocery CRUD -->
    <?php foreach ($output->css_files as $file) { ?>
         <link href="<?php echo $file; ?>" rel="stylesheet">
    <?php    } ?>
<?php } ?>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()."/assets/"; ?>css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?php echo base_url()."/assets/"; ?>css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()."/assets/"; ?>font-awesome/css/font-awesome.min.css">
    <style type="text/css">
      #maps {
        width: 100%;
        height: 200px;
      }
    </style>
    <!-- Page Specific CSS -->
    <!-- <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css"> -->
    <!-- leaflet -->
        <!-- Load Leaflet from CDN -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
      <!-- Load Esri Leaflet from CDN -->
      <script src="https://unpkg.com/esri-leaflet@3.0.2/dist/esri-leaflet.js" integrity="sha512-myckXhaJsP7Q7MZva03Tfme/MSF5a6HC2xryjAM4FxPLHGqlh5VALCbywHnzs2uPoF/4G/QVXyYDDSkp5nPfig==" crossorigin=""></script>
      <!-- Load Esri Leaflet Geocoder from CDN -->
      <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.0.0/dist/esri-leaflet-geocoder.css"
        integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
        crossorigin="">
      <script src="https://unpkg.com/esri-leaflet-geocoder@3.0.0/dist/esri-leaflet-geocoder.js"
        integrity="sha512-vZbMwAf1/rpBExyV27ey3zAEwxelsO4Nf+mfT7s6VTJPUbYmD2KSuTRXTxOFhIYqhajaBU+X5PuFK1QJ1U9Myg=="
        crossorigin=""></script>
        <!-- leaflet -->
    
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
	  
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
		<!--Header-->
        <?php echo $_header; ?>
		<!--endHeader-->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
		<!--sidebar-->
		<?php echo $_sidebar; ?>          
		<!--endsidebar-->
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <div class="row">
		<div class="col-lg-12">
		<div class="panel panel-primary">      
		<!--content-->
		<?php echo $_content; ?>          
        <!--endcontent-->
		</div>
		</div>
		</div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

<!-- Modal Edit data -->
<div class="modal fade" id="myModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalInfoLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalInfoLabel">Akun OVO</h4>
      </div>
      <div class="modal-body">
        <div class="jumbotron">
          <center>
            <img src="<?= base_url().'/assets/img/contoh-ovo.png' ?>" class="img-responsive img-thumbnail" width="320px" height="320px">
            <h3><b>0857-3699-1133 a/n Indah Sulihati</b></h3>
          </center>
          <p align="center"><a class="btn btn-primary btn-lg" href="<?= site_url('ortu/cara'); ?>" role="button"><i class="fa fa-info-circle"></i> Cara Pembayaran</a></p>
        </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>
    </div>
    </div>
  </div>
</div>
<!--END Modal Edit data -->

<?php if(isset($output)) {?>
    <!-- JS grocery CRUD -->
    <?php foreach ($output->js_files as $file) { ?>
         <script src="<?php echo $file; ?>"></script>
    <?php    } ?>
<?php } else { ?>
    <!-- JavaScript -->
    <script src="<?php echo base_url()."/assets/"; ?>js/jquery-1.10.2.js"></script>
<?php } ?>
    <script src="<?php echo base_url()."/assets/"; ?>js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <!-- <script src="<?php echo base_url()."/assets/"; ?>js/morris/chart-data-morris.js"></script> -->
    <script src="<?php echo base_url()."/assets/"; ?>js/tablesorter/jquery.tablesorter.js"></script>
    <script src="<?php echo base_url()."/assets/"; ?>js/tablesorter/tables.js"></script>

  </body>
</html>
