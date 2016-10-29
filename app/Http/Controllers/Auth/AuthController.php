<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $item)
    {
        return User::create([
            'name' => $item['name'],
            'email' => $item['email'],
            'password' => bcrypt($item['password']),

        ]);
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

        return view('auth.login');
    }

    /*public function postLogin(){

        $rules=['email'=>'required','password'=>'required'];
        $validator=Validator::make(Input::all(),$rules);

        if($validator->fails()){
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $email=Input::get('email');
        $password=Input::get('password');

        if(!Auth::attempt(['email'=>$email,'password'=>$password])){
            return Redirect::back()->withInput()->withErrors(['Invalid credentials']);
        }
    }*/

}
