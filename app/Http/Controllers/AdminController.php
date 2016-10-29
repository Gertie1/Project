<?php

namespace App\Http\Controllers;

use App\Disease;
use App\Drug;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;



class AdminController extends Controller
{
    public function home(){
        return view ('admin.index');
    }
   // public function login(){
     //   return view ('admin.login');
   // }
    public function grid(){
        return view ('admin.grid');
    }
    public function buttons(){
        return view ('admin.buttons');
    }

    public function users(Request $request){
        $users = User::all();
        return view ('admin.users') ->with('users',$users);
    }

    public function drugs(Request $request){
        $drugs = Drug::all();
        return view ('admin.drugs') ->with('drugs',$drugs);
    }

    public function diseases(Request $request){
        $diseases = Disease::all();
        return view ('admin.diseases') ->with('diseases',$diseases);
    }

    public function newUser(Request $request){
        if($request->ajax()){
            $item = User::create($request->all());
            $item->save();
            return response()->json($item);
        }
    }

    public function logout() {
        auth()->logout();

        return redirect()->route('/');
    }

    public function getUpdate(Requests $request){
        if($request->ajax())
        {
            $item=User::find($request->id);
            return Response($item);

        }
    }
    public function newUpdate(Request $request)
    {
        if($request->ajax())
        {
            $item=User::find($request->id);
            $item->Username=$request->name;
            $item->email=$request->email;
            $item->save();
            return Response($item);
        }

    }

    public function deleteUser(Request $request)
    {
        if($request->ajax())
        {
            User::destroy($request->id);
            return Response()->json(['sms'=>'Successfully deleted']);

        }

    }
}


