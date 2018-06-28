<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->email,
                    'password' => $request->password,
                    'private' => $request->private,
                    'scope' => '*'
                ]
            ]);

            if ($request->private == config('services.passport.do_not_use')) {
                  return $response->getBody();
            }
            else{
                return $json = [
                'message' => 'Intruders Alert, stop accessing my app mother fucker!',
                ];
            }
          
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }
    public function logout(Request $request)
    {

        $accessToken = $request->user()->token();
   
        $refreshToken = DB::table('oauth_refresh_tokens')
        ->where('access_token_id', $accessToken->id)
        ->delete();
        $accessToken->delete();
        $json = [
            'code' => 200,
            'message' => 'You are Logged out.',
        ];
        return response()->json($json, '200');

    }
    public function verify (Request $request) {
        $vCode = $request->user()->v_code;
        $vCodeRequest =  $request->vcode;
        $userID = $request->user()->id;
        if ($vCodeRequest == $vCode) {
            $user = User::find($userID);
            $user->verified = 1;
            $user->save();
            return $user->verified;
        }
        else {
            return 'Invalid Verification Code';
        }
        
    }
}
