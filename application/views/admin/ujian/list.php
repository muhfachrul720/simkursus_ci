<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Daftar Ujian</h3>
                        <p>Berikut merupakan halaman untuk menjadwalkan ujian</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-2">
            <div class="cst-card card-bg-unique">
                <p class="pb-0 mb-0">TKDA-A</p>
                <h1><?= $tkd ?></h1> 
                <span>Soal </span>
            </div>
        </div>
        <div class="col-2">
            <div class="cst-card card-bg-unique">
                <p class="pb-0 mb-0">Kecermatan</p>
                <h1><?= $kcm ?></h1> 
                <span>Soal </span>
            </div>
        </div>
        <div class="col-2">
            <div class="cst-card card-bg-unique">
                <p class="pb-0 mb-0">Kepribadian</p>
                <h1><?= $kpb ?></h1> 
                <span>Soal </span>
            </div>
        </div>
    </div>
    <hr>

    <div class="button-place mb-3" style="display:flex">
        <a href="<?= base_url('user/ujian/add_ujian') ?>" class="btn btn-unique"><i class="fas fa-plus"></i> Jadwalkan Ujian</a>

        <a href="" class="btn btn-unique"><i class="fas fa-sync-alt"></i> Muat Ulang Halaman</a>

        <?= form_open('user/ujian/list_ujian')?>
            <button type="submit" class="btn btn-unique"><i class="fas fa-filter"></i> Filter Daftar</button>
           <?= form_dropdown('filter', array('' => 'Tidak ada', 'tkd' => 'TKD-A', 'kcm' => 'Kecermatan', 'kpb' => 'Kepribadian'), '', 'class="dropdown-cst"')?>
        <?= form_close()?>
    </div>

    <?php $ck = ''; if($ck = $this->session->flashdata('notif')) {?>
    <div class="row">
        <div class="col-12">
            <label class="w-100 alert alert-<?= explode('|', $ck)[0]?>" for=""><b><?= explode('|', $ck)[1]?></b></label>
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
                                    <th width="5%">No</th>
                                    <th width="5%">Kode Ujian</th>
                                    <th>Judul Ujian dan Token</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Durasi Ujian</th>
                                    <th>Jenis Ujian</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $arrayJenis = ['tkd' => 'TKD-A', 'kcm' => 'Kecermatan', 'kpb' => 'Kepribadian']; $i=1; foreach($list as $l) {?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $l['code_ujian'] ?></td>
                                    <td><?= $l['title_ujian']?> <br> Token : <b><?= $l['token'] ?></b> </td>
                                    <td><?= dateindo( explode(' ', $l['time_start'])[0]) ?> <br> <?= explode(' ', $l['time_start'])[1] ?> </td>
                                    <td><?= $l['time_duration']?> Menit </td>
                                    <td><?= $arrayJenis[$l['type_ujian']] ?></td>
                                    <td>
                                    <?php 
                                        if(strtotime(date('Y-m-d h:i:s')) < strtotime($l['time_end'])) {
                                            echo '<span style="color : green">Belum Selesai</span>';
                                        } else if(strtotime(date('Y-m-d h:i:s')) > strtotime($l['time_end'])) {
                                            echo '<span style="color : red">Telah Selesai</span>';
                                        }
                                    ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url()?>user/ujian/edit_ujian/<?= $l['id']?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="<?= base_url()?>user/ujian/detail_ujian/<?= $l['id']?>" class="btn btn-info btn-sm"><i class="fas fa-info px-1"></i></a>

                                        <button value="<?= $l['id']?>" class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php $i++; };?>
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
                        
                        <?= form_open('user/ujian/delete_ujian') ?>
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