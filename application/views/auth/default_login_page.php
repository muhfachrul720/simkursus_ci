<!doctype html>
<html lang="en">
  <head>
  	<title>Sistem Informasi Ujian Berbasis Komputer</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= base_url()?>assets/admin_lte2/dist/css/adminlte.min.css">

	</head>

    <style>
        body{
            margin:0;
            padding:0;
        }

        .login-sect {
            min-height:100vh;
            position: relative;
            overflow:hidden;
            /* border:solid 1px gray; */
        }

        .login-header {
            /* text-align:center; */
        }

        .blob1 {
            position: absolute;
            top:-600%;
            left:60%;
            width:200%;
            /* transform: translate(-50%, -50%); */
        }

        .blob2 {
            position: absolute;
            top:150%;
            left:-140%;
            width:200%;
            z-index:-10;    
            padding:0;
            /* transform: translate(-50%, -50%); */
        }

        .login-box {
            width:50%;
            height:100px;
            position: absolute;
            left:50%;
            top:40%;
            /* z-index:99; */
            transform : translate(-50%, -50%);
        }

        .cst_input {
            border : transparent;
            box-shadow : 0px 2px 0px 0px rgba(0, 0, 0, 0.4);
        }

        .side-image {
            position: relative;
            background-image : linear-gradient(to bottom, rgba(19, 146, 198, 0.52), rgba(0, 0, 0, 0.73)),
                                url('<?= base_url() ?>assets/img/auth_back.jpg');
            background-size : cover;
        }

        .side-image img {
            width:40%;
            position: absolute;
            top:50%;
            left: 50%;
            transform:translate(-50%, -50%);
        }

        .btn-unique { 
            background-color: #1277B9;
            color: rgb(255, 255, 255);
            font-weight:bold;
        }
    </style>

	<body>
        <div class="row" style="height:98vh; width:100%;">
            <div class="col-4 side-image p-0 m-0">
                <!-- <img class="logo-image" src="<?= base_url()?>assets/img/logo.png" alt=""> -->
            </div>
            <div class="col-8 p-0 m-0">
                    <div class="login-sect">

                        <form action="<?= base_url()?>auth/authentication" method="POST" class="signin-form">
                        <div class="login-box">

                            <?php if($this->session->flashdata('mark')) {?>
                            <div class="alert alert-danger" role="alert">
                                Password Atau Username Salah
                            </div>
                            <?php }; ?>

                            <svg class="blob1" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" id="blobSvg">
                                <path id="blob" d="M311,311Q290,372,198.5,363Q107,354,90,237.5Q73,121,187,107.5Q301,94,316.5,172Q332,250,311,311Z" fill="#1277B9"></path>
                            </svg>

                            <div class="login-header">
                                <h5 class="mb-2 p-0">Login</h5> <span>Sistem Informasi Ujian Berbasis Komputer</span> 
                            </div>
                            <div class="login-input mt-3">
                                <div class="form-group row">
                                    <i class="col-sm-2 col-form-label fa fa-user"></i>
                                    <div class="col-10">
                                        <input type="text" name="username" class="form-control form-control-sm cst_input" placeholder="Username goes here" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <i class="col-sm-2 col-form-label fa fa-lock"></i>
                                    <div class="col-10">
                                        <input type="password" name="pass" class="form-control form-control-sm cst_input" placeholder="Password goes here" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <small>Silahkan melakukan autentikasi apabila ingin mengakses Sistem</small>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-unique btn-sm w-100">Login</button>
                                </div>

                                <svg class="blob2" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" id="blobSvg">
                                    <path id="blob" d="M311,311Q290,372,198.5,363Q107,354,90,237.5Q73,121,187,107.5Q301,94,316.5,172Q332,250,311,311Z" fill="#1277B9"></path>
                                </svg>

                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</body>

    <!-- <script src="<?= base_url()?>assets/js/jquery-1.11.2.min.js"></script> -->
    <!-- <script src="<?= base_url()?>assets/loginpage/js/popper.js"></script> -->
    <script src="<?= base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="<?= base_url()?>assets/loginpage/js/main.js"></script> -->
</html>

