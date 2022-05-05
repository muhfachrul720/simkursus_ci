<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Halaman Pengelolaan Menu</h3>
                        <p>Berikut merupakan halaman untuk mengelola menu - menu dari sistem yang akan dibentuk nantinya </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="button-place mb-3">
        <a href="<?= base_url('superadmin/menu/menu_add') ?>" class="btn btn-unique"><i class="fas fa-plus"></i> Tambah Menu Sistem</a>

        <button class="btn btn-unique"><i class="fas fa-bars"></i> List Sub Menu</button>
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
                    <h6 class="mb-0">Menu Induk</h6>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap table-font-sm" id="simpleTable" style="width:100% !important; font-size:12px" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id</th>
                                    <th>Nama Menu</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Jumlah Sub Menu</th>
                                    <th>Icon</th>
                                    <th>Url</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($list as $l) {?>
                                    <tr>
                                        <td width="5%"><?= $no ?></td>
                                        <td><?= ucwords($l['id_menu'])?></td>
                                        <td><?= ucwords($l['title'])?></td>
                                        <td><?= ucwords($l['date_created'])?></td>
                                        <td><?= isset($l['total_sub']) ? $l['total_sub'] : 0 ?></td>
                                        <td class="text-center"><i class="<?= $l['icon']?>"></i> <br> <?= $l['icon']?></td>
                                        <td><?= ucwords($l['url'])?></td>
                                        <td width="10%">
                                            <a href="<?= base_url()?>superadmin/menu/menu_edit/<?= $l['id_menu']?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <button value="<?= $l['id_menu']?>" class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i>
                                        </td>
                                    </tr>
                                <?php $no++; }; ?>
                            </tbody>
                        </table>
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
        
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-0">Sub Menu</h6>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap table-font-sm" id="subTable" style="width:100% !important; font-size:12px" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Tanggal Dibuat</th>
                                    <th width="5%">Induk Menu (id)</th>
                                    <th>Icon</th>
                                    <th>Url</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($listsub as $l) {?>
                                    <tr>
                                        <td width="5%"><?= $no ?></td>
                                        <td><?= ucwords($l['title'])?></td>
                                        <td><?= ucwords($l['date_created'])?></td>
                                        <td><?= ucwords($l['is_main_menu'])?></td>
                                        <td class="text-center"><i class="<?= $l['icon']?>"></i> <br> <?= $l['icon']?></td>
                                        <td><?= ucwords($l['url'])?></td>
                                        <td width="10%">
                                            <a href="<?= base_url()?>superadmin/menu/menu_edit/<?= $l['id_menu']?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <button value="<?= $l['id_menu']?>" class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i>
                                        </td>
                                    </tr>
                                <?php $no++; }; ?>
                            </tbody>
                        </table>
                        <script>
                                $(document).ready(function() {
                                    $('#subTable').DataTable({
                                        // "lengthChange": false,
                                        // "searching" : false,
                                    });
                                } );
                        </script>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-25" role="document">
            <div class="modal-content">
                <div class="modal-body">
                        
                        <?= form_open('superadmin/menu/menu_delete') ?>
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