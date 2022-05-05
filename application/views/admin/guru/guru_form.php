<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Halaman Detail Tenaga Pengajar</h3>
                        <p>Berikut merupakan halaman detail dan informasi mengenai tenaga pengajar</p>
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
    <?= form_hidden('id', $inguru['id']) ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group row mb-3">
                        <label for="" class="col-1 mt-1">Nip Guru </label>
                        <div class="col-5">
                            <input type="text" name="nipGuru" id="" class="form-control form-control-sm" value="<?= $inguru['guru_nip']?>" placeholder="Contoh : 991299419921">
                            <small>Masukkan Nomor induk pegawai milik guru disini</small>
                        </div>

                        <label for="" class="col-1 mt-1">Kode Guru </label>
                        <div class="col-5">
                            <input type="text" name="kodeGuru" id="" class="form-control form-control-sm" value="<?= $inguru['guru_kode']?>" placeholder="Contoh : GA512">
                            <small>Masukkan Kode guru disini</small>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="" class="col-1 mt-1">Nama Guru </label>
                        <div class="col-11">
                            <input type="text" name="namaGuru" id="" class="form-control form-control-sm" value="<?= $inguru['guru_nama']?>" placeholder="Contoh : Muhammad Randy Fajral Rahmat Jamaluddin ST. MT. PROF Eng">
                            <small>Masukkan Nama Lengkap beserta gelar dari guru disini</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-1 mt-1">Jam Ajar</label>
                        <div class="col-9">
                            <input type="number" name="jamAjar" id="" class="form-control form-control-sm" value="<?= $inguru['guru_jam_ajar']?>" placeholder="Contoh : 12">
                            <small>Masukkan Jumlah jam pengajaran guru disini</small>
                        </div>
                        <label for="" class="col-2 mt-1">Jam Pengajaran</label>
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