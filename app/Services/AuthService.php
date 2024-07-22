<?php

namespace App\Services;

use App\Events\CreateUserEvent;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event as FacadesEvent;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register($request)
    {
        $input = $request->all();
        if ($request->image) {
            $image = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('users', $image, 'files');
            $input['image'] = $path;
        }
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 2;
        $input['evaluation'] = 0;
        $user = User::create($input);
        $token = $user->createToken('Having')->accessToken;
        $success = [
            'user' => $user->name,
            'token' => $token
        ];
        FacadesEvent::dispatch(new CreateUserEvent($user));
        return response()->json(['data' => $success, 'message' => 'code sent to your gmail'], 201);
    }


    public function verification($request)
    {
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        if ($request->code == $user->code) {
            $user->StatusCode = true;
            $user->save();
            Wallet::create([
                'content' => 0,
                'user_id' => $id
            ]);
            return response()->json(['message' => 'Success'], 200);
        } else
            return response()->json(['message' => 'your code is not correct'], 422);
    }


    public function login($request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'StatusCode' => true])) {
            $user = User::query()->find(auth()->user()['id']);
            $success['token'] = $user->createToken('Having')->accessToken;
            $success['name'] = $user->name;
            return response()->json(['data' => $success], 200);
        }
        return response()->json(['message' => 'Invalid login'], 422);
    }


    public function storeFcmToken($request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $user->fcm_token = $request->fcm_token;
        $user->save();
        return response()->json(['message' => 'ok'], 200);
    }


    public function getUser()
    {
        $user = Auth::user();
        $user->image = asset('files/' . $user->image);
        if ($user->image == "/files") {
            $user->image = null;
        }
        return response()->json(['data' => $user], 200);
    }


    public function update($request)
    {
        $id = Auth::id();
        $user = User::find($id);
        if ($request->image) {
            $image = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $image, 'files');
        }
        $user->update([
            'name' => ($request->name) ? $request->name : $user->name,
            'image' => ($request->image) ? $path : $user->image,
            'age' => ($request->age) ? $request->age : $user->age,
        ]);
        return response()->json(['message' => 'User updated successfully'], 200);
    }


    public function deleteImage()
    {
        $id = Auth::id();
        $user = User::find($id);
        $user->image = null;
        $user->save();
        return response()->json(['message' => 'The image is deleted'], 200);
    }


    public function logout()
    {
        /**@var \App\Models\MyUserModel */
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'logged out Successfully'], 200);
    }
}
