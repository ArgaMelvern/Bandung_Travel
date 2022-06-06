<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Library\ApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Favorite;
use App\Models\FavoritePlaceItems;
use App\Models\UserInteractLogs;

class UserController extends Controller
{
    use ApiHelpers;
    
    public function edit(Request $req)
    {
        try {
            $req->validate([
                'inputName' => 'required',
            ]);

            DB::beginTransaction();
            $data = auth('sanctum')->user();
            $pass = $data->password;
            if($req->has('inputPassword')){
                $pass = Hash::make($req->input('inputPassword'));
            }

            $data->update([
                'password' => $pass,
                'name' => $req->input('inputName')
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->onError('Update User Failed!', $exception->getMessage());
        }
        return $this->onSuccess($data, 'Update User Success! '.$pass);
    }
    
    public function getInformation()
    {
        
        try {
            $data = auth('sanctum')->user();
        } catch (\Exception $exception) {
            return $this->onError('Get Information Failed!', $exception->getMessage());
        }
        return $this->onSuccess($data, 'Get Information Success!');
    }

    public function addFavoritePlace(Request $req)
    {
        try {
            $req->validate([
                'place_ids' => 'required',
            ]);
            
            $user = auth('sanctum')->user();

            DB::beginTransaction();
            $favorite = Favorite::create([
                'user_id' => strtolower($user->id),
            ]);
            $place_fav_items = explode(',', $req->input('place_ids'));

            foreach($place_fav_items as $place_id){
                FavoritePlaceItems::create([
                    'favorite_id' => $favorite->id,
                    'place_id' => (int)$place_id
                ]);
            }
            $data = $favorite->with('places')
            ->where('user_id', auth('sanctum')->user()->id)
            ->get();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->onError('Add Favorite Place Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'Add Favorite Place Success!');
    }
    
    public function deleteFavoritePlace($id)
    {
        try {
            DB::beginTransaction();
            $user = auth('sanctum')->user();
            $place = Favorite::findorfail($id);
            if($place->user_id == $user->id){
                FavoritePlaceItems::where('favorite_id', $id)->delete();
                $place->delete();
            }else{
                return $this->onUnauthorized();
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->onError('Delete Place Failed!', $exception->getMessage());
        }

        return $this->onSuccess('', 'Delete Place Success!');
    }
    
    public function getFavoritePlaces()
    {
        try {
            $data = Favorite::with('places')
            ->where('user_id', auth('sanctum')->user()->id)
            ->get();
        } catch (\Exception $exception) {
            return $this->onError('Get Favorite Place Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'Get Favorite Place Success!');
    }

    public function touchPlace($id)
    {
        try {
            DB::beginTransaction();
            UserInteractLogs::create([
                'user_id' => auth('sanctum')->user()->id,
                'place_id' => (int)$id
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->onError('Touch Place Failed!', $exception->getMessage());
        }

        return $this->onSuccess('', 'Touch Place Success!');
    }
}
