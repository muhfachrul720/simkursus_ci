<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Halaman Pengelolaan Akses Menu</h3>
                        <p>Berikut merupakan halaman untuk mengelola menu yang dapat diakses oleh level tertentu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap table-font-sm" id="simpleTable" style="width:100% !important; font-size:12px" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Level Pengakses</th>
                                    <th>Menu yang dapat diakses</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($list as $l) {?>
                                    <tr>
                                        <td width="5%"><?= $no ?></td>
                                        <td width="10%"><?= ucwords($l['nama'])?></td>
                                        <td width="40%"><?= ucwords($l['list_menu'])?></td>
                                        <td width="5%">
                                            <a href="<?= base_url()?>superadmin/access/access_edit/<?= $l['id']?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
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

</div>
