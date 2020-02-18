<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=isset($title) ? html_entity_decode(@$title) : 'LSP STIKI '?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=url_cdn()?>css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=url_cdn()?>plugins/datepicker/datepicker3.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=url_cdn()?>css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=url_cdn()?>css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=url_cdn()?>plugins/iCheck/square/blue.css">
  <!-- swal -->
  <link rel="stylesheet" href="<?=url_cdn()?>plugins/swal/sweet-alert.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="<?=url_cdn()?>plugins/pace/pace.min.css">
  <!-- magicSuggest -->
  <link rel="stylesheet" href="<?=url_cdn()?>plugins/magicsuggest/magicsuggest-min.css">
	<?php 
		if (is_array(@$custom_css) && count(@$custom_css))
			foreach ($custom_css as $k=>$v)
				echo '<link rel="stylesheet" href="'.$v.'">';
	?>

	<script> var base_url = '<?=url()?>';</script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=site_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>LSP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>LSP</b>STIKI</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=url_cdn()?>img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$this->login['nm_admin']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=url_cdn()?>img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?=$this->login['nm_admin']?>
                  <small><?=$this->login['status']?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?=url().'logout'?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=url_cdn()?>img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->login['nm_admin']?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?=!isset($active_menu) || in_array('dashboard', $active_menu) ? 'active' : ''?>">
			<a href="<?=site_url()?>"><i class="fa fa-home"></i> <span>Dashboard</span></a>
		</li>
		<?php if (get_status() == 'peserta') { ?>
		<li class="<?=!isset($active_menu) || in_array('profile', $active_menu) ? 'active' : ''?>">
			<a href="<?=site_url().'profile'?>"><i class="fa fa-user"></i> <span>Profile</span></a>
		</li>

		<!--futry-->
		<li class="<?=in_array('daftar', $active_menu) ? 'active' : ''?>">
		  <a href="<?=site_url().'daftar/'?>"><i class="fa fa-list-alt"></i> <span>Daftar</span></a>
		</li>

		<?php } ?>
		
		<?php if (get_status() == 'admin') {?>
		<li class="treeview <?=in_array('master', $active_menu) ? 'active' : ''?>">
          <a href="#">
            <i class="fa fa-database"></i>
            <span>Master Data</span>
            <span class="pull-right-container">
				<i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?=in_array('mahasiswa', $active_menu) ? 'active' : ''?>"><a href="<?=url().'setting/mahasiswa'?>"><i class="fa fa-circle-o"></i> Mahasiswa</a></li>
            <li class="<?=in_array('asesor', $active_menu) ? 'active' : ''?>"><a href="<?=url().'setting/asesor'?>"><i class="fa fa-circle-o"></i> Asesor</a></li>
            <li class="<?=in_array('tuk', $active_menu) ? 'active' : ''?>"><a href="<?=url().'setting/tuk'?>"><i class="fa fa-circle-o"></i> TUK</a></li>
			<li class="<?=in_array('skema', $active_menu) ? 'active' : ''?>"><a href="<?=url().'setting/skema'?>"><i class="fa fa-circle-o"></i> Skema</a></li>
			<li class="<?=in_array('mitra', $active_menu) ? 'active' : ''?>"><a href="<?=url().'setting/mitra'?>"><i class="fa fa-circle-o"></i> Mitra</a></li>
			<li class="<?=in_array('biaya-pendaftaran', $active_menu) ? 'active' : ''?>"><a href="<?=url().'setting/biaya-pendaftaran'?>"><i class="fa fa-circle-o"></i> Biaya Pendaftaran</a></li>
          </ul>
        </li>
		<li class="<?=in_array('pendaftaran', $active_menu) ? 'active' : ''?>">
			<a href="<?=site_url().'pendaftaran/'?>"><i class="fa fa-list-alt"></i> <span>Pendaftaran</span></a>
		</li>
		<li class="<?=in_array('pembayaran', $active_menu) ? 'active' : ''?>">
			<a href="<?=site_url().'pembayaran/'?>"><i class="fa fa-money"></i> <span>Pembayaran</span></a>
		</li>
		<li class="<?=in_array('penjadwalan', $active_menu) ? 'active' : ''?>">
			<a href="<?=site_url().'penjadwalan/'?>"><i class="fa fa-calendar"></i> <span>Penjadwalan</span></a>
		</li>
		<li class="<?=in_array('rekap-asesmen', $active_menu) ? 'active' : ''?>">
			<a href="<?=site_url().'rekap-asesmen/'?>"><i class="fa fa-check-square-o"></i> <span>Rekap Asesmen</span></a>
		</li>
		<li class="<?=in_array('hasil-sertifikasi', $active_menu) ? 'active' : ''?>">
			<a href="<?=site_url().'hasil-sertifikasi/'?>"><i class="fa fa-check-square"></i> <span>Hasil Sertifikasi</span></a>
		</li>
		<li class="<?=in_array('validasi-sertifikat', $active_menu) ? 'active' : ''?>">
			<a href="<?=site_url().'validasi-sertifikat/'?>"><i class="fa fa-check-square-o"></i> <span>Validasi Sertifikat</span></a>
		</li>
		<li class="<?=in_array('berita-acara', $active_menu) ? 'active' : ''?>">
			<a href="<?=site_url().'berita-acara/'?>"><i class="fa fa-check-square-o"></i> <span>Berita Acara</span></a>
		</li>
		<?php } ?>
		
		<?php if (get_status() == 'admin' || get_status() == 'manager') {?>
		<li class="treeview <?=in_array('report', $active_menu) ? 'active' : ''?>">
			<a href="#">
				<i class="fa fa-file-text-o"></i>
				<span>Laporan</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="<?=in_array('report-peserta', $active_menu) ? 'active' : ''?>"><a href="<?=url().'report/peserta'?>"><i class="fa fa-circle-o"></i> Peserta</a></li>
				<li class="<?=in_array('report-pembayaran', $active_menu) ? 'active' : ''?>"><a href="<?=url().'report/pembayaran'?>"><i class="fa fa-circle-o"></i> Pembayaran</a></li>
				<li class="<?=in_array('report-jadwal', $active_menu) ? 'active' : ''?>"><a href="<?=url().'report/jadwal'?>"><i class="fa fa-circle-o"></i> Jadwal</a></li>
				<li class="<?=in_array('report-asesmen', $active_menu) ? 'active' : ''?>"><a href="<?=url().'report/asesmen'?>"><i class="fa fa-circle-o"></i> Hasil Asesmen</a></li>
				<li class="<?=in_array('report-sertifikasi', $active_menu) ? 'active' : ''?>"><a href="<?=url().'report/sertifikasi'?>"><i class="fa fa-circle-o"></i> Hasil Sertifikasi</a></li>
				<li class="<?=in_array('report-asesor', $active_menu) ? 'active' : ''?>"><a href="<?=url().'report/asesor'?>"><i class="fa fa-circle-o"></i> Asesor</a></li>
				<li class="<?=in_array('report-tuk', $active_menu) ? 'active' : ''?>"><a href="<?=url().'report/tuk'?>"><i class="fa fa-circle-o"></i> TUK</a></li>
			  </ul>
		</li>
		<?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=@$header_title?>
        <small><?=@$header_sub?></small>
      </h1>
      <ol class="breadcrumb">
		<?php 
			if (is_array(@$breadcrumbs) && count(@$breadcrumbs)) 
				foreach ($breadcrumbs as $breadcrumb)
					echo '<li><a href="'.@$breadcrumb['url'].'"><i class="'.@$breadcrumb['class'].'"></i> '.@$breadcrumb['text'].'</a></li>';
		?>
      </ol>
    </section>

  <?=html_entity_decode($content)?>
   
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.6
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?=url_cdn()?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=url_cdn()?>js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=url_cdn()?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=url_cdn()?>plugins/fastclick/fastclick.js"></script>
<!-- iCheck -->
<script src="<?=url_cdn()?>plugins/iCheck/icheck.min.js"></script>
<!-- datepicker -->
<script src="<?=url_cdn()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- swal -->
<script src="<?=url_cdn()?>plugins/swal/sweet-alert.min.js"></script>
<!-- magicSuggest -->
<script src="<?=url_cdn()?>plugins/magicsuggest/magicsuggest-min.js"></script>
<script src="<?=url_cdn()?>plugins/pace/pace.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=url_cdn()?>js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=url_cdn()?>js/main.js"></script>
<?php 
	if (is_array(@$custom_js) && count(@$custom_js))
		foreach ($custom_js as $k=>$v)
			echo '<script src="'.$v.'"></script>';
?>

<script>
	function iCheckInitialize(){
		$('input[type="checkbox"], input[type="radio"]').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
		});
	}
	
	$(document).ready(function(){
		iCheckInitialize();
		Pace.restart();
		//Date picker
		$('#datepicker').datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true
		});
		
		$('a.confirm').click(function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			swal({
				title: "Are you sure?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes",
				showLoaderOnConfirm: true,
				closeOnConfirm: false
			},function(isConfirm){
				if (isConfirm)
					window.location = url;
			});
		});
	});
</script>

</body>
</html>
