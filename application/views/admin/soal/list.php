<?php
    function outputTtlSoal($array, $num){

        if(isset($array[$num])){
            return $array[$num]['total_soal'];
        }

        return 0;
    }
?>

<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Daftar Soal</h3>
                        <p>Berikut merupakan halaman untuk menambahkan data soal ke dalam bank soal, soal dibagi menjadi 3 yakni TKD-A, Kecermatan, Kepribadian</p>
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
        <div class="col-8">
            <div class="cst-card card-bg-unique">
                <div class="row">
                    <div class="col-3">
                        <p class="pb-0 mb-0">Kecermatan</p>
                        <h1><?= $kcm ?></h1> 
                        <span>Soal </span>
                    </div>
                    <div class="col-2" style="border-left:solid 2px white">
                        <label for="" style="padding:2px 0px;">Kolom 1 : <?php echo outputTtlSoal($kolom_kcm, 0) ?> Soal</label> <br>
                        <label for="" style="padding:2px 0px;">Kolom 2 : <?php echo outputTtlSoal($kolom_kcm, 1) ?> Soal</label> <br>
                        <label for="" style="padding:2px 0px;">Kolom 3 : <?php echo outputTtlSoal($kolom_kcm, 2) ?> Soal</label> <br>
                    </div>
                    <div class="col-2">
                        <label for="" style="padding:2px 0px;">Kolom 4 : <?php echo outputTtlSoal($kolom_kcm, 3) ?> Soal</label> <br>
                        <label for="" style="padding:2px 0px;">Kolom 5 : <?php echo outputTtlSoal($kolom_kcm, 4) ?> Soal</label> <br>
                        <label for="" style="padding:2px 0px;">Kolom 6 : <?php echo outputTtlSoal($kolom_kcm, 5) ?> Soal</label> <br>
                    </div>
                    <div class="col-2">
                        <label for="" style="padding:2px 0px;">Kolom 7 : <?php echo outputTtlSoal($kolom_kcm, 6) ?> Soal</label> <br>
                        <label for="" style="padding:2px 0px;">Kolom 8 : <?php echo outputTtlSoal($kolom_kcm, 7) ?> Soal</label> <br>
                        <label for="" style="padding:2px 0px;">Kolom 9 : <?php echo outputTtlSoal($kolom_kcm, 8) ?> Soal</label> <br>
                    </div>
                    <div class="col-2">
                        <label for="" style="padding:2px 0px;">Kolom 10 : <?php echo outputTtlSoal($kolom_kcm, 9) ?> Soal</label> <br>
                    </div>
                </div>
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
        <a href="<?= base_url('user/admin/soal/add_soal') ?>" class="btn btn-unique"><i class="fas fa-plus"></i> Tambahkan Data Soal</a>

        <a href="" class="btn btn-unique"><i class="fas fa-sync-alt"></i> Muat Ulang Halaman</a>

        <?= form_open('user/admin/soal/list_soal')?>
            <?= form_dropdown('filter', array('' => 'Tidak Ada','tkd' => 'TKD-A', 'kcm' => 'Kecermatan', 'kpb' => 'Kepribadian'), '', 'class="dropdown-cst"')?>
            <button type="submit" class="btn btn-unique"><i class="fas fa-filter"></i> Filter Daftar</button>
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
                        <table class="table table-striped table-bordered table-font-sm" id="simpleTable" style="width:100% !important; font-size:12px" >
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kode Soal</th>
                                    <th>Jenis Soal</th>
                                    <th>Bobot Soal</th>
                                    <th>Isi Soal</th>
                                    <th>Kolom Soal</th>
                                    <th>Pembuat Soal</th>
                                    <th>Tanggal Dimasukkan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $arrayJenis = ['tkd' => 'TKD-A', 'kcm' => 'Kecermatan', 'kpb' => 'Kepribadian']; $i=1; foreach($list as $l){ ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $l['kode_soal']?></td>
                                    <td><?= $arrayJenis[$l['jenis_soal']] ?></td>
                                    <td><?= $l['bobot_soal']?></td>
                                    <td width="30%"><?= substr($l['isi_soal'], 0, 150)?>...</td>
                                    <td><?= $l['kolom_soal']?></td>
                                    <td><?= $l['nama_pengguna']?></td>
                                    <td><?= dateindo($l['tanggal_input'])?></td>
                                    <td>
                                        <!-- <a href="<?= base_url() ?>user/admin/soal/detail_soal/<?= $l['id']?>" class="btn btn-info" style="padding:4px 10px;"><i class="fas fa-info"></i></a> -->
                                        <a href="<?= base_url() ?>user/admin/soal/edit_soal/<?= $l['id']?>" class="btn btn-warning" style="padding:4px 5px;"><i class="fas fa-pencil-alt"></i></a>

                                        <button value="<?= $l['id']?>" class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php $i++; }; ?>
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
                        
                        <?= form_open('user/admin/soal/delete_soal') ?>
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