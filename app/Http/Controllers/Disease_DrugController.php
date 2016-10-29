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

        return view('admin.form')
            ->with('diseases', $diseases)
            ->with('drugs', $drugs);

    }



    public function mapping(Request $request)
    {
        $drugString = implode(",", $request->get('drug'));
        $status = Disease_Drug::create([

            'drug' => $drugString,
            'disease_id' => $request->get('disease_id'),
        ]);
        $status->save();
    }



}
