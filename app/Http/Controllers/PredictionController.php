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
        $chartArray ["title"] = array (
            "text" => "Projections"
        );
        $chartArray ["credits"] = array (
            "enabled" => false
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


        foreach ( $featureNames as $feature ) {
            array_push ( $featureNamesArray, $feature->feature );

        }


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

        $idx = 0;
        $chartArray ["series"] = [];

        foreach($featureNamesArray as $nm) {
            $data = [];
            for($i = 0; $i < count ( $dataArray ); $i ++) {
                array_push($data, $dataArray[$i][$idx]);
            }
            array_push($chartArray ["series"], array(
                "name" => $nm,
                "data" => $data
            ));

            $chartArray ["xAxis"] = array(
                "categories" => $categoryArray
            );
            $chartArray ["yAxis"] = array(
                "title" => array(
                    "text" => "Amount ( units  )"
                )
            );
            $idx++;
        }

        return view ( 'admin.charts' )->with('chartArray', $chartArray);

    }
}
