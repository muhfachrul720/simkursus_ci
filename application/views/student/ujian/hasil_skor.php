<?php $arrayAlpha = ['A', 'B', 'C', 'D', 'E', 'F']?>
<div class="px-4 py-3 mt-5">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center justify-content-center">

                <div class="col-md-8 mt-5">
                    <div class="page-header-title text-center">
                        <h3 class="m-b-10" style="font-weight:bold">Hasil Ujian Kamu</h3>
                        <p class="m-0">Anda mendapatkan Skor :  </p>
                    </div>
                </div>

                <div class="col-md-8 my-4 text-center">
                    <h1 style="font-weight:bold; font-size: 150px"><?= $total_skor ?></h1>
                </div>

                <!-- <div class="col-12 mb-3 text-center">
                    <h3 class="m-b-10" style="font-weight:bold">Dengan Detail :</h3>
                </div> -->

            </div>

            <!-- <div class="row align-items-center text-center justify-content-center">
                <div class="col-4">
                    Jawaban Benar : 
                    <h1 style="font-weight:bold; font-size: 100px; color: green;"><?= $jumlah_benar ?></h1>
                </div>
                <div class="col-4">
                    Jawaban Salah : 
                    <h1 style="font-weight:bold; font-size: 100px; color: red;"><?= $jumlah_salah ?></h1>
                </div>
                <div class="col-4">
                    Jawaban Tidak Terjawab : 
                    <h1 style="font-weight:bold; font-size: 100px; color: gray;"><?= $jumlah_tidak_dijawab ?></h1>
                </div>
            </div> -->

            <div class="row align-items-center text-center justify-content-center mt-5">
                <div class="col-4">
                    <a href="<?= base_url('user/ujian/list_student_ujian') ?>" class="btn btn-unique w-100">Lanjutkan</a>
                </div>
            </div>
        </div>
    </div>
    
</div>
