<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Drug;
use App\Disease;
use App\Disease_Drug;
use Illuminate\Support\Facades\DB;


class Disease_DrugController extends Controller
{
    public function form()
    {
        $diseases = Disease::all();
        $drugs = Drug::all();

        return view('admin.form2')
            ->with('diseases', $diseases)
            ->with('drugs', $drugs);

    }


    public function mapping(Request $request)
    {
        /*$array = $request->get('drug');
        $string = serialize($array);*/

        $string = implode(",", $request->get('drug'));
        $item = Disease_Drug::create([
            'drug_id' => $string,
            'disease_id' => $request->get('disease'),
        ]);
        $item->save();
    }

/*if($status)
{
\Session::flash('flash_message','created!!');
} else {
    \Session::flash('flash_message','Error!');
}

return redirect('admin/products');*/


}
