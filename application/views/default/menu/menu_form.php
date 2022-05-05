<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Halaman Detail Menu</h3>
                        <p>Berikut merupakan halaman penambahan atau penyuntingan menu dari sistem</p>
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

    <?php if($inmenu['id_menu'] != 0) {?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-3"><b>Jenis Menu</b> : </div>
                        <div class="col-3"><?php 
                            if($inmenu['is_main_menu'] != 0){
                                echo 'Anak Menu / Sub Menu';
                            } else if($inmenu['is_main_menu'] == 0 && count($insubmenu) > 0) {
                                echo 'Induk Menu';
                            } else {
                                echo 'Berdiri Sendiri';
                            }
                        ?></div>
                        <div class="col-3"><b>Jumlah Sub Menu</b></div>
                        <div class="col-3"><?= count($insubmenu) ?></div>
                    </div>

                    <div class="form-group row">
                        <div class="col-3"><b>Sub menu : </b></div>
                        <div class="col-9">
                            <?php foreach($insubmenu as $i) { echo $i['title'].', '; }?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?= form_open($action) ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <?= form_hidden('idMenu', $inmenu['id_menu']) ?>

                    <div class="form-group row">
                        <label for="" class="col-3">Judul Menu</label>
                        <div class="col-9">
                            <input type="text" name="titleMenu" id="" class="form-control form-control-sm" value="<?= $inmenu['title'] ?>">
                            <small>Berikut merupakan judul menu yang akan ditampilkan pada sidebar</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3">Url Menu</label>
                        <div class="col-9">
                            <input type="text" name="urlMenu" id="" class="form-control form-control-sm" value="<?= $inmenu['url']?>">
                            <small>Berikut merupakan url yang akan terakses apabila menekan menu tersebut, url nya biasanya diisi dengan lokasi controller dari Codeigniter 3</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3">Icon menu</label>
                        <div class="col-9">
                            <input type="text" name="iconMenu" id="" class="form-control form-control-sm" value="<?= $inmenu['icon'] ?>">
                            <small>Berikut merupakan icon dari menu yang akan tampil silahkan mengecek icon pada website : <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2&q=tachometer" target="_blank">Font Awesome</a></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3">Sub Menu dari ..</label>
                        <div class="col-1">
                            <input type="checkbox" name="" id="subMenuTrigger" class="form-control form-control-sm">
                        </div>
                        <div class="col-8">
                            <?= cmb_dinamis('subMenu','tbl_menu', 'title', 'id_menu',$inmenu['id_menu'], 'DESC', 'disabled', 'subMenuOpt') ?>
                            <small>Pilih selain "tidak ada" apabila menu yang akan dibuat merupakan sub menu dari menu lainnya</small>
                        </div>

                        <script>
                            document.querySelector('#subMenuTrigger').
                                addEventListener('change', function(a){
                                    const target = document.querySelector('#subMenuOpt');
                                    if(this.checked){
                                        target.disabled = false; 
                                    } else {target.disabled = true;}
                                });
                        </script>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3">Status (Aktif / Non - Aktif)</label>
                        <div class="col-9">
                            <!-- <input type="text" name="" id="" class="form-control form-control-sm"> -->
                            <?= form_dropdown('isAktif', array('n' => 'Tidak Aktif', 'y' => 'Aktif'), $inmenu['is_aktif'], 'class="form-control form-control-sm"')?>
                            <small>Non aktifkan menu apabila menu tidak ingin diakses, apabila ingin diakses silahkan meng-Aktifkan menu</small>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-unique w-100">Simpan Perubahan</button>
        </div>
    </div>
    <?= form_close() ?>

</div>
