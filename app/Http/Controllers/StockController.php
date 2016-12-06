<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Drug;
use Illuminate\Support\Facades\Input;
use App\Stock;
use Illuminate\Support\Facades\DB;
use App\Disease;



class StockController extends Controller
{
    public function stocks()
    {
        $stocks = DB::table('stocks')

            ->join('drugs', 'drugs.id', '=', 'stocks.drug_id')

            ->select('stocks.*', 'drugs.name')
            ->simplePaginate(10);



        return view('admin.stock')
            ->with('stocks', $stocks);


        /*$display = DB::table('diseases_drugs')
            ->join('diseases', 'diseases.id', '=', 'diseases_drugs.disease_id')
            ->select('diseases_drugs.*', 'diseases.name')
            ->get();

        return view('admin.display')
            ->with('display', $display);*/

    }

    public function newStock()
    {
        $drugs = Drug::all();

        return view('admin.stockr')

            ->with('drugs', $drugs);
    }

    public function addNewStock(Request $request)
    {
        /*    $input = Input::all();
             $drug = $request->drug('drug');
             $amount_received = $request->drug('amount_received');*/


        $stock = count($request['drug']);

        $insert = array();
        $rules = array(
            'drug_id'             => 'required',                        // just a normal required validation
            'date_received' => 'required',           // required and has to match the password field
            'date_sold' => 'required',
            'amount_received' => 'required|greater_than_field:amount_sold',
            'amount_sold' => 'required'

        );
        $messages = [
            'required' => 'The :attribute field is required.',
            'amount_received.greater_than_field'=>'You cannot sell more than what you received'
        ];


            for ($i = 0; $i < $stock; $i++) {
                if (!empty($request['drug'][$i])) {
                    array_push($insert, array( // iterate through each entry and create an array of inputs


                        'drug_id' => $request['drug'][$i],
                        'amount_received' => $request['amount_received'][$i],
                        'amount_sold' => $request['amount_sold'][$i],
                        'date_received' => $request['date_received'][$i],
                        'date_sold' => $request['date_sold'][$i],
                        'amount_remaining' => ($request['amount_received'][$i]) - ($request['amount_sold'][$i]),

                    ));

                }

            }

            foreach ($insert as $key){
        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = \Validator::make($key, $rules,$messages);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return \Redirect::to('stockr')
                ->withErrors($messages)
                ->withInput();


        }
            }
        Stock::insert($insert);
        return redirect('stock');
    }

    public function deleteStock(Request $request)
    {
        if($request->ajax())
        {
            Drug::destroy($request->id);
            return Response()->json(['sms'=>'Successfully deleted']);

        }

    }

    public function searchStock(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $stocks=DB::table('stocks')->where('name','LIKE','%'.$request->search.'%')->get();

            if($stocks){
                foreach ($stocks as $key => $item){
                    $output.='<tr>'.
                        '<td>'. $item->id.'</td>'.
                        '<td>'. $item->drug_id.'</td>'.
                        '<td>'. $item->amount_received.'</td>'.
                        '<td>'. $item->amount_sold.'</td>'.
                        '<td>'. $item->date_received.'</td>'.
                        '<td>'. $item->date_sold.'</td>'.
                        '<td>'. $item->amount_remaining.'</td>'.
                        '<td><button class="delete-modal btn btn-danger btn-delete" data-id="'.$item->id.'">Delete</button></td>'.

                        '</tr>';
                }
                return response($output);

            }




        }
    }

    public function editStock($id)
    {
        $item = Stock::findOrFail($id);
        $drug = DB::table('drugs')->where('id',$item['drug_id'])->first();
        $amount_received = $item['amount_received'];
        $amount_sold = $item['amount_sold'];
        $date_received = $item['date_received'];
        $date_sold = $item['date_sold'];

        /*    $drugs_arr = explode(",",$item['drug_id'] );
            $drugs = DB::table('drugs')->select('id', 'name')->get();*/

        return view('admin.stocke')
            ->with(['item' => $item, 'drug' => $drug, 'amount_received' => $amount_received, 'amount_sold' => $amount_sold, 'date_received' => $date_received, 'date_sold' => $date_sold, ]);


    }
    /* $item = $request->all();
           $item->save();*/
    /*$item->fill($input)->save();*/

    public function updateStock($id, Request $request)
    {
        /* $item = Stock::findOrFail($id);*/
        /*$string = implode(",", $request->get('drug'));
        $input = [
            'drug_id' => $string,
            'disease_id' => $request->get('disease'),

        ];*/

        $item=Stock::find($id);
        $drug = $request->get('drug');
        $amount_received = $request->get('amount_received');
        $amount_sold = $request->get('amount_sold');
        $date_received = $request->get('date_received');
        $date_sold = $request->get('date_sold');



        DB::table('stocks')
            ->where('id', $item['id'])
            ->update(array(
                'drug_id' => $drug,
                'amount_received' =>$amount_received,
                'amount_sold' => $amount_sold,
                'date_received' => $date_received,
                'date_sold' => $date_sold,
                'amount_remaining' =>($amount_received)-($amount_sold)


            ));


        return redirect('stock');
        /*return redirect()->back();*/
    }

    public function often(Request $request)
    {
        $year = $request->get('year');
        $month = $request->get('month');
        $stocks = DB::table('stocks')
            ->join('drugs', 'drugs.id', '=', 'stocks.drug_id')
            ->select('stocks.*', 'drugs.name')

            ->where('Year', $year)
            ->where('Month', $month)
            ->where('percentage_consumed', '>',69)
            ->simplePaginate(10);


        return view('admin.often')
            ->with('stocks', $stocks);
    }

    public function none(Request $request)
    {
        $year = $request->get('year');
        $month = $request->get('month');
        $stocks = DB::table('stocks')
            ->join('drugs', 'drugs.id', '=', 'stocks.drug_id')
            ->select('stocks.*', 'drugs.name')

            ->where('Year', $year)
            ->where('Month', $month)
            ->where('amount_remaining', '=',0)
            ->simplePaginate(10);


        return view('admin.none')
            ->with('stocks', $stocks);
    }

    public function rarely(Request $request)
    {
        $year = $request->get('year');
        $month = $request->get('month');
        $stocks = DB::table('stocks')
            ->join('drugs', 'drugs.id', '=', 'stocks.drug_id')
            ->select('stocks.*', 'drugs.name')

            ->where('Year', $year)
            ->where('Month', $month)
            ->where('percentage_consumed', '<',40)
            ->simplePaginate(10);


        return view('admin.rarely')
            ->with('stocks', $stocks);
    }




}
