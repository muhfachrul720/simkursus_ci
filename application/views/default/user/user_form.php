<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Halaman Detail Pengguna</h3>
                        <p>Berikut merupakan halaman pendaftaran baru atau penyuntingan terhadap pengguna</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="button-place mb-3">
        <a href="<?= $_SERVER['HTTP_REFERER']?>" class="btn btn-unique"><i class="fas fa-arrow-left"></i> Kembali Ke Halaman Berikutnya</a>
        
        <a href="" class="btn btn-unique"><i class="fas fa-sync-alt"></i> Muat Ulang Halaman</a>
    </div>
    
    <?php $ck = ''; if($ck = $this->session->flashdata('msg')) {?>
    <div class="row">
        <div class="col-12">
            <label class="w-100 alert alert-<?= explode('|', $ck)[1]?>" for=""><b><?= explode('|', $ck)[0]?></b></label>
        </div>
    </div>
    <?php }; ?>

    <?= form_open_multipart($action)?>
    <?= form_hidden('iduser', $inuser['id_user']) ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    
                    
                        <div class="form-group row">
                            <label for="" class="col-3">Username </label>
                            <div class="col-9">
                                <input type="text" name="userName" id="" class="form-control form-control-sm" value="<?= $inuser['username']?>">
                                <small>Username yang akan digunakan oleh pengguna untuk autentikasi</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-3">Nama Pengguna </label>
                            <div class="col-9">
                                <input type="text" name="namaPengguna" id="" class="form-control form-control-sm" value="<?= $inuser['nama_pengguna']?>">
                                <small>Nama Pengguna yang akan ditampilkan di dashboard, sidebar dan lainnya</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-3">Password </label>
                            <div class="col-9">
                                <input type="text" name="password" id="" class="form-control form-control-sm">
                                <small>Password akan digunakan oleh pengguna untuk autentikasi</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-3">Level Akses Pengguna </label>
                            <div class="col-9">
                                <?= cmb_dinamis('lvUser','tbl_user_level','nama','id',$inuser['id'],'ASC')?>
                                <small>Level Akses adalah hirarki yang menentukan menu apa saja yang bisa diakses</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Foto Profil </label>
                            <div class="col-6">
                                <label for="fileUpload" class="box-upload-file">
                                    <i class="fas fa-file-alt"></i> Tekan Disini Untuk Mengupload File
                                </label>
                                <small>Password akan digunakan oleh pengguna untuk autentikasi</small>
                                <input type="file" name="fotoProfile" id="fileUpload" style="display:none">
                            </div>
                            <div class="col-3">
                                <div class="file-preview">
                                    <img id="imgPreview" style="width:100%;" src="<?= base_url('upload/foto_profil/'.$inuser['picture_profile'])?>" alt="">
                                    <span>File Preview</span>
                                </div>
                            </div>
                        </div>
                    

                </div>
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-unique w-100">Simpan Perubahan</button>
        </div>
    </div>
    <?= form_close()?>

</div>

<script>
    const target = document.querySelector('#fileUpload');
    target.addEventListener('change', function(a) {
        document.querySelector('#imgPreview').src = URL.createObjectURL(a.target.files[0])
        // console.log(URL.createObjectURL(a.target.files[0]));
    });
</script>
        