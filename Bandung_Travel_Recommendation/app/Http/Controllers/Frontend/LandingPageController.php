<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class LandingPageController extends Controller
{   
    public function homepage(){
      $APIDestination = Http::get(env('API_DOMAIN').'/api/place/get-destinations?take=10');
      $APIDestinationType = Http::get(env('API_DOMAIN').'/api/place/get-destination-types');
      $APIHotel = Http::get(env('API_DOMAIN').'/api/place/get-hotels?take=10');

      $dataDestinations = json_decode($APIDestination->body());
      $dataDestiantionTypes = json_decode($APIDestinationType->body());
      $dataHotels = json_decode($APIHotel->body());


      return view('/Frontend/landing-page')->with([
        'destinations'=> $dataDestinations,
        'destinationTypes'=>$dataDestiantionTypes,
        'hotels'=> $dataHotels
      ]);
    }

    public function destinationSearch($categories = null){
      $APIDestination = null;
      $activity = array();
      if ($categories == null){
        $APIDestination = Http::get(env('API_DOMAIN').'/api/place/get-destinations');
      }else{
        $APIDestination = Http::get(env('API_DOMAIN').'/api/place/get-destination?type_place_ids='.$categories);
      }
      if(Session::has('activity') && Session::get('activity') != null){
        foreach(explode(',',Session::get('activity')) as $dest){
          $data =  Http::withToken(Session::get('token'))->get(env('API_DOMAIN').'/api/place/'.$dest);
          $activity[] = json_decode($data->body())->data;
        }
      }

      $dataDestinations = json_decode($APIDestination->body());

      return view('/Frontend/Destination')->with([
        'destinations' => $dataDestinations,
        'activity' => $activity,
      ]);
    }

    public function hotelSearch(){

    }

    public function view($id){
      $APIDestination = Http::withToken(Session::get('token'))->get(env('API_DOMAIN').'/api/place/'.$id);
      $data = json_decode($APIDestination->body())->data;

      return view('Frontend/view-modal')->with([
        'data'=> $data,
      ]);

    }

    public function addActivity($id){
      if(Session::has('activity')){
        $data = (string)$id.','.Session::get('activity');
        Session::put('activity', $data);
      }else{
        Session::put('activity', (string)$id);
      }
      return response()->json([
        'success' => true,
      ]);
    }

    public function deleteActivity($id){
      if(Session::has('activity')){
        $act = explode(',',Session::get('activity'));
        if (($key = array_search($id, $act)) !== false) {
            unset($act[$key]);
        }

        Session::put('activity',   implode(',',$act));
      }

      return response()->json([
        'success' => true,
      ]);

    }

}
