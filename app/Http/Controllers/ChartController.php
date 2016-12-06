<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use App\Drug;
use Illuminate\Support\Facades\DB;


class ChartController extends Controller
{
    public function display()
    {

        $drugs = Drug::all();

        return view('admin.blank')
            ->with('drugs', $drugs);


    }


    public function highcharts(Request $request) {
        $year = $request->get('year');
        $drug = $request->get('drug');
        /*$string = implode(",", $request->get('drug'));*/


        $januaryDetails = Stock::where ( 'Month', 'January' )
            ->where('Year', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $februaryDetails = Stock::where ( 'Month', 'February' )
            ->where('Year', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $marchDetails = Stock::where ( 'Month', 'March')
            ->where('Year', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $aprilDetails = Stock::where ( 'Month', 'April')
            ->where('Year', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $mayDetails = Stock::where ( 'Month', 'May')
            ->where('Year', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $juneDetails = Stock::where ( 'Month', 'June')
            ->where('Year', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $julyDetails = Stock::where ( 'Month', 'July')
            ->where('Year', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $augustDetails = Stock::where ( 'Month', 'August' )
            ->where('Year', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $septemberDetails = Stock::where ( 'Month', 'September' )
            ->where('Year', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $octoberDetails = Stock::where ( 'Month', 'October' )
            ->where('Year', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $novemberDetails = Stock::where ( 'Month', 'November' )
            ->where('Year', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $decemberDetails = Stock::where ( 'Month', 'December' )
            ->where('Year', $year)
            ->whereIn('drug_id', $drug)
            ->get ();


      /*  $featureNames = Drug::select ( 'name' )->groupBy ( 'name' )->get ();*/


        $featureNames  = DB::table('stocks')
            ->join('drugs', 'drugs.id', '=', 'stocks.drug_id')
            ->select( 'drugs.name')
            ->whereIn('drug_id', $drug)
            ->groupBy ( 'drugs.name' )
            ->get();
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
        $idx = 0;

        foreach ( $featureNames as $name ) {
            array_push ( $featureNamesArray, $name->name );
            /*dd($featureNamesArray);*/
            /*dd($name);*/

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


        $chartArray ["series"] = [];

        foreach($featureNamesArray as $nm) {
            $data = [];

            if (!empty($dataArray) || count($dataArray)>0) {
                for ($i = 0; $i < count($dataArray); $i++) {
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

        if(!empty($chartArray)) {
            return view('admin.blank2')->with('chartArray', $chartArray);
        }
        else{
            return redirect('admin.blank2')->with('message', 'Missing data elements');
        }

    }


}
