<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Daftar Peserta Ujian</h3>
                        <p>Berikut merupakan yang menampilkan daftar peserta yang dapat ikut ujian</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-2">
            <div class="cst-card card-bg-unique">
                <p class="pb-0 mb-0">Total Peserta</p>
                <h1><?= count($list); ?></h1> 
                <span>Peserta </span>
            </div>
        </div>
    </div>
    <hr>

    <div class="button-place mb-3" style="display:flex">
        <a href="<?= base_url('user/admin/student/add_student') ?>" class="btn btn-unique"><i class="fas fa-plus"></i> Tambahkan Peserta</a>

        <a href="" class="btn btn-unique"><i class="fas fa-sync-alt"></i> Muat Ulang Halaman</a>
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
                                    <th width="5%">Nomor Induk Peserta</th>
                                    <th>Nama Lengkap Peserta</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($list as $l) {?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $l['nomor_induk']; ?></td>
                                    <td><?= $l['nama_lengkap'] ; ?></td>
                                    <td><?= $l['username']; ?></td>
                                    <td><?= $l['visible_pass'] ; ?></td>
                                    <td>
                                        <a href="<?= base_url()?>user/admin/student/edit_student/<?= $l['stdID']?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>

                                        <button value="<?= $l['stdID']?>" class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php $i++; };?>
                            </tbody>
                        </table>
                    </div>

                    <script>
                            $(document).ready(function() {
                                $('#simpleTable').DataTable({
                                    "iDisplayLength": 2,   
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
                        
                        <?= form_open('user/admin/student/delete_student') ?>
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