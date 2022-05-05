<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Ujian Berbasis Komputer</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>assets/admin_lte2/plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="<?= base_url()?>assets/admin_lte2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <link rel="stylesheet" href="<?= base_url()?>assets/admin_lte2/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url()?>assets/admin_lte2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin_lte2/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin_lte2/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <script src="<?= base_url()?>assets/admin_lte2/plugins/jquery/jquery.min.js"></script>



</head>
<style>
  #example tr td:not(:last-child) {
    padding-top: 10px !important;
  }

  label {
    font-weight:100 !important;
    /* font-size:16px !important; */
  }
  .dataTables_info { font-size: 12px !important}
  .pagination { font-size: 12px !important}

  .nav-sidebar .nav-link  {
    color:white !important;
  }

  .cst-user-panel {
    color:white;
    background-image : 
      linear-gradient(to bottom, rgba(0, 0, 0, 0.42), rgba(0, 0, 0, 0.43)),
      url('<?= base_url() ?>upload/foto_profil/<?= $this->session->userdata('picture_profile') ?>');
    background-size:cover;
    background-position:center;
    /* height:60px; */
  }

  .btn-unique {
    background: rgb(18,119,185);
    background: linear-gradient(90deg, rgba(18,119,185,1) 0%, rgba(19,146,198,1) 35%, rgba(1,171,210,1) 100%);

    color: rgb(255, 255, 255);
  }

  .btn-unique-success {
    background: rgb(27,140,8);
    background: linear-gradient(90deg, rgba(27,140,8,1) 0%, rgba(19,198,79,1) 35%, rgba(61,241,169,1) 100%);

    color: rgb(255, 255, 255);
  }

  .btn-unique-failed {
    background: rgb(236,13,13);
    background: linear-gradient(90deg, rgba(236,13,13,1) 0%, rgba(238,116,116,1) 100%);

    color: rgb(255, 255, 255);
  }

  .btn-unique-warning {
    
  }

  .cst-card {
    border-radius:20px;
    text-align:center;
    padding:20px 0px;
  }

  .cst-card-main {
    /* margin:auto; */
    width:80%;
    padding:90px 0px;
    border-radius:20px;
    text-align:center;
    /* border:solid 1px gray; */
  }

  .card-bg-unique {
    color : rgb(255, 255, 255);
    background: rgb(27,140,8);
    background: linear-gradient(90deg, rgba(18,119,185,1) 0%, rgba(19,146,198,1) 35%, rgba(1,171,210,1) 100%);
  }

  .cst-card-main h1 {
    font-size: 72px;
    font-weight:bold;
  }

  .cst-card h1 {
    font-size:40px;
    font-weight:bold;
  }

  .flex-content-card {
    position: relative;
    display:flex;
    overflow-x : scroll;
  }

  .flex-content-card::after{
    content:'';
    position : absolute;
  }

  .flex-content-card .content {
    padding:0px 32px;
  }

  /* Upload File */
  .box-upload-file{
    width:100%;
    padding: 30px 0px;
    border : dashed 2px gray;
    text-align:center;
    cursor: pointer;
  }

  .box-upload-file:hover {
    color : rgb(18,119,185);
    border : dashed 2px rgb(18,119,185);
  }

  .box-upload-file i {
    font-size:20px;
    padding-right:10px;
  }

  .file-preview {
    width:100%;
    height: 300px;
    /* padding: 150px 0px; */
    border : solid 2px gray;
    position:relative;
    overflow: hidden;
  }

  .file-preview img {
    position: absolute;
    left: 50%;
    top : 50%;
    transform : translate(-50%, -50%);
    width : 200%;
  }

  .button-place > *, .button-place form > * {
    margin-right:5px;
  }  

  .dropdown-cst {
    padding: 6px 150px 9px 10px;
    /* margin-left:20%; */
    border-radius: 5px;
  }

  /* Display None */
  .dp-none {
    display:none;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url()?>auth/logout">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4" style="background-color:#1277B9;">
    <!-- Brand Logo -->
    <a href="<?= site_url() ?>" class="brand-link text-center">
      <h5 style="color: #000000">Sample Logo Here</h5>
      <!-- <img src="<?= base_url() ?>assets/img/long-logo.png" alt="" width="120px;"> -->
      <!-- <div class="brand-text font-weight-light px-4">
        
      </div> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar p-0">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel p-3 mb-3 cst-user-panel">
        Selamat Datang Pengguna
        <h4 class="mt-2">

          
          <?=ucwords($this->session->userdata('nama_pengguna'))?> <br>
          <a href="<?= base_url('') ?>profile/index/<?= $this->session->userdata('id_user') ?>" class="btn btn-sm mt-3" style="color:white; border:solid 1px"> 
            <i style="font-size:12px;" class="fa fa-pencil-alt pr-2"></i> Edit Profile
          </a>
        </h4>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2 px-2">

        <?php include 'template/sidebar.php'; ?>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <section class="content px-4 py-3">

        <?php echo $contents; ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 
  <footer class="main-footer">
      <small>Copyright Potato</small>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- <script src="<?= base_url()?>assets/admin_lte2/plugins/jquery/jquery.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url()?>assets/admin_lte2/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url()?>assets/admin_lte2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url()?>assets/admin_lte2/plugins/chart.js/Chart.min.js"></script>

<!-- <script src="<?= base_url()?>assets/admin_lte2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
<!-- AdminLTE App -->
<script src="<?= base_url()?>assets/admin_lte2/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url()?>assets/admin_lte2/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url()?>assets/admin_lte2/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="<?= base_url()?>assets/admin_lte2/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/admin_lte2/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/admin_lte2/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url()?>assets/admin_lte2/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


</body>
</html>
