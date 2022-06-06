<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Library\ApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

use App\Models\PlaceType;
use App\Models\Place;
use App\Models\UserInteractLogs;

class PlaceController extends Controller
{
    use ApiHelpers;
    // General Place
    // -----------------------------------------------------------------------------
    // -----------------------------------------------------------------------------
    // --------------- Place Type ---------------
    public function addPlaceType(Request $req)
    {
        try {
            $req->validate([
                'inputName' => 'required'
            ]);

            DB::beginTransaction();
            $data = PlaceType::create([
                'name' => $req->input('inputName')
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->onError('Add Place Type Failed!', $exception->getMessage());
        }
        return $this->onSuccess($data, 'Add Place Type Success!');
    }


    public function editPlaceType(Request $req, $id)
    {
        try {
            $req->validate([
                // 'id' => 'required',
                'inputName' => 'required'
            ]);
            // $id = $req->input('id');

            DB::beginTransaction();
            $data = PlaceType::findOrFail($id);
            $data->update([
                'name' => $req->input('inputName')
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->onError('Update Place Type Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'Update Place Type Success!');
    }

    public function deletePlaceType($id)
    {
        try {
            // $req->validate([
            //     'id' => 'required'
            // ]);
            // $id = $req->input('id');

            DB::beginTransaction();
            $data = PlaceType::findOrFail($id)->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->onError('Delete Place Type Failed!', $exception->getMessage());
        }

        return $this->onSuccess('', 'Delete Place Type Success!');
    }

    public function getPlaceTypes()
    {
        try {
            $data = PlaceType::get();
        } catch (\Exception $exception) {
            return $this->onError('Get Place Types Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'Get Place Types Success!');
    }

    public function getPlaceTypeById($id)
    {
        try {
            // $id = $req->input('id');
            $data = PlaceType::findOrFail($id);
        } catch (\Exception $exception) {
            return $this->onError('Get Place Type Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'Get Place Type Success!');
    }

    // --------------- Place ---------------
    public function addPlace(Request $req)
    {
        try {
            $req->validate([
                'inputName' => 'required',
                'inputTypePlaceId' => 'required',
                'inputRate' => 'required',
                'inputDescription' => 'required',
                'inputImage' => 'required|image',
                'inputAlamat' => 'required',
                'inputLatitude' => 'required',
                'inputLongitude' => 'required',
            ],
            [
                'inputImage.mimes' => "Tipe file hanya boleh (jpg,png,jpeg)",
                'inputImage.max' => "Ukuran file maksimal 500KB",
            ]);

            $file = $req->file('inputImage');
            if($file->extension() == 'tmp'){
                $image_name = Str::uuid().'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).'.jpg';
            }else{
                $image_name = Str::uuid().'_'.$file->getClientOriginalName();
            }

            DB::beginTransaction();
            $data = Place::create([
                'name' => $req->input('inputName'),
                'type_place_id' => $req->input('inputTypePlaceId'),
                'rate' => $req->input('inputRate'),
                'description' => $req->input('inputDescription'),
                'image_name' => $image_name,
                'alamat' => $req->input('inputAlamat'),
                'latitude' => $req->input('inputLatitude'),
                'longitude' => $req->input('inputLongitude'),
            ]);
            $data = Place::with('place_types')->findOrFail($data->id);
            DB::commit();
            $file->move(public_path('img/destination'), $image_name);
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->onError('Add Place Type Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'Add Place Type Success!');
    }

    public function editPlace(Request $req, $id)
    {
        try {
            $req->validate([
                // 'id' => 'required',
                'inputName' => 'required',
                'inputTypePlaceId' => 'required',
                'inputRate' => 'required',
                'inputDescription' => 'required',
                // 'inputImage' => 'required|image',
                'inputAlamat' => 'required',
                'inputLatitude' => 'required',
                'inputLongitude' => 'required',
            ],
            [
                'inputImage.mimes' => "Tipe file hanya boleh (jpg,png,jpeg)",
                'inputImage.max' => "Ukuran file maksimal 500KB",
            ]);

            // $id = $req->input('id');

            DB::beginTransaction();
            $data = Place::with('place_types')->findOrFail($id);

            if($req->has('inputImage') && $req->file('inputImage') != null){
                $file = $req->file('inputImage');
                if($file->extension() == 'tmp'){
                    $image_name = Str::uuid().'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).'.jpg';
                }else{
                    $image_name = Str::uuid().'_'.$file->getClientOriginalName();
                }
            }else{
                $image_name = $data->image_name;
            }

            if($req->has('inputImage') && $req->file('inputImage') != null)
                $current_img_path = public_path('img/destination/'.$data->image_name);

            $data->update([
                'name' => $req->input('inputName'),
                'type_place_id' => $req->input('inputTypePlaceId'),
                'rate' => $req->input('inputRate'),
                'description' => $req->input('inputDescription'),
                'image_name' => $image_name,
                'alamat' => $req->input('inputAlamat'),
                'latitude' => $req->input('inputLatitude'),
                'longitude' => $req->input('inputLongitude'),
            ]);
            if($req->has('inputImage') && $req->file('inputImage') != null)
              if(file_exists($current_img_path)){
                unlink($current_img_path);
              }
            if($req->has('inputImage') && $req->file('inputImage') != null)
                $file->move(public_path('img/destination'), $image_name);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->onError('Update Place Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'Update Place Success!');
    }

    public function deletePlace($id)
    {
        try {
            // $req->validate([
            //     'id' => 'required'
            // ]);
            // $id = $req->input('id');

            DB::beginTransaction();
            $data = Place::findOrFail($id);
            $current_img_path = public_path('img/destination/'.$data->image_name);
            $data->delete();
            DB::commit();
            if(file_exists($current_img_path)){
                unlink($current_img_path);
            }
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->onError('Delete Place Failed!', $exception->getMessage());
        }

        return $this->onSuccess('', 'Delete Place Success!');
    }

    public function getPlaces(Request $req)
    {
        try {
            $data = Place::with('place_types')
            ->select(['places.*',  DB::raw("(CASE WHEN i.view IS NOT NULL THEN i.view ELSE 0 END) as view")])
            ->leftjoin(DB::raw("(SELECT place_id, COUNT(*) as view FROM user_interact_logs GROUP BY user_interact_logs.place_id) as i"), 'i.place_id', '=', 'places.id');
            $temp = clone $data;
            if($temp->where('i.view', '!=', 'null')->get()->count() <= 5){
                $data->orderBy('rate', 'DESC');
            }else{
                $data->orderBy('view', 'DESC');
            }

            if($req->has('type_place_ids')){
                $type = explode(',', $req->input('type_place_ids'));
                $data->whereRelation('place_types', function($q) use ($type) {
                    $q->whereIn('place_types.id', $type);
                });
            }
            if($req->has('take')){
                $data->take($req->input('take'));
            }
            $data = $data->get();
        } catch (\Exception $exception) {
            return $this->onError('Get Places Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'Get Places Success!');
    }

    public function getPlaceById($id)
    {
        try {
            // $id = $req->input('id');
            $data = Place::with('place_types')
            ->select(['places.*',  DB::raw("(CASE WHEN i.view IS NOT NULL THEN i.view ELSE 0 END) as view")])
            ->leftjoin(DB::raw("(SELECT place_id, COUNT(*) as view FROM user_interact_logs GROUP BY user_interact_logs.place_id) as i"), 'i.place_id', '=', 'places.id');
            $data = $data->findOrFail($id);
        } catch (\Exception $exception) {
            return $this->onError('Get Place Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'Get Place Success!');
    }

    // Hotel
    // -----------------------------------------------------------------------------
    // -----------------------------------------------------------------------------
    public function getHotels(Request $req)
    {
        try {
            $data = Place::with('place_types')
            ->select(['places.*',  DB::raw("(CASE WHEN i.view IS NOT NULL THEN i.view ELSE 0 END) as view")])
            ->leftjoin(DB::raw("(SELECT place_id, COUNT(*) as view FROM user_interact_logs GROUP BY user_interact_logs.place_id) as i"), 'i.place_id', '=', 'places.id');
            $temp = clone $data;
            if($temp->where('i.view', '!=', 'null')->get()->count() <= 5){
                $data->orderBy('rate', 'DESC');
            }else{
                $data->orderBy('view', 'DESC');
            }
            $data->whereRelation('place_types', 'name', '=', "Hotel");
            if($req->has('take')){
                $data->take($req->input('take'));
            }
            $data = $data->get();
            // ->makeHidden(['type_place_id']);-
        } catch (\Exception $exception) {
            return $this->onError('Get Hotels Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'Get Hotels Success!');
    }

    // Destination
    // -----------------------------------------------------------------------------
    // -----------------------------------------------------------------------------

    public function getDestinations(Request $req)
    {
        try {
            $data = Place::with('place_types')
            ->select(['places.*',  DB::raw("(CASE WHEN i.view IS NOT NULL THEN i.view ELSE 0 END) as view")])
            ->leftjoin(DB::raw("(SELECT place_id, COUNT(*) as view FROM user_interact_logs GROUP BY user_interact_logs.place_id) as i"), 'i.place_id', '=', 'places.id');
            $temp = clone $data;
            if($temp->where('i.view', '!=', 'null')->get()->count() <= 5){
                $data->orderBy('rate', 'DESC');
            }else{
                $data->orderBy('view', 'DESC');
            }

            if($req->has('type_place_ids')){
                $type = explode(',', $req->input('type_place_ids'));
                $data->whereRelation('place_types', function($q) use ($type) {
                    $q->whereIn('place_types.id', $type);
                });
            }
            $data->whereRelation('place_types', 'name', '!=', "Hotel");
            if($req->has('take')){
                $data->take($req->input('take'));
            }
            if($req->has('page')){
                $itemperpage = 10;
                if($req->has('itempernumber')){
                    $itemperpage = (int)$req->input('itempernumber');
                }
                $data = $data->paginate($itemperpage, ['*'], 'page', (int)$req->input('take'));
            }else{
                $data = $data->get();
            }
        } catch (\Exception $exception) {
            return $this->onError('Get Destinations Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'Get Destinations Success!');
    }

    public function getDestinationTypes(Request $req)
    {
        try {
            $data = PlaceType::where('name', '!=', "Hotel")->get();
        } catch (\Exception $exception) {
        return $this->onError('Get Destination Types Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'Get Destination Types Success!');
    }
}
