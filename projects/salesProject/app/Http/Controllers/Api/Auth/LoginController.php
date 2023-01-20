<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthUserRequest;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct(
        protected  User $user) {}


    public function login(AuthUserRequest $request) {

        $req = $request->validated();

        $user = $this->user->with('profile', 'company.unity.director')->where('email', $req['email'])->first();

        if (!$user || !Hash::check($req['password'], $user->password)) {
            throw ValidationException::withMessages(['Verifique as credenciais fornecidas.']);
        }

        return (new UserResource($user))->additional([
            'token' => $user->createToken('API')->plainTextToken
        ]);

    }

    public function logout () {

       Auth::user()->tokens()->delete();
        return response()->json([ 'success' => true]);
    }


}
