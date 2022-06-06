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

class AuthController extends Controller
{
    use ApiHelpers;

    public function register(Request $req)
    {
        $role = "member";
        try {
            $req->validate([
                'inputEmail' => 'required|email',
                'inputPassword' => 'required',
                'inputName' => 'required',
            ]);

            if($req->has('inputRole') && auth('sanctum')->user() && auth('sanctum')->user()->role == 'admin') $role = $req->input('inputRole');

            DB::beginTransaction();
            $data = User::create([
                'email' => strtolower($req->input('inputEmail')),
                'password' => Hash::make($req->input('inputPassword')),
                'name' => $req->input('inputName'),
                'role' => $role
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->onError('User Register Failed!', $exception->getMessage());
        }

        return $this->onSuccess($data, 'User Register Success!');
    }

    public function login(Request $req)
    {
        try {
            $req->validate([
                'inputEmail' => 'required|email',
                'inputPassword' => 'required',
            ]);

            $data = User::where('email', strtolower($req->input('inputEmail')))->first();

            if(!$data || !Hash::check($req->input('inputPassword'), $data->password)){
                throw ValidationException::withMessages(['user' => 'Username atau Password Salah!']);
            }

            $token = $data->createToken('userToken')->plainTextToken;
        } catch (\Exception $exception) {
            return $this->onError('User Login Failed!', $exception->getMessage());
        }
        return $this->onSuccess([
            'user' => $data,
            'token' => $token
        ], 'User Login Success!');
    }

    public function logout(Request $req)
    {
        try {
            auth('sanctum')->user()->currentAccessToken()->delete();
        } catch (\Exception $exception) {
            return $this->onError('User Logout Failed!', $exception->getMessage());
        }
        return $this->onSuccess('', 'User Logout Success!');
    }
}
