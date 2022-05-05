<?php $arrayAlpha = ['A', 'B', 'C', 'D', 'E', 'F']?>
<div class="px-4 py-3">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">

                <div class="col-md-8">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold">Ujian Kompetensi Dasar</h3>
                        <p>Silahkan Mengisi soal dengan baik dan benar </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="page-header-title">
                        <h3 class="m-b-10" style="font-weight:bold; text-align:right" id="countdown">Waktu : </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-3">
            <div class="card">
                <div class="card-body py-3 px-3">
                    <h6 style="font-weight:bold; text-align:center; margin:0;">Navigasi Soal</h6>
                    <hr class="mt-3">

                    <div class="row">

                    <?php for($i = 1; $i <= count($soal); $i++){?>
                        <div class="col-3 mb-2">
                            <button class="btn box navQues" id="navQues_<?= $i ?>" style="width:100%; background-color: gray; padding:5px 0; text-align:center; color:white; font-weight:bold; font-size:20px;" value="<?= $i ?>">
                                <?= $i ?>.?
                            </button>
                        </div>
                    <?php }; ?>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-9">
            <?= form_open('user/ujian/review_ujian'); ?>
            <?= form_hidden('idUjian', $ujian['id']); ?> 

            <input type="hidden" name="timeLeft" id="timeLeft" value="">
            <div class="card">
                <div class="card-body py-3 px-3" id="quesContainer">
                    <h6 style="font-weight:bold; text-align:center; margin:0;">Pertanyaan</h6>
                    <hr class="mt-3">

                    <!-- <?php //for($i = 1; $i <= 10; $i++){ $display = 'dp-block'; if($i > 1){ $display = 'dp-none'; }; ?> -->
                    <?php $i = 1; foreach($soal as $soal) { $display = 'dp-block'; if($i > 1 ){$display = 'dp-none'; }?>
                    <div class="form-group px-3 <?= $display ?> ques" id="ques<?= $i ?>">
                        <div class="form-group row soal-sect" style="font-size:20px;">
                            <input type="hidden" name="idSoal[]" value="<?= $soal['id'] ?>">
                            <span class="pr-2 col-1" style="font-weight:bold"><?= $i ?>.</span> 
                            <div class="col-11 row">
                                <div class="col-12 mb-2">
                                    <?= $soal['isi_soal'] ?>
                                </div>
                                <?php if(count($soal['images']) > 0) {?>
                                    <?php foreach($soal['images'] as $im){?>
                                        <img src="<?= base_url()?>upload/user_images/answer_images/<?= $im['nama_file']?>" alt="" style="width:300px; margin:0 10px;">
                                    <?php }; ?>
                                <?php }; ?>
                            </div>
                        </div>
                        <div class="ans-sect mt-5" id="">  

                            <?php foreach($soal['answer'] as $idx => $ans) {?>
                                <?php if($soal['type_jawaban'] == 'txt') {?>

                                <div class="form-group row">
                                    <div class="col-1">
                                        <!-- <label for="ques1_a" style="width:60%; text-align:center; font-size:16px; border:solid 1px gray; padding:8px 12px; cursor:pointer; border-radius:10px;">A</label> -->
                                        <input type="radio" name="ques[<?= $soal['id'] ?>]" id="ques<?= $soal['id'] ?>_a" data-index="<?= $i ?>" class="ansOpt" value="<?= $arrayAlpha[$ans['opsi_karakter']]?>|<?= $ans['bobot_jawaban']?>">
                                    </div>
                                    <div class="col-11">
                                        <?= $arrayAlpha[$idx]?> . 
                                        <?= $ans['isi_jawaban']?>
                                    </div>
                                </div>

                                <?php } else if($soal['type_jawaban'] == 'img') { ?>

                                <div class="form-group row">
                                    <div class="col-1">
                                        <!-- <label for="ques1_a" style="width:60%; text-align:center; font-size:16px; border:solid 1px gray; padding:8px 12px; cursor:pointer; border-radius:10px;">A</label> -->
                                        <input type="radio" name="ques[<?= $soal['id'] ?>]" id="ques<?= $soal['id'] ?>_a" data-index="<?= $i ?>" class="ansOpt" value="<?= $arrayAlpha[$ans['opsi_karakter']]?>|<?= $ans['bobot_jawaban']?>">
                                    </div>
                                    <div class="col-11">
                                        <?= $arrayAlpha[$idx]?> . 
                                        <img src="<?= base_url()?>upload/user_images/answer_images/<?=$ans['nama_gambar']?>" alt="" width="150px" style="border:solid 1px gray">
                                    </div>
                                </div>

                                <?php }; ?>
                            <?php }; ?>

                        </div>
                    </div>
                    <?php  $i++; }; ?>
                    <!-- <?php  //}; ?> -->

                    <hr>
                    <div class="form-group px-3" style="display:flex; justify-content: space-between">
                        <button type="button" class="btn btn-unique-failed" id="prvBtn" value="0">Sebelumnya</button>
                        <button type="button" class="btn btn-unique dp-block" id="nextBtn" value="2">Selanjutnya</button>

                        <button type="button"class="btn btn-unique-success dp-none" data-toggle="modal" data-target="#submitModal" id="submitBtn">Selesai Ujian</button>
                    </div>
                    
                </div>
            </div>

            <!-- Modal Yakin Tidak -->
            <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered w-25" role="document">
                    <div class="modal-content">
                        <div class="modal-body">

                                <h6 class="text-center">Sebelum Menyelesaikan Ujian, pastikan soal keseluruhan telah dijawab</h6>
                                <div class="text-center mb-3">
                                    <small class="">Anda Memiliki Sisa Waktu : </small>
                                </div>
                                <div class="form-group text-center m-0">
                                    <button type="button" data-dismiss="modal" class="btn-secondary btn-sm btn">Periksa Kembali</button>
                                    <button type="submit" class="btn btn-unique-success" >Selesai Ujian</button>
                                </div>

                        </div>
                    </div>
            </div>

            <?= form_close(); ?>
        </div>

    </div>

</div>

<script>

    // Start Coundown
    countdown("countdown", <?= $ujian['time_duration']?>, 0);

    // Nav Button
    const navQues = document.querySelectorAll('.navQues');
    const quesContainer = document.querySelector('#quesContainer');
    const prvBtn = document.querySelector('#prvBtn');
    const nextBtn = document.querySelector('#nextBtn');
    const subBtn = document.querySelector('#submitBtn'); 

    const allOptBtn = document.querySelectorAll('.ansOpt');

    let questionNow = 1;

    navQues.forEach(a => {
        a.addEventListener('click', event => {
            let indexVal = a.value;

            document.querySelector('.dp-block').classList.add('dp-none');
            document.querySelector('.dp-block').classList.remove('dp-block');

            changeQuestion(indexVal);
            
            nextBtn.value = parseInt(indexVal) + 1;
            prvBtn.value = parseInt(indexVal) - 1;

            questionNow = a.value;

            showBtnSubmit();
        })
    });
    
    // Next Button
    nextBtn.addEventListener('click', event => {
        let val = parseInt(prvBtn.value);
        let nextVal = parseInt(nextBtn.value);
        if(val < <?= $i - 2?>){
            changeQuestion(nextBtn.value, prvBtn.value);
            prvBtn.value = val + 1;
            nextBtn.value = nextVal + 1;
            
            questionNow++;
        }

        showBtnSubmit();
    });

    // Prv Button
    prvBtn.addEventListener('click', event => {
        let val = parseInt(prvBtn.value);
        let nextVal = parseInt(nextBtn.value);
        
        if(val > 0){
            changeQuestion(prvBtn.value, nextBtn.value);
            prvBtn.value = val - 1;
            nextBtn.value = nextVal - 1;

            questionNow--;
        }

        showBtnSubmit();
    });

    // Opt Coloring Nav
    allOptBtn.forEach(a => {
        a.addEventListener('click', event => {
            let index = a.dataset.index;
            let value = a.value.split('|')[0];

            let navBtn = document.querySelector('#navQues_'+index);

            // console.log(navBtn);
            navBtn.style.backgroundColor = 'green';
            navBtn.innerHTML = index+'.'+value;
        });
    });

    // CountDown
    function countdown( elementName, minutes, seconds ){
        var element, endTime, hours, mins, msLeft, time;

        function twoDigits( n )
        {
            return (n <= 9 ? "0" + n : n);
        }

        function updateTimer()
        {
            msLeft = endTime - (+new Date);
            if ( msLeft < 1000 ) {
                // Submit form
                document.querySelector("button[type='submit']").click();
                
            } else {
                time = new Date( msLeft );
                hours = time.getUTCHours();
                mins = time.getUTCMinutes();

                let html = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );

                element.innerHTML = 'Waktu : '+html;
                setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );

                document.querySelector('#timeLeft').value = html;
            }
        }

        element = document.getElementById( elementName );
        endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
        updateTimer();
    }

    // Function
    function changeQuestion(nextIndex, prevIndex = null) {

        if(prevIndex != null){
            document.querySelector('#ques'+questionNow).classList.remove('dp-block');
            document.querySelector('#ques'+questionNow).classList.add('dp-none');
        }

        document.querySelector('#ques'+nextIndex).classList.remove('dp-none');
        document.querySelector('#ques'+nextIndex).classList.add('dp-block');
    }

    function showBtnSubmit() {

        console.log(questionNow);
        if(questionNow == <?= $i-1 ?>){
            console.log('Hello');

            nextBtn.classList.remove('dp-block');
            nextBtn.classList.add('dp-none');

            subBtn.classList.remove('dp-none');
            subBtn.classList.add('dp-block');
        } else {
            subBtn.classList.remove('dp-block');
            subBtn.classList.add('dp-none');

            nextBtn.classList.remove('dp-none');
            nextBtn.classList.add('dp-block');
        }
    }
    
    

</script>