<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Halaman Detail Akses Pada Level Pengguna</h3>
                        <p>Berikut merupakan halaman penambahan atau penghapusan menu yang dapat diakses oleh level pengguna</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $ck = ''; if($ck = $this->session->flashdata('msg')) {?>
    <div class="row">
        <div class="col-12">
            <label class="w-100 alert alert-<?= explode('|', $ck)[1]?>" for=""><b><?= explode('|', $ck)[0]?></b></label>
        </div>
    </div>
    <?php }; ?>

    <div class="button-place mb-3">
        <a href="<?= base_url('superadmin/access')?>" class="btn btn-unique"><i class="fas fa-arrow-left"></i> Kembali Ke Halaman Berikutnya</a>
        
        <a href="" class="btn btn-unique"><i class="fas fa-sync-alt"></i> Muat Ulang Halaman</a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-3"><b>Pemilik Hak Akses</b> : </div>
                        <div class="col-3"><?= $info[0]['nama']?></div>
                        <div class="col-3"><b>Jumlah Menu Yang dapat diakses</b></div>
                        <div class="col-3"><?= count($info)?></div>
                    </div>

                    <div class="form-group row">
                        <div class="col-3"><b>Aksi</b></div>
                        <div class="col-9">
                            <button class="btn btn-danger btn-sm" id="deleteAll" value="<?= $info[0]['id']?>" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i> Hapus Keseluruhan</button>
                            <!-- <button class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Akses Menu</button> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?= form_open('superadmin/access/access_insert') ?>
    <?= form_hidden('idLevel', $info[0]['id']) ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-weight:bold">Tambah Menu Akses</h6>
                    <hr>
                    <div class="form-group row">
                        <div class="col-3">Menu : </div>
                        <div class="col-9">
                            <?= cmb_dinamis_where('idMenu','tbl_menu','title','id_menu','', 'ASC', 'is_main_menu', '0') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-2">
                            <button type="submit" class="btn btn-unique w-100 btn-sm"><i class="fas fa-plus"></i>Tambah Hak Akses</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= form_close() ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-weight:bold">Menu Akses</h6>
                    <hr>
                    <?php 
                        foreach($info as $f) 
                        if($f['id_hak_akses'] != null){

                    {?>
                    <label for="" class="btn-unique py-1 px-2" style="border-radius:3px;">
                        <?= $f['title'] ?>
                        <button data-toggle="modal" data-target="#deleteModal" class="deleteBtn" style="background:transparent; border:none; padding:0; margin-left:10px;" value="<?= $f['id_hak_akses']?>">
                            <i class="fas fa-trash-alt" style="color:red"></i>
                        </button>
                    </label>
                    <?php }} ?>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-25" role="document">
            <div class="modal-content">
                <div class="modal-body">
                        
                        <?= form_open('superadmin/access/access_delete', array('id' => 'actionTarget')) ?>
                        <input type="hidden" name="id" id="idDelete" value="">
                        <input type="hidden" name="type" id="typeDelete" value="">

                        <h6 class="text-center mb-3">Apakah yakin ingin menghapus?</h6>
                        <div class="form-group text-center m-0">
                            <button type="button" data-dismiss="modal" class="btn-secondary btn-sm btn">Tidak, Jangan Hapus</button>
                            <button type="submit" id="confirmDelBtn" class="btn-danger btn-sm btn">Iya, saya yakin</button>
                        </div>
                        <?= form_close() ?>
                </div>
            </div>
    </div>

    <script>
        const btn = document.querySelectorAll('.deleteBtn');
        const btnAll = document.querySelector('#deleteAll');

        btnAll.addEventListener('click', function(){
            document.querySelector('#idDelete').value = this.value;
            document.querySelector('#typeDelete').value = 'all';
        });
        
        for(let i=0; i < btn.length; i++){
            btn[i].addEventListener('click', function(){
                document.querySelector('#idDelete').value = this.value;
                document.querySelector('#typeDelete').value = 'nonall';
            });
        }

    </script>