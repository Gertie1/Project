<?php
/**
 * Created by PhpStorm.
 * User: gety
 * Date: 11/24/2016
 * Time: 12:35 PM
 */

include 'HODClient1.php';
// include db connect class
require_once __DIR__ . 'db_connect.php';
$hodClient = new HODClient('d9c00207-31b3-43f7-83fe-aa025aa67cd7');

$before = microtime(true);

//get connection handle
$db = new DB_CONNECT();

function requestCompletedWithContent($response) {
    $array = json_decode(json_encode($response), True);

    print_r($array);
};



function requestCompletedWithContent2($response) {
    $i = 0;
    foreach ($response as $row){

        if ($i == 1){
            //clean and split the returned response by comma, space and new line
            $split_strings = preg_split('/[\ \n\,]+/', $row);

            //remove element number 5 and reindex the array
            array_splice($split_strings,4,1);

            //traverse the array
            for ($x = 0; $x < sizeof($split_strings); $x=$x+5){
                echo $split_strings[$x].", ".$split_strings[$x+1].", ".$split_strings[$x+2].", ".$split_strings[$x+3].", ".$split_strings[$x+4];
                $year = $split_strings[$x];
                $state = $split_strings[$x+1];
                $model = $split_strings[$x+2];
                $color = $split_strings[$x+3];
                $confidence = $split_strings[$x+4];
                // mysql inserting a new row
                $result = mysqli_query("INSERT INTO vehicles(year, state, model, color, confidence) VALUES('$year','$state','$model','$color','$confidence')");

                // check if row inserted or not
                if ($result) {
                    // successfully inserted into database
                    $response["success"] = 1;
                    $response["message"] = "Row successfully created.";

                    // echoing JSON response
                    echo json_encode($response);
                } else {
                    // failed to insert row
                    $response ["success"] = 0;
                    $response["message"] = "Oops! An error occurred.";

                    // echoing JSON response
                    echo json_encode($response);
                }

                echo "<br/>";
            }
        }
        $i++;

    }

}


function requestCompletedWithJobId($response) {
    $jobID = $response;
//    echo $jobID;
}

$serviceName = 'carsService';
$predictionField = 'color';
$filePathTrainPredictor = 'data_sets/train_predictor.csv';
$jobID = '';
$dataTrainPredictor = array(
    'file' => $filePathTrainPredictor,
    'prediction_field' => $predictionField,
    'service_name' => $serviceName
);

$hodClient->PostRequest($dataTrainPredictor, HODApps::TRAIN_PREDICTOR, REQ_MODE::ASYNC, 'requestCompletedWithJobId');

$hodClient->GetJobStatus($jobID, 'requestCompletedWithContent');


$filePathPredict = 'data_sets/predict.csv';
$format = 'csv';
$dataPredict = array(
    'file' => $filePathPredict,
    'service_name' => $serviceName,
    'format' => $format
);

$hodClient->PostRequest($dataPredict, HODApps::PREDICT, REQ_MODE::SYNC, 'requestCompletedWithContent2');

$after = microtime(true);

//echo ($after-$before);