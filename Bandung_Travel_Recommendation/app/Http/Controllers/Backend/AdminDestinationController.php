<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Library\AuthHelpers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use DataTables;
use Session;

class AdminDestinationController extends Controller
{
  use AuthHelpers;

  public function view(Request $request){
    $this->onUnauthorized();

    if($request->ajax()){
      $URL = Http::withToken(Session::get('token'))->get(env('API_DOMAIN').'/api/place/get-all');
      $data = json_decode($URL->body())->data;
      return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('type_place_id', function($place){
                return $place->place_types->name;
              })
              ->addColumn('action', function($row){
                // $btn = '<a class="edit btn btn-primary btn-md" id="btn-view" data-id='.$row->id.' style="margin-right:10px">View</a>';
                // $btn .='<a class="edit btn btn-warning btn-md" id="btn-update" data-id='.$row->id.' style="margin-right:10px">Update</a>';
                $btn ='<a class="edit btn btn-warning btn-md" id="btn-update" data-id='.$row->id.' style="margin-right:10px">Update</a>';
                $btn .= '<a class="edit btn btn-danger btn-md" id="btn-delete" data-id='.$row->id.' style="margin-right:10px">Delete</a>';
                return $btn;
              })
              ->rawColumns(['type_place_id','action'])
              ->make(true);
    }

    return view('Backend/Destination');
  }

  public function loadForm($id = null){
    $data = null;
    $APIDestinationTypes = Http::withToken(Session::get('token'))->get(env('API_DOMAIN').'/api/place/type/get-all');
    $destinationData = json_decode($APIDestinationTypes->body())->data;
    if($id != null){
      $API = Http::withToken(Session::get('token'))->get(env('API_DOMAIN').'/api/place/'.$id);
      $data = json_decode($API->body())->data;

      return view('Backend/Form/DestinationFormEdit')
              ->with('data', $data)
              ->with('destination_types', $destinationData);
    }
    return view('Backend/Form/DestinationForm')
            ->with('data', $data)
            ->with('destination_types', $destinationData);
  }

  public function create(Request $request){
    $response = Http::withToken(Session::get('token'))
    ->attach('inputImage', fopen($request->inputImage, 'r'))
    ->post(env('API_DOMAIN').'/api/place/add', [
        'inputName' => $request->inputName,
        'inputDescription' => $request->inputDescription,
        'inputTypePlaceId' => $request->inputTypePlaceId,
        'inputLongitude' => $request->inputLongitude,
        'inputLatitude' => $request->inputLatitude,
        'inputRate'=>$request->inputRate,
        'inputAlamat'=>$request->inputAlamat,
      ]);
    return $response;
  }

  public function update(Request $request, $id){
    $response = Http::withToken(Session::get('token'))->post(env('API_DOMAIN').'/api/place/edit/'.$id, $request);
    return $response;
  }

  public function delete($id){
    $response = Http::withToken(Session::get('token'))->delete(env('API_DOMAIN').'/api/place/delete/'.$id);
    return $response->body();
  }

}
