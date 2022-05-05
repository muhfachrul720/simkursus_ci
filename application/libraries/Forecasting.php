<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use MCordingley\LinearAlgebra\Matrix;

class Forecasting {

    public function findKonstanta($triggerArray, $sourceArray, $univLimit, $frgKey = 'id_info_darah', $corelation = null){
        $dataArray = array(); $X = array(); $n = 0; $determinant = []; $tempMatrix;

        // Data Resource
        foreach($triggerArray as $m) {

            // Get Row Jumlah Kasus Change to Column
            foreach ($sourceArray as $key => $value ){
                if($m['id'] == $value[$frgKey]){
                    $X[$n][] = $value['jumlah_kasus'];
                    unset($sourceArray[$key]);
                };
            } 

            // Declare Permintaan dan Bulan
            $dataArray[$n]['bulan'] = $m['bulan'].' / '.$m['tahun'];
            $dataArray[$n]['Y'] = $m['permintaan_darah'];

            // Fill X*y, X^2
            $i = 1;
            foreach($X[$n] as $x){

                $dataArray[$n]['X'.$i] = $x;
                $dataArray[$n]['X'.$i.'*Y'] = $x * $m['permintaan_darah'];
                $dataArray[$n]['X'.$i.'^2'] = pow($x, 2);
                $dataArray[$n]['Y^2'] = pow($m['permintaan_darah'], 2);

                $i++;
            }

            // Fill X times X
            $limit = count($X[$n]); $inc = 1; $break = true;
            while($break){

                $i = $inc + 1; 

                for($i; $i <= $limit; $i++){
                    $dataArray[$n]['X'.$inc.'*X'.$i] = $X[$n][$inc - 1] * $X[$n][$i - 1];
                }

                if($inc >= $limit)
                    $break = false;
                
                $inc++;

            }

            $n++;
        }

        // Get Mean
        $meanPermintaan = $this->findAveragePermintaan($dataArray);

        // Make sum array
        $sumArray['Y'] = $this->sumData($dataArray, 'Y');
        $sumArray['Y^2'] = $this->sumData($dataArray, 'Y^2');

        for($i = 1; $i <= $univLimit; $i++){

            $sumArray['X'.$i]      = $this->sumData($dataArray, 'X'.$i);
            $sumArray['X'.$i.'*Y'] = $this->sumData($dataArray, 'X'.$i.'*Y');
            $sumArray['X'.$i.'^2'] = $this->sumData($dataArray, 'X'.$i.'^2');
        }

        // Fill X times X
        $inc = 1; $break = true;
        while($break){

            $i = $inc + 1; 

            for($i; $i <= $univLimit; $i++){
                $sumArray['X'.$inc.'*X'.$i] =  $this->sumData($dataArray, 'X'.$inc.'*X'.$i);
            }

            if($inc >= $univLimit)
                $break = false;
            
            $inc++;

        }

        // Make Basic Matriks
        $basicMatriks = []; 
        for($i = 0; $i <= $univLimit; $i++){

            for($j = 0; $j <= $univLimit; $j++){
                if($j == 0 && $i == 0){ 
                    $basicMatriks[$i][$j] = count($X); 
                } else if($i == 0){
                    $basicMatriks[$i][$j] = $sumArray['X'.$j];
                } else if ($j == 0){
                    $basicMatriks[$i][$j] = $sumArray['X'.($i)];
                } else if ($i == $j) {
                    $basicMatriks[$i][$j] = $sumArray['X'.$j.'^2'];
                } else {
                    if(!isset($sumArray['X'.$j.'*X'.$i])){
                        $basicMatriks[$i][$j] = $sumArray['X'.$i.'*X'.$j];
                    } else {
                        $basicMatriks[$i][$j] = $sumArray['X'.$j.'*X'.$i];
                    }
                }
            }
        } 

        // Fill Determinant A
        $tempMatrix = new Matrix($basicMatriks); 
        $determinant['A'] = $tempMatrix->determinant();

        // Make subs Matriks
        $substituteMatriks = array();
        // for($i = 0; $i <= $limit; $i++){
        for($i = 0; $i <= $univLimit; $i++){

            if($i == 0)
                array_push($substituteMatriks, $sumArray['Y']); 
            else 
                array_push($substituteMatriks, $sumArray['X'.$i.'*Y']); 
        }

        // Substitute the Subs matriks too basic matriks make a new Matriks and get the determinant
        // for($i = 0; $i <= $limit; $i++){
        for($i = 0; $i <= $univLimit; $i++){
            
            ${"basic" . $i} = $basicMatriks;
            ${"basic" . $i}[$i] = $substituteMatriks;

            $tempMatrix = new Matrix(${"basic" . $i}); 
            $determinant[$i+1] = $tempMatrix->determinant();
        }
        
        // Making Konstanta 
        $return = ''; $const = array();
        for($i = 0; $i <= $limit; $i++){
            $const[$i] = $determinant[$i + 1] / $determinant['A'];
        }   

        if($corelation != null){
            return array($sumArray, $const);
        }

        return $const;
    }

    public function sumData($array, $key){
        $sum = 0;
        foreach($array as $a){
        if(isset($a[$key])){
            $sum = $sum + $a[$key];
            }
        } return intval($sum);
        
    }
    
    private function findAveragePermintaan($params){

        $length = count($params); $sum = 0;

        foreach($params as $p){
            $sum = $sum + $p['Y']; 
        } return intval($sum / $length);

    }

    public function formulaForecasting($const, $variabel) {
        $sum = 0; $index = 0;
        foreach($const as $c){
            if($index == 0) $sum = $const[0];
            else {
                $sum = $sum + ($c * $variabel[$index - 1]);
            }
            $index++;
        } return $sum;
    }
    
    public function findError($ramal, $total){
        return pow(($ramal - $total) , 2);
    }

    public function findCorrelation($sumArray, $n, $nVar){
       $i=1; $corelation = array();
       while($i <= $nVar){
           
        $corelation['rx'.$i.'y'] = 
            ($n * $sumArray['X'.$i.'*Y'] - $sumArray['X'.$i] * $sumArray['Y']) / 
            (sqrt(($n * $sumArray['X'.$i.'^2'] - (pow($sumArray['X'.$i], 2))) * ($n * $sumArray['Y^2'] - (pow($sumArray['Y'], 2)))));
        ;

        $i++;
       }

       return $corelation;
    }

    function debug($params)
    {
        if(is_array($params) == true){
            echo '<pre>';
                print_r($params);
            echo '</pre>';
        } else {
            var_dump($params);
        }
    }
}