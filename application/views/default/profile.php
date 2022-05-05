<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Halaman Profile</h3>
                        <p>Halaman Profile Milik Akun : <?= ucwords($this->session->userdata('username')) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="mt-0">

    <div class="row">

        <?php $ck='';if($ck = $this->session->flashdata('alert')) {?>
        <div class="col-12">
            <div class="alert alert-<?= explode('|', $ck)[0]?>">
                <?= explode('|', $ck)[1]?>
            </div>
        </div>
        <?php }; ?>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group row">
                                <div style="width:90%; height:400px; overflow:hidden; position:relative">
                                    <img src="<?= base_url() ?>upload/foto_profil/<?= $p['picture_profile'] ?>" alt="" style="width:200%; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)">
                                </div>
                            </div>
                        </div>
                        <div class="col-9">

                            <?= form_open_multipart('profile/update_profile') ?>
                            <?= form_hidden('idUser', $p['id_user']) ?>

                            <div class="form-group row">

                                <label class="col-3 col-form-label">Nama Pengguna</label>
                                <h5 class="col-3 pt-1" style="font-weight:bold"><?= ucwords($p['nama_pengguna']) ?></h5>
                                <!-- <input type="text" class="col-4 form-control form-control-sm" disabled> -->

                                <label class="col-3 col-form-label">Level Pengguna</label>
                                <h5 class="col-3 pt-1" style="font-weight:bold"><?= ucwords($p['nama']) ?></h5>

                            </div>

                            <hr>

                            <div class="form-group row">
                                <label class="col-3 col-form-label">Username</label>
                                <input type="text" class="col-8 form-control form-control-sm" value="<?= ucwords($p['username']) ?>" disabled>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Nama Pengguna</label>
                                <input type="text" name="nameUser" class="col-8 form-control form-control-sm" value="<?= ucwords($p['nama_pengguna']) ?>">
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Foto</label>
                                <label for="imageProfile" class="col-8" style="width:100%; text-align:center; padding:20px 0px; border:dashed 2px #C92A42; cursor:pointer">
                                    <i class="fa fa-file" style="color:#C92A42; font-size:20px;"></i> <br>
                                    <small>Klik Disini Untuk Mengganti Foto Profil</small>
                                </label>
                                <input type="file" name="imageUser" id="imageProfile" style="display:none;">
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Password</label>
                                <div class="col-8 row p-0 m-0">
                                    <div class="col-12 p-0 m-0 mb-2">
                                        <input type="text" name="newPass" class="form-control form-control-sm" placeholder="Masukkan Password Baru">
                                    </div>
                                    <div class="col-12 p-0 m-0 mb-2">
                                        <input type="text" name="matchingPass" class="form-control form-control-sm" placeholder="Masukkan Password Baru Sekali lagi">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-3"></div>
                                <div class="col-8 m-0 p-0 text-right">
                                    <button type="submit" class="btn btn-sm btn-unique w-25" style="font-weight:bold; color:white">Simpan</button>
                                </div>
                            </div>
                            <?= form_close() ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
