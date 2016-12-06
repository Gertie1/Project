<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Drug;
use App\Disease;
use App\Disease_Drug;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class Disease_DrugController extends Controller
{
    public function form()
    {
        $diseases = Disease::all();
        $drugs = Drug::all();


      /*  $chunks = $drugs->chunk(3);
        $chunks->toArray();*/

        return view('admin.form2')
            ->with('diseases', $diseases)
            ->with('drugs', $drugs);

    }


    public function mapping(Request $request)
    {
        /*$array = $request->get('drug');
        $string = serialize($array);*/
        $messages = [
            'required' => 'Please enter all fields',
            'disease_id.unique'=>'Such a map already exists'
        ];

        $string = implode(",", $request->get('drug'));

        $input=([
            'drug_id' => $string,
            'disease_id' => $request->get('disease'),
        ]);
        $rules = array(
            'drug_id'             => 'required',
            'disease_id' => 'required|unique:diseases_drugs',

        );

        $validator = \Validator::make($input,$rules,$messages);

        if ($validator->fails()) {
            return redirect('form2')
                ->withErrors($messages)
                ->withInput();
        }



        $item = Disease_Drug::create([
            'drug_id' => $string,
            'disease_id' => $request->get('disease'),
        ]);

        $item->save();
        return redirect()->back()
            ->with('message','Mapping was successful');

    }

/*if($status)
{
\Session::flash('flash_message','created!!');
} else {
    \Session::flash('flash_message','Error!');
}

return redirect('admin/products');*/


}
