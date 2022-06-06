<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Library\AuthHelpers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use DataTables;
use Session;

class AdminPlaceTypeController extends Controller
{
  use AuthHelpers;

  public function view(Request $request){
    $this->onUnauthorized();

    if($request->ajax()){
      $URL = Http::withToken(Session::get('token'))->get(env('API_DOMAIN').'/api/place/type/get-all');
      $data = json_decode($URL->body())->data;
      return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                $btn ='<a class="edit btn btn-warning btn-md" id="btn-update" data-id='.$row->id.' style="margin-right:10px">Update</a>';
                $btn .= '<a class="edit btn btn-danger btn-md" id="btn-delete" data-id='.$row->id.' style="margin-right:10px">Delete</a>';
                return $btn;
              })
              ->rawColumns(['action'])
              ->make(true);
    }

    return view('Backend/PlaceType');
  }

  public function loadForm($id = null){
    $data = null;
    if($id != null){
      $API = Http::withToken(Session::get('token'))->get(env('API_DOMAIN').'/api/place/type/'.$id);
      $data = json_decode($API->body())->data;

        return view('Backend/Form/PlaceTypeFormEdit')
                ->with('data', $data);
    }
    return view('Backend/Form/PlaceTypeForm')
            ->with('data', $data);
  }

  public function create(Request $request){
    $response = Http::withToken(Session::get('token'))->post(env('API_DOMAIN').'/api/place/type/add', $request);
    return json_decode($response->body());
  }

  public function update(Request $request, $id){
    $response = Http::withToken(Session::get('token'))->post(env('API_DOMAIN').'/api/place/type/edit/'.$id, $request);
    return $response->body();
  }

  public function delete($id){
    $response = Http::withToken(Session::get('token'))->delete(env('API_DOMAIN').'/api/place/type/delete/'.$id);
    return json_decode($response->body());
  }

}
