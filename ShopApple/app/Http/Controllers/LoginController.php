<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;


session_start();

class LoginController extends Controller
{
    public function flogin(){

        return view('pages.flogin');
    }
    public function fregistor(){

        return view('pages.fregistor');
    }

   

   public function registor(Request $request)
    {
    // Validate the user input

    $request->validate([
        
        'name' => 'required|string|max:255|unique:users,name',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => ['required', 'confirmed', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->uncompromised(),
        ],
        
    ]);
    //Create a new user in the database
    $user = new User;
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->roll = 0;
    $user->save();

    // Log the user in and redirect them to the dashboard
    auth()->login($user);
    $request->session()->put('id', $user->id);
    
    return redirect('/trangchu');
    }



    public function login(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = User::where('email', $email)->first();
            $request->session()->put('id', $user->id);
            $request->session()->put('name', $user->name);
            $request->session()->put('roll', $user->roll);
            return redirect()->intended('/trangchu');
            //return redirect('/trangchu');
        } else {
            // Session::put('message','Sai tài khoản hoặc mật khẩu!');
            // return Redirect('/flogin');
            return redirect()->back()->withInput()->withErrors(['messages' => 'Sai tài khoản hoặc mật khẩu']);
        }
        // $email = $request->input('email');
        // $password = $request->input('password');
        // $validator = $this->rules($request->all());
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput();   
        // }
        // else{
        //     if (Auth::attempt(['email' => $email, 'password' => $password])) {
        //         //login successful
        //         $user = User::where('email', $email)->first();
        //         $request->session()->put('id', $user->id);
        //         return redirect()->intended('/trangchu');
        //     }
        //     else{
        //         return Redirect::back()
        //                 ->withInput()
        //                 ->withErrors([
        //                     'password' => 'Incorrect password!'
        //                 ]);
        //     }
        // }
    }
    

    public function logout() {
        session()->put('id', NULL);
        return redirect()->back();
    }

    

}
