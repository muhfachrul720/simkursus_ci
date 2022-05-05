<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Monitoring</title>
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

    .ans-sect {

    }

    .ans-sect ul {
        text-decoration:none;
        list-style-type : none;
        padding:0;
    }

    .ans-sect ul li {
        margin:0;
    }

    /* Sidebar Gone */
    body:not(.sidebar-mini-md) .content-wrapper, body:not(.sidebar-mini-md) .main-footer, body:not(.sidebar-mini-md) .main-header {
        transition: margin-left .3s ease-in-out;
        margin-left: 0px;
    }

    /* Display None */
    .dp-none {
        display:none;
    }

    .dp-block {
        display:block;
    }

    /* Btn */
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

</style>
<body class="hold-transition layout-fixed text-sm m-0">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-school"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url()?>auth/logout">
          <i class="fas fa-sign-out-alt pr-2"></i> Keluar Dari Ujian
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

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
