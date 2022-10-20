<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\UserDetailResources;
use App\Http\Requests\UserDetailRequest;

class UserApiController extends Controller
{
    public function createDetails(UserDetailRequest $request)
    {
        $input = $request->validated();

        $userDetail = $request->user()
                                ->details()
                                ->create($input);

        return new UserDetailResources($userDetail);
    }

    public function me(Request $request)
    {
        return response()->json([
            'error' => false,
            'data' => $request->user()
        ], 200);
    }

    public function details(Request $request)
    {
        $details = $request->user()->details;

        return UserDetailResources::collection($details);
    }
}
