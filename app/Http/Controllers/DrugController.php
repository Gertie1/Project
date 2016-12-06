<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Drug;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;

class DrugController extends Controller
{
    public function drugs(Request $request){
        $drugs = DB::table('drugs')->simplePaginate(10);
        //return view ('admin.drugs') ->with('drugs',$drugs);
        return view('admin.drugs', ['drugs' => $drugs]);
    }

  /*  public function index()
    {
        $users = DB::table('users')->paginate(15);

        return view('user.index', ['users' => $users]);
    }*/

    public function newDrug(Request $request){
        if($request->ajax()){

            $validation = \Validator::make( Input::all(), [
                'name' => 'required|unique:drugs',
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

            $item = Drug::create($request->all());
            $item->save();
            return response()->json($item);


           /* $request->session()->flash('message', 'New Drug added successfully.');
            $request->session()->flash('message-type', 'success');
            return response()
                ->json($item,$validation,['status'=>'Hooray','success' => '0', 'error' => 'Your Flash Message']);*/


        }
    }

    public function getDrugUpdate(Request $request){
        if($request->ajax())
        {
            $item=Drug::find($request->id);
            return response($item);

        }
    }
    public function newDrugUpdate(Request $request)
    {
        if($request->ajax())
        {
            $item=Drug::find($request->id);
            $item->name=$request->name;
            $item->current_stock=$request->current_stock;
            $item->total_stock=$request->total_stock;
            $item->used_stock=$request->used_stock;
            $item->date_received=$request->date_received;
            $item->save();
            return response($item);
        }

    }

    public function deleteDrug(Request $request)
    {
        if($request->ajax())
        {
            Drug::destroy($request->id);
            return Response()->json(['sms'=>'Successfully deleted']);

        }

    }

    public function searchDrug(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $drugs=DB::table('drugs')->where('name','LIKE','%'.$request->search.'%')->get();

            if($drugs){
                foreach ($drugs as $key => $item){
                    $output.='<tr>'.
                             '<td>'. $item->id.'</td>'.
                             '<td>'. $item->name.'</td>'.
                             /*'<td>'. $item->current_stock.'</td>'.
                             '<td>'. $item->total_stock.'</td>'.
                             '<td>'. $item->used_stock.'</td>'.
                             '<td>'. $item->date_received.'</td>'.*/
                             '<td><button class="edit-modal btn btn-info btn-edit" data-id="'.$item->id.'">Edit</button>
                             <button class="delete-modal btn btn-danger btn-delete" data-id="'.$item->id.'">Delete</button></td>'.

                             '</tr>';
                }
                return response($output);

            }




        }
    }

}
