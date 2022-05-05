<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Ujian</h3>
                        <p>Berikut merupakan halaman berisikan daftar daftar ujian</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-3">
            <div class="cst-card card-bg-unique">
                <p class="pb-0 mb-0">Ujian Yang Berlangsung</p>
                <h1><?= $totalJalan?></h1> 
                <span>Ujian</span>
            </div>
        </div>
        <!-- <div class="col-3">
            <div class="cst-card card-bg-unique">
                <p class="pb-0 mb-0">Ujian Telah Selesai</p>
                <h1>2</h1> 
                <span>Ujian</span>
            </div>
        </div> -->
    </div>

    <hr>

    <div class="button-place mb-3" style="display:flex">

        <a href="" class="btn btn-unique"><i class="fas fa-sync-alt"></i> Muat Ulang Halaman</a>

        <?= form_open()?>
            <button type="submit" class="btn btn-unique"><i class="fas fa-filter"></i> Filter Daftar</button>
           <?= form_dropdown('filterList', array('' => 'Tidak ada', 'tkd' => 'TKD-A', 'kcm' => 'Kecermatan', 'kpb' => 'Kepribadian'), '', 'class="dropdown-cst"')?>
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
                                    <th>Judul Ujian</th>
                                    <th>Tanggal Mulai - Selesai</th>
                                    <th>Durasi Ujian</th>
                                    <th>Jenis Ujian</th>
                                    <th>Skor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $arrayJenis = ['tkd' => 'TKD-A', 'kcm' => 'Kecermatan', 'kpb' => 'Kepribadian']; $no = 1; foreach($list as $list){?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $list['code_ujian'] ?></td>
                                        <td><?= $list['title_ujian'] ?></td>
                                        <td><?= dateindo($list['time_start']) .' S/d <br>'. dateindo($list['time_end'])?></td>
                                        <td><?= $list['time_duration'] ?> Menit</td>
                                        <td><?= $arrayJenis[$list['type_ujian']] ?></td>
                                        <td><?= $list['total_skor'] ?></td>
                                        <td class="text-center">
                                            <?php if(strtotime($list['time_start']) <= strtotime(date('Y-m-d')) && strtotime(date('Y-m-d')) <= strtotime($list['time_end'])) {?>
                                                <?php if($list['total_skor'] != '') {?>
                                                    <label for="" class="btn btn-unique-success">Telah Dikerjakan</label>
                                                <?php } else {?>  
                                                    <button value="<?= $list['id']?>" class="btn btn-unique btnToken" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-pencil-alt pr-2"></i>Ikuti Ujian</button>
                                                <?php };?>
                                            <?php } else if(strtotime($list['time_start']) > strtotime(date('Y-m-d'))) {?>
                                                <label for="" class="btn btn-unique-warning">Akan Datang</label>
                                            <?php } else if(strtotime(date('Y-m-d')) > strtotime($list['time_end'])) { ?>
                                                <label for="" class="btn btn-unique-failed">Telah Lewat</label>
                                            <?php }; ?>
                                        </td>
                                    </tr>
                                <?php $no++; }?>

                                <!-- <tr>
                                    <td>1</td>
                                    <td>TKDA2921</td>
                                    <td>Ujian Kompetensi Dasar Bagian A</td>
                                    <td>29 November 2021</td>
                                    <td>60 Menit</td>
                                    <td>TKD-A</td>
                                    <td class="text-center">
                                        <label href="" class="btn btn-unique-failed m-0"><i class="fas fa-times pr-2"></i> Terlewati</label>
                                    </td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>TKDA2921</td>
                                    <td>Ujian Kompetensi Dasar Bagian A</td>
                                    <td>29 November 2021</td>
                                    <td>60 Menit</td>
                                    <td>TKD-A</td>
                                    <td class="text-center">
                                        <label href="" class="btn btn-unique-success m-0"><i class="fas fa-check pr-2"></i> Selesai</label>
                                    </td>
                                </tr>  -->
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
                        
                        <?= form_open('user/ujian/ikut_ujian') ?>
                        <input type="hidden" name="id" id="idExam" value="">

                        <h6 class="mb-3" style="font-weight:bold">Masukkan Token</h6>
                        <div class="form-group">
                            <input type="text" name="tokenExam"  id="" class="form-control form-control-sm">
                        </div>
                        <div class="form-group m-0">
                            <button type="button" data-dismiss="modal" class="btn-secondary btn-sm btn">Cancel</button>
                            <button type="submit" id="confirmDelBtn" class="btn btn-sm btn-unique">Mulai Ujian</button>
                        </div>
                        <?= form_close() ?>
                </div>
            </div>
    </div>

    <script>
        const btn = document.querySelectorAll('.btnToken');
        
        for(let i=0; i < btn.length; i++){
            btn[i].addEventListener('click', function(){
                document.querySelector('#idExam').value = this.value;
            });
        }

    </script>

</div>