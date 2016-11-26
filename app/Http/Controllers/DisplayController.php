<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Drug;
use App\Disease;
use App\Disease_Drug;
use Illuminate\Support\Facades\DB;

class DisplayController extends Controller
{

    public function display()
    {
        $display = DB::table('diseases_drugs')
            ->join('diseases', 'diseases.id', '=', 'diseases_drugs.disease_id')
            ->select('diseases_drugs.*', 'diseases.name')
            ->get();
        /*dd($display);*/
        return view('admin.display')
            ->with('display', $display);

    }



    public function editMapping($id)
    {
        $item = Disease_Drug::findOrFail($id);
        $disease = DB::table('diseases')->where('id',$item['disease_id'])->first();
        $drugs_arr = explode(",",$item['drug_id'] );
        $drugs = DB::table('drugs')->select('id', 'name')->get();

        return view('admin.form')
            ->with(['item' => $item,'disease' => $disease, 'drugs' => $drugs, 'checked_drugs' => $drugs_arr]);


    }
    /* $item = $request->all();
           $item->save();*/
    /*$item->fill($input)->save();*/

    public function updateMapping($id, Request $request)
    {
        $item = Disease_Drug::findOrFail($id);

        $string = implode(",", $request->get('drug'));
        $input = [
            'drug_id' => $string,
            'disease_id' => $request->get('disease'),

        ];

        DB::table('diseases_drugs')
            ->where('id', $item['id'])
            ->update($input);


        return redirect()->back();
    }

/*foreach (Input::get('result') as $studentId=>$value)
{
$attendance = new Attendances();
$attendance->status = $value;
$attendance->comment = Input::get('comment');
    //We should save the student id somewhere.
$attendance->student_id = $studentId;
$attendance->save();
}*/
    /* Disease_Drug::where('id', $item)->update();*/
    /* Session::flash('flash_message', 'Task successfully added!');*/
}