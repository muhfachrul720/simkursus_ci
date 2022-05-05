<div class="row pt-5 justify-content-center">
    <div class="col-12 text-center">

        <h3>Selamat Datang Admin Soal</h3>
        
        <p>Berikut merupakan ringkasan mengenai Soal, Ujian dan Peserta</p>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-9">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="cst-card card-bg-unique">
                    <p class="pb-0 mb-0">Total Soal</p>
                    <h1 style="font-size:80px;" class="my-4"><?= $c_soal['total'] ?></h1> 
                    <span>Soal </span>
                </div>
                <a href="<?= base_url() ?>user/admin/soal/list_soal" class="btn btn-unique w-100 mt-4">Lihat Rincian</a>
            </div>
            <div class="col-4">
                <div class="cst-card card-bg-unique">
                    <p class="pb-0 mb-0">Total Ujian</p>
                    <h1 style="font-size:80px;" class="my-4"><?= $c_ujian['total'] ?></h1> 
                    <span>Ujian </span>
                </div>
                <a href="<?= base_url() ?>user/ujian/list_ujian" class="btn btn-unique w-100 mt-4">Lihat Rincian</a>
            </div>
            <div class="col-4">
                <div class="cst-card card-bg-unique">
                    <p class="pb-0 mb-0">Total Peserta</p>
                    <h1 style="font-size:80px;" class="my-4"><?= $c_peserta['total'] ?></h1> 
                    <span>Ujian </span>
                </div>
                <a href="<?= base_url() ?>user/admin/student" class="btn btn-unique w-100 mt-4">Lihat Rincian</a>
            </div>
        </div>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-9">
        <h5 class="text-center">Ujian Yang Sedang berjalan</h5>
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
                            <a href="<?= base_url()?>user/ujian/detail_ujian/<?= $l['id']?>" class="btn btn-info btn-sm"><i class="fas fa-info px-1"></i></a>
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
