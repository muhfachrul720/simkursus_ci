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
                            <input type="text" name="" id="" class="form-control form-control-sm" value="" placeholder="Contoh : TKDA_A1_122021" readonly>
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
                            ), '', 'class="form-control form-control-sm" id="typeQuestion"')?>
                            <small>Pilih Jenis Kelas Disini</small>
                        </div>

                        <label for="" class="col-1">Jenis Jawaban</label>
                        <div class="col-3">
                            <?php echo form_dropdown('typeAnswer', array(
                                'txt' => 'Tulisan / Teks', 
                                'img' => 'Gambar'
                            ), '', 'class="form-control form-control-sm" id="typeAnswer"')?>
                            <small>Pilih Jenis Jawaban</small>
                        </div>

                        <label for="" class="col-1">Jumlah Pilihan </label>
                        <div class="col-3">
                            <input type="number" name="totalAnswer" id="totalAnswer" class="form-control form-control-sm" value="4" min="1" max="6" placeholder="Contoh :5">
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
                                <small>Kosongkan apabila soal tidak memiliki gambar</small>
                            </div>
                            <div class="col-12">
                                <hr>
                                <small>List Gambar Akan Diperlihatkan dibawah</small>
                                <div id="imageList">
                                    
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

<!-- Change Form Question and Answer -->
<script>
    let arrayAlphabet = ['-', 'A', 'B', 'C', 'D', 'E', 'F'];
    
    let optQuestion = document.querySelector('#typeQuestion');
    let optAnswer = document.querySelector('#typeAnswer');
    let soalImage = document.querySelector('#soalImage');

    changeQuestForm(optQuestion);

    let totalAnswer = document.querySelector('#totalAnswer');

    changeTrueAnswerOpt(totalAnswer);    
    changeAnswerForm(optAnswer, totalAnswer.value);

    // ============================================================================
    // Trigger
    optQuestion.addEventListener('change', a => {
        changeQuestForm(optQuestion);
        changeTrueAnswerOpt(totalAnswer);

        // changeAnswerForm(optAnswer, totalAnswer.value);
        // triggerFileName();
    });

    totalAnswer.addEventListener('change', a => {
        changeQuestForm(optQuestion);
        changeAnswerForm(optAnswer, totalAnswer.value);
        changeTrueAnswerOpt(totalAnswer);    
        triggerFileName();
    });

    optAnswer.addEventListener('change', a => {
        changeAnswerForm(optAnswer, totalAnswer.value);
        triggerFileName();
    });

    soalImage.addEventListener('change', a => {
        let files = a.target.files; let html = '';
        for(let i = 0; i < files.length; i++){
            html += files[i].name+'<br>';
        }
        document.querySelector('#imageList').innerHTML = html;
    })

    // ============================================================================
    // function 
    function changeQuestForm(optQuestion) {
        const targetContainer = document.querySelector('#contain-inform-soal');

        // console.log(optQuestion.value);

        let html = '';
        if(optQuestion.value == 'tkd'){
            html = `
            <div class="form-group row">
                <label for="" class="col-1">Pertanyaan </label>
                <div class="col-11">
                    <textarea name="theQuestion" class="form-control form-control-sm" id="" rows="5" required></textarea>
                    <small>Masukkan Pertanyaan Disini</small>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-1">Bobot</label>
                <div class="col-5">
                    <input type="text" name="bobotTKDKC" id="" class="form-control form-control-sm" value="" placeholder="Contoh : 2" required>
                    <small>Masukkan bobot pertanyaan</small>
                </div>

                <label for="" class="col-1">Jawaban </label>
                <div class="col-5">
                    <select name="trueAnswerTKDKC" id="trueAnswer" class="form-control form-control-sm" required> 
                        <option value="1"> 2 </option>
                    </select>
                    <small>Pilih Jawaban yang benar pada Pertanyaan tersebut</small>
                </div>
            </div>
            `;
        } else if (optQuestion.value == 'kpb') {
            html = `
            <div class="form-group row">
                <label for="" class="col-1">Pertanyaan </label>
                <div class="col-11">
                    <textarea name="theQuestion" class="form-control form-control-sm" id="" rows="5" required></textarea>
                    <small>Masukkan Pertanyaan Disini</small>
                </div>
            </div>
            `;
        } else if(optQuestion.value == 'kcm') {
            html = `
            <div class="form-group row">
                <label for="" class="col-1">Kolom Soal </label>
                <div class="col-11">
                    <select name="columnKC" id="" class="form-control form-control-sm">
                        <option value="1">Kolom 1</option>
                        <option value="2">Kolom 2</option>
                        <option value="3">Kolom 3</option>
                        <option value="4">Kolom 4</option>
                        <option value="5">Kolom 5</option>
                        <option value="6">Kolom 6</option>
                        <option value="7">Kolom 7</option>
                        <option value="8">Kolom 8</option>
                        <option value="9">Kolom 9</option>
                        <option value="10">Kolom 10</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-1">Pertanyaan </label>
                <div class="col-11">
                    <textarea name="theQuestion" class="form-control form-control-sm" id="" rows="5" required></textarea>
                    <small>Masukkan Pertanyaan Disini</small>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-1">Bobot</label>
                <div class="col-5">
                    <input type="text" name="bobotTKDKC" id="" class="form-control form-control-sm" value="" placeholder="Contoh : 2" required>
                    <small>Masukkan bobot pertanyaan</small>
                </div>

                <label for="" class="col-1">Jawaban </label>
                <div class="col-5">
                    <select name="trueAnswerTKDKC" id="trueAnswer" class="form-control form-control-sm" required> 
                        <option value="1"> 2 </option>
                    </select>
                    <small>Pilih Jawaban yang benar pada Pertanyaan tersebut</small>
                </div>
            </div>
            `;
        }   
        
        targetContainer.innerHTML = html;
    }

    function changeAnswerForm(optAnswer, totalIndex){
        const targetContainer = document.querySelector('#contain-inform-answer');

        let html = '';
        if(optAnswer.value == 'txt'){
            for(let i=1;i<=totalIndex;i++){
                html += `
                <div class="form-group row">
                    <label for="" class="col-2">Pilihan ${arrayAlphabet[i]} </label> 
                    <div class="col-7">
                        <input type="text" name="answerTxt[]" id="" class="form-control form-control-sm" required>
                        <small>Masukkan isi Jawaban pada pilihan ${arrayAlphabet[i]} </small>
                    </div>
               
                    <label for="" class="col-1 text-center">Bobot </label>
                    <div class="col-2">
                        <input type="text" name="answerBobot[]" id="" class="form-control form-control-sm" value="0" required>
                        <small>Masukkan Bobot Dari Jawaban</small>
                    </div>
              
                </div>
                `;
            } 
        } else if(optAnswer.value == 'img') {
            for(let i=1;i<=totalIndex;i++){
                html += `
                <div class="form-group row">
                    <label for="" class="col-2">Pilihan  ${arrayAlphabet[i]} </label>
                    <div class="col-7">
                        <div class="mb-0 pb-0">
                            <label for="imgAns_${arrayAlphabet[i]}" class="btn btn-unique mb-0 w-50 mr-2">Upload File Disini</label>
                            <input type="file" name="answerImg[]" id="imgAns_${arrayAlphabet[i]}" class="dp-none file-input" accept="">
                            <small>Nama File : </small>
                        </div>
                        <small>Masukkan isi Jawaban pada pilihan  ${arrayAlphabet[i]} </small>
                    </div>

                    <label for="" class="col-1">Bobot </label>
                    <div class="col-2">
                        <input type="text" name="answerBobot[]" id="" class="form-control form-control-sm" value="0" required>
                        <small>Masukkan Bobot Dari Jawaban</small>
                    </div>
                </div> 
                `;
            } 
        }

        targetContainer.innerHTML = html;
    }

    function changeTrueAnswerOpt(totalAnswer) {
        let trueAnswerOpt = document.querySelector('#trueAnswer');

        if(trueAnswerOpt != null){
            let opt = '';
            for(let i=1; i<=totalAnswer.value; i++){
                opt += `
                    <option value="${arrayAlphabet[i]}"> ${arrayAlphabet[i]} </option>
                `;
            } 

            trueAnswerOpt.innerHTML = opt;
        }
    }
    
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