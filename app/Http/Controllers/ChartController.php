<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;

use App\Http\Requests;

class ChartController extends Controller
{
    public function display()
    {
        return view('admin.blank');
    }


    public function highcharts(Request $request) {
        $year = $request->get('year');

        $januaryDetails = Stock::where ( 'Month', 'January' )
            ->where('Year', $year)
            ->get ();
        $februaryDetails = Stock::where ( 'Month', 'February' )
            ->where('Year', $year)
            ->get ();
        $marchDetails = Stock::where ( 'Month', 'March')
            ->where('Year', $year)
            ->get ();
        $aprilDetails = Stock::where ( 'Month', 'April')
            ->where('Year', $year)
            ->get ();
        $mayDetails = Stock::where ( 'Month', 'May')
            ->where('Year', $year)
            ->get ();
        $juneDetails = Stock::where ( 'Month', 'June')
            ->where('Year', $year)
            ->get ();
        $julyDetails = Stock::where ( 'Month', 'July')
            ->where('Year', $year)
            ->get ();
        $augustDetails = Stock::where ( 'Month', 'August' )
            ->where('Year', $year)
            ->get ();
        $septemberDetails = Stock::where ( 'Month', 'September' )
            ->where('Year', $year)
            ->get ();
        $octoberDetails = Stock::where ( 'Month', 'October' )
        ->where('Year', $year)
            ->get ();
        $novemberDetails = Stock::where ( 'Month', 'November' )
            ->where('Year', $year)
            ->get ();
        $decemberDetails = Stock::where ( 'Month', 'December' )
            ->where('Year', $year)
            ->get ();


        $featureNames = Stock::select ( 'drug_id' )->groupBy ( 'drug_id' )->get ();
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
            array_push ( $January, ( int ) $det->amount_sold );
        foreach ( $februaryDetails as $det )
            array_push ( $February, ( int ) $det->amount_sold );
        foreach ( $marchDetails as $det )
            array_push ( $March, ( int ) $det->amount_sold );
        foreach ( $aprilDetails as $det )
            array_push ( $April, ( int ) $det->amount_sold );
        foreach ( $mayDetails as $det )
            array_push ( $May, ( int ) $det->amount_sold );
        foreach ( $juneDetails as $det )
            array_push ( $June, ( int ) $det->amount_sold );
        foreach ( $julyDetails as $det )
            array_push ( $July, ( int ) $det->amount_sold );
        foreach ( $augustDetails as $det )
            array_push ( $August, ( int ) $det->amount_sold );
        foreach ( $septemberDetails as $det )
            array_push ( $September, ( int ) $det->amount_sold );
        foreach ( $octoberDetails as $det )
            array_push ( $October, ( int ) $det->amount_sold );
        foreach ( $novemberDetails as $det )
            array_push ( $November, ( int ) $det->amount_sold );
        foreach ( $decemberDetails as $det )
            array_push ( $December, ( int ) $det->amount_sold );


        array_push ($dataArray, $January, $February, $March, $April, $May, $June, $July, $August, $September, $October, $November, $December);

        $idx = 0;
        $chartArray ["series"] = [];

        foreach($featureNamesArray as $nm) {
            $data = [];

            if (!empty($dataArray) || count($dataArray)>0){
                for($i = 0; $i < count ( $dataArray ); $i ++) {
                    array_push($data, $dataArray[$i][$idx]);
                }
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

        return view ( 'admin.blank2' )->with('chartArray', $chartArray);

    }


}
