<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class LoginController extends Controller
{
    public function login(){
      if(Auth::check()){
        return back();
      }else{
        return back()->with([
          'success' => false,
        ]);
      }
    }

    public function actionLogin(Request $request){
      $response = Http::post(env('API_DOMAIN').'/api/auth/login', $request);
      if(json_decode($response->body())->success){
        $data = json_decode($response->body())->data;
        Session::put('token', $data->token);
        Session::put('user', $data->user);
      }
      return redirect()->intended('/');
    }

    public function actionLogout(){
      $response = Http::withToken(Session::get('token'))->post(env('API_DOMAIN').'/api/auth/logout', []);
      Session::flush();
      return redirect()->intended('/');;
    }

    public function actionRegister(Request $request){
      $response = Http::post(env('API_DOMAIN').'/api/auth/register', $request);

      return back()->with([[
        'data', $response->body()]]);
    }

}
