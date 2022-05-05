<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Halaman Data Tenaga Pengajar (Guru)</h3>
                        <p>Berikut merupakan halaman untuk mengelola tenaga pelajar , terlebih guru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="button-place mb-3">
        <a href="<?= base_url('admin/guru/guru_add') ?>" class="btn btn-unique"><i class="fas fa-plus"></i> Tambah Mata Pelajaran</a>

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
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>NIP</th>
                                    <th>Nama Guru</th>
                                    <th>Durasi Ajar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($list as $l) {?>
                                    <tr>
                                        <td width="5%"><?= $no ?></td>
                                        <td><?= ucwords($l['guru_kode'])?></td>
                                        <td><?= ucwords($l['guru_nip'])?></td>
                                        <td><?= ucwords($l['guru_nama'])?> </td>
                                        <td><?= ucwords($l['guru_jam_ajar'])?> Jam </td>
                                        <!-- <td><?php //ucwords($l['total_guru'])?></td> -->
                                        <td width="10%">
                                            <a href="<?= base_url()?>admin/guru/guru_edit/<?= $l['id']?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <button value="<?= $l['id']?>" class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i>
                                        </td>
                                    </tr>
                                <?php $no++; }; ?>
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