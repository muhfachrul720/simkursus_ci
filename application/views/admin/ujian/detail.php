<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Detail Ujian dan Rangking Siswa dalam Ujian</h3>
                        <p>Berikut merupakan halaman informasi mengenai ujian beserta dengan siswa yang mengikuti dan nilainya masing masing</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <div class="cst-card card-bg-unique">
                <p class="pb-0 mb-0">TOP RANGKING #1</p>
                <h1><?php 
                        if(count($list) <= 0){
                            echo 'Belum ada siswa <br> yang mengikuti Ujian';
                        } else {echo $list[0]['nama_lengkap'];}
                    ?>
                </h1> 
                <span>Skor : <?php if(count($list) <= 0){ echo '-';} else {echo $list[0]['total_skor']; } ?></span>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body pb-2">
                    <div class="row form-group mb-0">
                        <label for="" class="col-2">Judul :</label>
                        <div class="col-10">
                            <p><?= $ujian['title_ujian']?></p>
                        </div>
                    </div>

                    <div class="row form-group mb-0">
                        <label for="" class="col-2">Token :</label>
                        <div class="col-2">
                            <p><?= $ujian['token']?></p>
                        </div>

                        <label for="" class="col-4">Kode Ujian :</label>
                        <div class="col-4">
                            <p><?= $ujian['code_ujian'] ?></p>
                        </div>
                    </div>

                    <div class="row form-group mb-0">
                        <label for="" class="col-2">Durasi:</label>
                        <div class="col-2">
                            <p><?= $ujian['time_duration'] ?> Menit</p>
                        </div>

                        <label for="" class="col-2">Soal:</label>
                        <div class="col-2">
                            <p><?= $ujian['total_question'] ?></p>
                        </div>

                        <label for="" class="col-2">Siswa:</label>
                        <div class="col-2">
                            <p><?= count($list) ?></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="button-place mb-3" style="display:flex">
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

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap table-font-sm" id="simpleTable" style="width:100% !important; font-size:12px" >
                            <thead>
                                <tr>
                                    <th width="5%">Rangking</th>
                                    <th>Nama Siswa</th>
                                    <th>Skor</th>
                                    <!-- <th>Tersisa Waktu</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($list as $l) {?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $l['nama_lengkap']?></td>
                                        <td><?= $l['total_skor'] ?></td>
                                        <!-- <td><?php //$l['sisa_durasi'] ?></td> -->
                                    </tr>
                                <?php }; ?>
                            </tbody>
                        </table>
                    </div>

                    <script>
                            $(document).ready(function() {
                                $('#simpleTable').DataTable({
                                    // "lengthChange": false,   
                                    // "searching" : false,
                                });
                            } );
                    </script>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-25" role="document">
            <div class="modal-content">
                <div class="modal-body">
                        
                        <?= form_open('admin/guru/guru_delete') ?>
                        <input type="hidden" name="id" id="idUserDelete" value="">

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
        
        for(let i=0; i < btn.length; i++){
            btn[i].addEventListener('click', function(){
                document.querySelector('#idUserDelete').value = this.value;
            });
        }

    </script>

</div>