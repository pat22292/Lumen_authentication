<?php

namespace App\Http\Controllers;

use App\User;
use App\Transformer\UserTransformer;
use App\Repository\UsersRepository;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Laravel\Passport\Bridge\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use Helpers;
    
    protected $userRepository;
    protected $userTransformer;



    public function __construct(UsersRepository $userRepository,UserTransformer $userTransformer){
        $this->userRepository = $userRepository;
        $this->userTransformer = $userTransformer;
    }

    public function show(){
        $user = $this->userRepository->getAll();
        $response = $this->response->collection($user, $this->userTransformer);
        return $response;
    }
    public function showById($id){
        $user = $this->userRepository->getByID($id);
        $response = $this->response->item($user, $this->userTransformer);
        return $response;
    }
     public function register(Request $request){
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'address' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $user = new User();
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->address = $request['address'];
        $user->status = $request['status'];
        $user->save();

        $response = $this->response->item($user, $this->userTransformer);
        return response($response, 201);
    }
}
