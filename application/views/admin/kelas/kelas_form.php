<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Halaman Detail Kelas</h3>
                        <p>Berikut merupakan halaman detail dari kelas</p>
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
    <?= form_hidden('id', $inkelas['id']) ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-weight:bold">Informasi Kelas</h6>
                    <hr>

                    <div class="form-group row">
                        <label for="" class="col-1">Nama Kelas </label>
                        <div class="col-11">
                            <input type="text" name="namaKelas" id="" class="form-control form-control-sm" value="<?= $inkelas['kelas_nama']?>" placeholder="Contoh : TEKNIK KOMPUTER JARINGAN">
                            <small>Masukkan nama kelas disini</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-1">Alias Kelas</label>
                        <div class="col-5">
                            <input type="text" name="aliasKelas" id="" class="form-control form-control-sm" value="<?= $inkelas['kelas_alias']?>" placeholder="Contoh : TKJ">
                            <small>Masukkan alias kelas disini, yakin singkatan kelas</small>
                        </div>

                        <label for="" class="col-1">Jenis Kelas</label>
                        <div class="col-5">
                            <?= form_dropdown('jenisKelas', array('Teknologi' => 'Teknologi', 'Kriya' => 'Kriya'), $inkelas['kelas_jenis'], 'class="form-control form-control-sm"')?>
                            <small>Pilih Jenis Kelas Disini</small>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-weight:bold">Mata Pelajaran Yang Diprogram Kelas</h6>
                    <hr>

                    <div class="form-group row">
                        <label for="" class="col-3">Pilih Mapel</label>
                        <div class="col-5">
                           <select class="form-control form-control-sm" id="mapelOpt">     
                                <?php foreach($mapel as $mp) {?>
                                    <option value="<?= $mp['id']?>"><?= $mp['guru_nama'].' | '.$mp['mapel_nama'].' | '.$mp['mapel_kode'].$mp['guru_kode']?></option>
                                <?php }; ?>
                           </select>
                        </div> <div class="col-1"></div>
                        <button type="button" class="col-3 w-100 btn btn-unique" id="addMapelBtn"><i class="fas fa-plus pr-1"></i> Tambah Mapel</button>
                    </div>

                    <hr>
                    
                    <div class="form-group" id="bodyAppendMapel">

                        <?php $id_mapel = '';if(isset($regist_mapel)){
                                foreach($regist_mapel as $g) { $id_mapel .= $g['id'].','?>
                                <label for="" class="btn-unique py-1 px-2 infoMapel" style="border-radius:3px;"><?= $g['guru_nama'].' | '.$g['mapel_nama'].' | '.$g['mapel_kode'].$g['guru_kode']?>
                                    <button type="button" class="deleteBtn" style="background:transparent; border:none; padding:0; margin-left:10px;" value="<?= $g['id_ajar'] ?>">
                                        <i class="fas fa-trash-alt" style="color:red"></i>
                                    </button>
                                </label>
                        <?php }} ?>

                    </div>
                    <small style="color:red;"></small>

                    <input type="hidden" name="id_ajar" id="idMapelGuru" value="<?= $id_mapel ?>">

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

   


</script>