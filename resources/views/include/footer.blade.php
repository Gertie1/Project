<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Prediction;

class PredictionController extends Controller
{

    public function highcharts() {
        $januaryDetails = Prediction::where ( 'month', 'January' )->get ();
        $februaryDetails = Prediction::where ( 'month', 'Feb' )->get ();
        $marchDetails = Prediction::where ( 'month', 'March' )->get ();
        $aprilDetails = Prediction::where ( 'month', 'April' )->get ();
        $mayDetails = Prediction::where ( 'month', 'May' )->get ();
        $juneDetails = Prediction::where ( 'month', 'June' )->get ();
        $julyDetails = Prediction::where ( 'month', 'July' )->get ();
        $augustDetails = Prediction::where ( 'month', 'August' )->get ();
        $septemberDetails = Prediction::where ( 'month', 'Sept' )->get ();
        $octoberDetails = Prediction::where ( 'month', 'Oct' )->get ();
        $novemberDetails = Prediction::where ( 'month', 'Nov' )->get ();
        $decemberDetails = Prediction::where ( 'month', 'December' )->get ();


        $featureNames = Prediction::select ( 'feature' )->groupBy ( 'feature' )->get ();
        $chartArray ["chart"] = array (
                "type" => "line"
        );
        $chartArray ["title"] = array (
                "text" => "Projections"
        );
        $chartArray ["credits"] = array (
                "enabled" => false
        );
        $chartArray ["xAxis"] = array (
                "categories" => array ()
        );
        $chartArray ["tooltip"] = array (
                "valueSuffix" => "units"
        );

        $categoryArray = array (
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
        );
        $January = [ ];
        $February = [ ];
        $March = [ ];
        $April = [ ];
        $May = [ ];
        $June = [ ];
        $July = [ ];
        $August = [ ];
        $September = [ ];
        $October = [ ];
        $November = [ ];
        $December = [ ];
        $dataArray = [ ];
        $featureNamesArray = [ ];



        foreach ( $featureNames as $feature )
            array_push ( $featureNamesArray, $feature->feature );

        foreach ( $januaryDetails as $det )
            array_push ( $January, ( int ) $det->amount );
        foreach ( $februaryDetails as $det )
            array_push ( $February, ( int ) $det->amount );
        foreach ( $marchDetails as $det )
            array_push ( $March, ( int ) $det->amount );
        foreach ( $aprilDetails as $det )
            array_push ( $April, ( int ) $det->amount );
        foreach ( $mayDetails as $det )
            array_push ( $May, ( int ) $det->amount );
        foreach ( $juneDetails as $det )
            array_push ( $June, ( int ) $det->amount );
        foreach ( $julyDetails as $det )
            array_push ( $July, ( int ) $det->amount );
        foreach ( $augustDetails as $det )
            array_push ( $August, ( int ) $det->amount );
        foreach ( $septemberDetails as $det )
            array_push ( $September, ( int ) $det->amount );
        foreach ( $octoberDetails as $det )
            array_push ( $October, ( int ) $det->amount );
        foreach ( $novemberDetails as $det )
            array_push ( $November, ( int ) $det->amount );
        foreach ( $decemberDetails as $det )
            array_push ( $December, ( int ) $det->amount );

        array_push ($dataArray, $January, $February, $March, $April, $May, $June, $July, $August, $September, $October, $November, $December);


        for($i = 0; $i < count ( $dataArray ); $i ++) {
            $chartArray ["series"] = array(
                    "name" => $featureNamesArray,
                    "data" => $dataArray
            );

            $chartArray ["xAxis"] = array(
                    "categories" => $categoryArray
            );
            $chartArray ["yAxis"] = array(
                    "title" => array(
                            "text" => "Amount ( units  )"
                    )
            );
        }
        return view ( 'admin.charts' )->with('chartArray', $chartArray );
    }
}


@extends('layouts.dashboard')
@section('content')


    <div id="page-wrapper">

        <div class="row">
            <!-- Page header-->
            <div class="col-lg-12">
                <h1 class="page-header">Charts</h1>
            </div>
            <!--End Page header-->
        </div>

        <div id="container"
             style="min-width: 310px; height: 600px; margin: 0 auto">

        </div>


        <?php echo json_encode($chartArray); ?>

    </div>
    <script>
        $(function() {
            $('#container').highcharts( <?php echo json_encode($chartArray) ?>)
        });

    </script>



@stop