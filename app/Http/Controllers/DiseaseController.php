<?php

namespace App\Http\Controllers;

use App\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class DiseaseController extends Controller
{
    public function diseases(Request $request){
        $diseases = DB::table('diseases')->simplePaginate(10);
        return view('admin.diseases', ['diseases' => $diseases]);
    }

    public function newDisease(Request $request){
        if($request->ajax()){
            $validation = \Validator::make( Input::all(), [
                'name' => 'required|unique:diseases',
            ]);

            if( $validation->fails() )
            {
                $errors = $validation->errors();
                $errors =  json_decode($errors);

                return response()->json([
                    'success' => false,
                    'message' => $errors
                ], 422);
            }
            $item = Disease::create($request->all());
            $item->save();
            return response()->json($item);
        }
    }

    public function getDiseaseUpdate(Request $request){
        if($request->ajax())
        {
            $item=Disease::find($request->id);
            return response($item);

        }
    }
    public function newDiseaseUpdate(Request $request)
    {
        if($request->ajax())
        {
            $item=Disease::find($request->id);
            $item->name=$request->name;
            $item->save();
            return response($item);
        }

    }

    public function deleteDisease(Request $request)
    {
        if($request->ajax())
        {
            Disease::destroy($request->id);
            return Response()->json(['sms'=>'Successfully deleted']);

        }

    }

    public function searchDisease(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $diseases=DB::table('diseases')->where('name','LIKE','%'.$request->search.'%')->get();

            if($diseases){
                foreach ($diseases as $key => $item){
                    $output.='<tr>'.
                        '<td>'. $item->id.'</td>'.
                        '<td>'. $item->name.'</td>'.
                        '<td><button class="edit-modal btn btn-info btn-edit" data-id="'.$item->id.'">Edit</button>
                             <button class="delete-modal btn btn-danger btn-delete" data-id="'.$item->id.'">Delete</button></td>'.

                        '</tr>';
                }
                return response($output);

            }




        }
    }
}
