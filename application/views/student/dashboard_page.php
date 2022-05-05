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
            <div class="col-12">
                <div class="cst-card card-bg-unique">
                    <p class="pb-0 mb-0">Total Ujian</p>
                    <h1 style="font-size:80px;" class="my-4"><?= $total['total'] ?></h1> 
                    <span>Ujian </span>
                </div>
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
                        <th>Judul Ujian</th>
                        <th>Tanggal Mulai - Selesai</th>
                        <th>Durasi Ujian</th>
                        <th>Jenis Ujian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  $arrayJenis = ['tkd' => 'TKD-A', 'kcm' => 'Kecermatan', 'kpb' => 'Kepribadian']; $no = 1; foreach($list as $list){ ?>
                        <?php if($list['total_skor'] == '') {?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $list['code_ujian'] ?></td>
                            <td><?= $list['title_ujian'] ?></td>
                            <td><?= dateindo($list['time_start']) .' S/d <br>'. dateindo($list['time_end'])?></td>
                            <td><?= $list['time_duration'] ?> Menit</td>
                            <td><?= $arrayJenis[$list['type_ujian']] ?></td>
                            <td class="text-center">
                                <button value="<?= $list['id']?>" class="btn btn-unique btnToken" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-pencil-alt pr-2"></i>Ikuti Ujian</button>
                            </td>
                        </tr>
                        <?php }; ?>
                    <?php ; }?>

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

