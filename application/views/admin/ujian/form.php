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

    <?php $ck = ''; if($ck = $this->session->flashdata('notif')) {?>
    <div class="row">
        <div class="col-12">
            <label class="w-100 alert alert-<?= explode('|', $ck)[0]?>" for=""><b><?= explode('|', $ck)[1]?></b></label>
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
                        <div class="col-5">
                            <input type="text" name="titleUjian" id="" class="form-control form-control-sm" value="" placeholder="Contoh : Ujian Kompetensi Dasar Kelas A" required>
                            <small>Masukkan judul ujian disini</small>
                        </div>

                        <label for="" class="col-1">Kode Ujian</label>
                        <div class="col-5">
                            <input type="text" name="codeUjian" id="" class="form-control form-control-sm" value="Unknown" placeholder="Contoh : TKJ" disabled>
                            <small>Kode Ujian akan tergenerate dengan sendirinya ketika memasukkan judul dan memilih jenis Soal</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-1">Jenis Ujian</label>
                        <div class="col-3">
                            <?= form_dropdown('typeUjian', array(
                                'tkd' => 'TKD-A', 
                                'kcm' => 'Kecermatan', 
                                'kpb' => 'Kepribadian'
                            ), '', 'class="form-control form-control-sm" id="typeUjian" required')?>
                            <small>Pilih Jenis Ujian</small>
                        </div>

                        <label for="" class="col-1">Acak soal</label>
                        <div class="col-2">
                            <?= form_dropdown('acakUjian', array(
                                'N' => 'Tidak', 
                                'Y' => 'Acak', 
                            ), '', 'class="form-control form-control-sm" id="acakUjian" required')?>
                            <small>Pilih apakah soal diacak atau tidak</small>
                        </div>

                        <label for="" class="col-1">Soal Dari</label>
                        <div class="col-4">
                            <?= cmb_dinamis_where('userQuestion', 'tbl_user', 'nama_pengguna', 'id_user', '', 'ASC', 'user_level', '5') ?>
                            <small>Pilih Pembuat Soal</small>
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
                        <input type="text" name="totalQuestion" class="form-control form-control-sm">
                        <small>Masukkan Jumlah Pertanyaan, <br> Untuk Kecermatan Jumlah pertanyaan dibagi per kolom. Semisal apabila mengisikan 10 maka hanya tampil 10 soal per kolomnya, kolom 1 = 10 soal, kolom 2 = 10 soal dst</small>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-2">Waktu Mulai </label>
                    <div class="col-4">
                        <input type="datetime-local" name="timeStart" class="form-control form-control-sm" required>
                        <small>Pilih Tanggal dan Waktu Ujian Dimulai</small>
                    </div>

                    <label for="" class="col-2">Waktu Berakhir </label>
                    <div class="col-4">
                        <input type="datetime-local" name="timeEnd" class="form-control form-control-sm" required>
                        <small>Pilih Tanggal dan Waktu Ujian Selesai</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-2">Durasi Ujian </label>
                    <div class="col-4">
                        <input type="number" min="1" name="timeDuration" class="form-control form-control-sm" required>
                        <small>Tentukan Durasi Waktu Ujian dalam hitungan menit, Apabila jenis ujian merupakan Kecermatan maka silahkan menulis durasi per - kolom, Semisal 1 kolom sebanyak 2 menit</small>
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
                            <input type="text" name="tokenUjian" id="" class="form-control form-control-sm" value="Unknown" disabled>
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

<script>

    // Toggle disable non disable
    document.querySelector('#typeUjian').addEventListener('change', function(){

        let value = this.value;
        let target = document.querySelector('#acakUjian');

        if(value != 'kcm'){
            target.removeAttribute('disabled')
        } else { target.setAttribute('disabled', 'disabled')}

    });

</script>
<!-- Multiple Add -->
<!-- <script>    

    // Add guru 
    let arrayNamaMapel = []; let arrayIdAjar = [];
    document.querySelectorAll('.infoMapel').forEach(a => {
       arrayNamaMapel.push(a.firstChild.data.trim());
       arrayIdAjar.push(a.getElementsByTagName('button')[0].value);
    });;

    let targetAppend = document.querySelector('#bodyAppendMapel');

    const btnAddGuru = document.querySelector('#addMapelBtn');
    btnAddGuru.addEventListener('click', function() {
        let targetOpt = document.querySelector('#mapelOpt');
        let idAjar = targetOpt.value;
        let namaMapel = targetOpt.options[targetOpt.selectedIndex].text;
        let strAlert = '';

        if(!arrayIdAjar.includes(idAjar)){

            arrayIdAjar.push(idAjar);
            arrayNamaMapel.push(namaMapel);

            let html = ``;   let valuePost = '';
            for(let i=0; i < arrayIdAjar.length; i++){
                valuePost += arrayIdAjar[i]+',';
                html += `
                    <label for="" class="btn-unique py-1 px-2 infoGuru" style="border-radius:3px;">${arrayNamaMapel[i]}
                        <button type="button" class="deleteBtn" style="background:transparent; border:none; padding:0; margin-left:10px;" value="${arrayIdAjar[i]}">
                            <i class="fas fa-trash-alt" style="color:red"></i>
                        </button>
                    </label>
                `;
            }
            
            targetAppend.innerHTML = html;
            document.querySelector('#idMapelGuru').value = valuePost;

        } else {strAlert = 'Guru Telah Terdaftar Pada Mata Pelajaran Ini'};
        targetAppend.nextSibling.nextSibling.innerHTML = strAlert;
    });

    // DeleteBtn
    btnEvent(document.querySelectorAll('.deleteBtn'));

    document.querySelector('#addMapelBtn').addEventListener('click', function(){

        btnEvent(document.querySelectorAll('.deleteBtn'));

    });

    function btnEvent(deleteBtn) {
        deleteBtn.forEach(a => {
            a.addEventListener('click', function(){
                let index = arrayIdAjar.indexOf(a.value);      
                arrayIdAjar.splice(index, 1);

                a.parentElement.remove();

                console.log(a);

                let valuePost = '';
                for(let i=0; i < arrayIdAjar.length; i++){
                    valuePost += arrayIdAjar[i]+',';
                } document.querySelector('#idMapelGuru').value = valuePost;
            });
        });
    }

   


</script> -->