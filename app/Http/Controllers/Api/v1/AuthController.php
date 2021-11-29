<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogupRequest;
use App\Http\Requests\RecoverRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\Store;

class AuthController extends Controller
{
    public function check(Request $request)
    {
        return $request->session()->all();
    }

    public function login(LoginRequest $request)
    {
        $user = User::where("login", $request->get("login"))->first();
        if ($user!==null)
        {
            if (hash("sha256", $request->get("password").$user->salt) == $user->password)
            {
                $token = md5(random_bytes(64));
                session()->put("user_id", $user->id);
                return Response(["session"=>$token], \Illuminate\Http\Response::HTTP_OK);
            }
        }
        return Response("fail", \Illuminate\Http\Response::HTTP_FORBIDDEN);
    }

    public function logup(LogupRequest $request)
    {
        $newUser = User::createNewUser($request->get("login"), $request->get("password"), $request->get("email"));
        if ($request->exists("auto_auth"))
            session(["user_id"=>$newUser->id]);

        return $newUser??Response("fail", \Illuminate\Http\Response::HTTP_FORBIDDEN);
    }

    public function recover(RecoverRequest $request)
    {
        return Response("В РАЗРАБОТКЕ", Response::HTTP_NO_CONTENT);
    }

}
