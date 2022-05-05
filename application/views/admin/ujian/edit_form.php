<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Halaman <?= $setting['page'] ?> Ujian</h3>
                        <p>Silahkan <?= $setting['detail']?> dengan mengisi secara keseluruhan dan tepat </p>
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

    <?= form_open_multipart($setting['action'])?>
    <?= form_hidden('id', $form['id']) ?>
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-weight:bold">Judul dan Jenis Ujian</h6>
                    <hr>

                    <div class="form-group row">
                        <label for="" class="col-1">Judul Ujian </label>
                        <div class="col-11">
                            <input type="text" name="titleUjian" id="" class="form-control form-control-sm" value="<?= $form['title_ujian'] ?>" placeholder="Contoh : Ujian Kompetensi Dasar Kelas A" required>
                            <small>Masukkan judul ujian disini</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-1">Kode Ujian</label>
                        <div class="col-6">
                            <input type="text" name="codeUjian" id="" class="form-control form-control-sm" value="<?= $form['code_ujian'] ?>" placeholder="Contoh : TKJ" disabled>
                            <small>Kode Ujian akan tergenerate dengan sendirinya ketika memasukkan judul dan memilih jenis Soal</small>
                        </div>

                        <label for="" class="col-1">Jenis Ujian</label>
                        <div class="col-4">
                            <?= form_dropdown('typeUjian', array(
                                'tkd' => 'TKD-A', 
                                'kcm' => 'Kecermatan', 
                                'kpb' => 'Kepribadian'
                            ), $form['type_ujian'], 'class="form-control form-control-sm" disabled')?>
                            <small>Pilih Jenis Ujian</small>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                <h6 style="font-weight:bold">Informasi Soal dan Waktu</h6>
                <hr>
                
                <!-- TKD - A dan Kecermatan -->
                <div class="form-group row">
                    <label for="" class="col-2">Jumlah Pertanyaan </label>
                    <div class="col-10">
                        <?php echo form_dropdown('totalQuestion', array(
                            '20' => '20 Soal', 
                            '50' => '50 Soal'
                        ), $form['total_question'], 'class="form-control form-control-sm" disabled')?>
                        <small>Pilih Jumlah Pertanyaan</small>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-2">Waktu Mulai </label>
                    <div class="col-4">
                        <input type="datetime-local" name="timeStart" class="form-control form-control-sm" value="<?php echo date('Y-m-d\TH:i', strtotime($form['time_start'])); ?>" required>
                        <small>Pilih Tanggal dan Waktu Ujian Dimulai</small>
                    </div>

                    <label for="" class="col-2">Waktu Berakhir </label>
                    <div class="col-4">
                        <input type="datetime-local" name="timeEnd" class="form-control form-control-sm" value="<?php echo date('Y-m-d\TH:i', strtotime($form['time_end'])); ?>" required>
                        <small>Pilih Tanggal dan Waktu Ujian Selesai</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-2">Durasi Ujian </label>
                    <div class="col-4">
                        <input type="number" min="1" name="timeDuration" class="form-control form-control-sm" value="<?= $form['time_duration'] ?>" disabled>
                        <small>Tentukan Durasi Waktu Ujian dalam hitungan menit</small>
                    </div>
                    <label for="" class="col-2">Menit </label>
                </div>

                </div>
            </div>

        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <h6 style="font-weight:bold">Token</h6>
                <hr>

                    <div class="form-group row">
                        <label for="" class="col-2">Token </label>
                        <div class="col-10">
                            <input type="text" name="tokenUjian" id="" class="form-control form-control-sm" value="<?= $form['token'] ?>" disabled>
                            <small>Token Dibentuk Setelah Menjadwalkan Ujian</small>
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
