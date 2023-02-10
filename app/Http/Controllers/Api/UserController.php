<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // profile-user
    public function profile_user()
    {
        $profile = User::find(auth('api')->user()->id)->profile;
        $user = $profile;
        return response()->json([
            'status' => 'success',
            'profile' => $user,
            'user' => auth('api')->user()
        ]);
    }

    // update-profile
    public function update_profile(Request $request)
    {
        $user = User::findOrFail(auth('api')->user()->id);
        $user->profile()->updateOrCreate(
            ['user_id' => auth('api')->user()->id],
            [
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
            ]
        );
        $profile = User::find(auth('api')->user()->id)->profile;
        $user['profile'] = $profile;
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully edit profile',
            'user' => $user,
        ]);
    }
}
