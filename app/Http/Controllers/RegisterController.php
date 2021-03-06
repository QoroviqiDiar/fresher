<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Transformers\UserTransformer;
use App\User;
use function bcrypt;
use function fractal;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function register(StoreUserRequest $request)
    {

        $user = new User;

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return fractal()->item($user)
            ->transformWith(new UserTransformer)
            ->toArray();

        
    }
}
