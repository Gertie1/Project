<?php

namespace App\Http\Controllers;

/*namespace App\Http\Controllers\HOD;*/


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Library\HODClient;
use App\Library\HODApps;
use App\Library\REQ_MODE;
use App\Library\HODErrorObj;


class HavenController extends Controller
{
    protected $data;

    function index($key)
    {
        return new HODClient($key);
    }

    function requestCompletedWithContent($response)
    {
        $array = json_decode(json_encode($response), True);
        print_r($array);
    }

    function requestCompletedWithContent2($response)
    {
        $this->data = $response;
    }

    function init()
    {
        $serviceName = 'carsService';
        $predictionField = 'color';
        $filePathTrainPredictor = 'C:\xampp\htdocs\Project\data\train_predictor.csv';
        $jobID = '';
        $dataTrainPredictor = array(
            'file' => $filePathTrainPredictor,
            'prediction_field' => $predictionField,
            'service_name' => $serviceName
        );

        $hodClient = $this->index('d9c00207-31b3-43f7-83fe-aa025aa67cd7');
        $hodClient->PostRequest($dataTrainPredictor, HODApps::TRAIN_PREDICTOR, REQ_MODE::ASYNC, 'requestCompletedWithJobId');

        $hodClient->GetJobStatus($jobID, 'requestCompletedWithContent');


        $filePathPredict = 'C:\xampp\htdocs\Project\data\predict.csv';
        $format = 'csv';
        $dataPredict = array(
            'file' => $filePathPredict,
            'service_name' => $serviceName,
            'format' => $format
        );

        $hodClient->PostRequest($dataPredict, HODApps::PREDICT, REQ_MODE::SYNC, 'requestCompletedWithContent2');

        return view('admin.trial')
            ->with($this->data);

    }

    public function requestCompletedWithJobId($response)
    {
        $jobID = $response;
    }

}
