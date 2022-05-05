<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Halaman <?= $setting['page'] ?> Peserta</h3>
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
                    <h6 style="font-weight:bold">Informasi Akun Peserta</h6>
                    <hr>

                    <div class="form-group row">
                        <label for="" class="col-1">Username</label>
                        <div class="col-5">
                            <input type="text" name="usernamePeserta" id="" class="form-control form-control-sm" value="" placeholder="Contoh : MuridSatu" required>
                            <small>Masukkan Username dari peserta, untuk melakukan autentikasi ketika ingin mengikuti Ujian</small>
                        </div>

                        <label for="" class="col-1">Password</label>
                        <div class="col-5">
                            <input type="text" name="passwordPeserta" id="" class="form-control form-control-sm" value="" placeholder="Contoh : Murid Satu">
                            <small>Masukkan Password dari peserta, jika password kosong maka password akan menjadi Nomor induk Peserta  </small>
                        </div>
                    </div>

                </div>  
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-weight:bold">Informasi Umum Peserta</h6>
                    <hr>

                    <div class="form-group row">
                        <label for="" class="col-1">Nomor Induk Peserta </label>
                        <div class="col-5">
                            <input type="text" name="nomorIndukPeserta" id="" class="form-control form-control-sm" value="" placeholder="Contoh : 012414241QAP" required disabled>
                            <small>Nomor Induk Peserta akan digenerate dengan sendirinya</small>
                        </div>

                        <label for="" class="col-1">Nama Lengkap Peserta</label>
                        <div class="col-5">
                            <input type="text" name="namaLengkapPeserta" id="" class="form-control form-control-sm" value="" placeholder="Contoh : Andi Muhammad Yusuf Maulana Khair">
                            <small>Masukkan Nama Lengkap Peserta</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-1">Jenis Kelamin</label>
                        <div class="col-5">
                            <?= form_dropdown('jenisKelamin', array(
                                'L' => 'Laki - Laki', 
                                'P' => 'Perempuan', 
                            ), '', 'class="form-control form-control-sm" required')?>
                            <small>Pilih Jenis Kelamin Peserta</small>
                        </div>

                        <label for="" class="col-1">Nomor Handphone</label>
                        <div class="col-5">
                            <input type="text" name="noHPPeserta" id="" class="form-control form-control-sm" value="" placeholder="Contoh : 081424424442">
                            <small>Masukkan Nomor Handphone Peserta</small>
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