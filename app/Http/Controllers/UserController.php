<?php

namespace App\Http\Controllers;

// use App\User;
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

    public function show(Request $request){
      $verifiedUser = $request->user()->verified;
      
      if ($verifiedUser == false) {
       
        return "You're account is not verified";
      }
      else {
        $user = $this->userRepository->getAll();
        $response = $this->response->collection($user, $this->userTransformer);
        return $response;
      } 
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
            'contact_no' => 'required|digits:12',
            'password' => 'required|string'
        ]);
        $user = $this->userRepository->store($request);
         $response = $this->response->item($user, $this->userTransformer);
        return $response;
    }
}
