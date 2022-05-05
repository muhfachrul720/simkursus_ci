<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Halaman <?= $setting['page'] ?> Soal</h3>
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
                    <h6 style="font-weight:bold">Judul dan Jenis Soal</h6>
                    <hr>

                    <div class="form-group row">
                        <!-- <label for="" class="col-1">Judul Soal </label>
                        <div class="col-5">
                            <input type="text" name="titleQuestion" id="" class="form-control form-control-sm" value="" placeholder="Contoh : Soal TKDA_A Kelas A Tanggal 20/10/2021" required> 
                            <small>Masukkan judul soal disini</small>
                        </div> -->

                        <label for="" class="col-1">Kode Soal</label>
                        <div class="col-11">
                            <input type="text" name="" id="" class="form-control form-control-sm" value="<?= $detail[0]['kode_soal'] ?>" placeholder="Contoh : TKDA_A1_122021" disabled>
                            <small>Kode Soal akan tergenerate dengan sendirinya</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-1">Jenis Soal</label>
                        <div class="col-3">
                            <?= form_dropdown('typeQuestion', array(
                                'tkd' => 'TKD-A', 
                                'kcm' => 'Kecermatan', 
                                'kpb' => 'Kepribadian'
                            ), $detail[0]['jenis_soal'], 'class="form-control form-control-sm" id="typeQuestion" disabled')?>
                            <small>Pilih Jenis Kelas Disini</small>
                        </div>

                        <label for="" class="col-1">Jenis Jawaban</label>
                        <div class="col-3">
                            <?php echo form_dropdown('typeAnswer', array(
                                'txt' => 'Tulisan / Teks', 
                                'img' => 'Gambar'
                            ), $detail[0]['type_jawaban'] , 'class="form-control form-control-sm" id="typeAnswer" disabled')?>
                            <small>Pilih Jenis Jawaban</small>
                        </div>

                        <label for="" class="col-1">Jumlah Pilihan </label>
                        <div class="col-3">
                            <input type="number" name="totalAnswer" id="totalAnswer" class="form-control form-control-sm" value="<?= $detail[0]['jml_jawaban'] ?>" min="1" max="6" placeholder="Contoh :5" disabled>
                            <small>Masukkan jumlah pilihan jawaban minimal 2 maksimal 6</small>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    
        <div class="col-12">
            <div class="">

                <div class="card">
                    <div class="card-body">
                    <h6 style="font-weight:bold">Informasi Soal</h6>
                    <hr>
                        
                        <div id="contain-inform-soal">
                            
                            <?= $question ?>

                        </div>
                        
                    </div>
                </div>

                
                <div class="card">
                    <div class="card-body">
                        <h6 style='font-weight:bold'>Lampiran Gambar Soal</h6>
                        <hr>

                        <div class="form-group row">
                            <label for="" class="col-1">Lampiran</label>
                            <div class="col-2">
                                <label for="soalImage" class="btn btn-unique btn-sm">Upload Gambar Soal</label>
                                <input type="file" name="soalImg[]" id="soalImage" style="display:none" multiple>
                            </div>
                            <div class="col-4">
                                <small style="color:red">PERHATIAN !! Mengupload gambar baru akan menggantikan gambar sebelumnya</small>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <div class="col-4">
                                
                                <small>List Gambar Akan Diperlihatkan dibawah</small>
                                <div id="imageList">
                                    
                                </div>

                            </div>

                            <div class="col-8">
                                
                                <small>Gambar Soal</small>
                                <div id="imageList" class="row mt-3">
                                    <?php foreach($lampiran as $l) { ?>
                                        <div class="col-3">
                                            <img src="<?= base_url() ?>upload/user_images/answer_images/<?= $l['nama_file'] ?>" alt="" style="height:100px; width:100px;">
                                        </div>
                                    <?php }; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                    <h6 style="font-weight:bold">Informasi Jawaban</h6>
                    <hr>
                        
                        <div id="contain-inform-answer">
                            
                            <?= $answer ?>

                        </div>
                 
                    </div>
                </div>

            </div>
    
          
        </div>

        <div class="col-12">
            <input type="submit" class="btn btn-unique w-100" value="Simpan Perubahan">
        </div>

    </div>
    <?= form_close()?>

</div>

<script>
    triggerFileName();

    let soalImage = document.querySelector('#soalImage');
    soalImage.addEventListener('change', a => {
        let files = a.target.files; let html = '';
        for(let i = 0; i < files.length; i++){
            html += files[i].name+'<br>';
        }
        document.querySelector('#imageList').innerHTML = html;
    })

    function triggerFileName() {
        let inputFile = document.querySelectorAll('.file-input');
        inputFile.forEach(a => {
            a.addEventListener('change', j => {
                let filename = j.target.files[0].name;
                j.target.nextElementSibling.innerHTML = filename;
            });
        });
    }
</script>