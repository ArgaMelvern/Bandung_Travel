<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Library\AuthHelpers;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class AdminDashboardController extends Controller
{
  use AuthHelpers;

  public function view(){
    $this->onUnauthorized();
    // dd(url('api/place/get-places'));
    // $client = new Client();
    // $res = $client->get(env('API_DOMAIN').'/api/place/get-destinations',[]);
    // echo $res->getStatusCode();
    // // 200
    // // echo $res->getHeader('content-type');
    // // 'application/json; charset=utf8'
    // echo $res->getBody();
    // // dd();
    // $data = Http::get(env('API_DOMAIN').'/api/place/get-destinations');
    // echo $data->body();
    // dd(response()->json(['data' => Place::all()]));
    return view('Backend/Dashboard');
  }

}
