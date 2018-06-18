<?php

namespace App\Repository;

use App\User;
use Illuminate\Support\Facades\Hash;

class UsersRepository
{
    public function getAll(){
        $users = User::all();
        return $users;
    }
    public function getByID($id){
        $users = User::where('id', $id)->first();
        return $users;
    }
    public function getByEmail($email){
        $users = User::where('email', $email)->first();
        return $users;
    }
    public function store(Request $request){
        $user = new User();
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->address = $input['address'];
        $user->status = $input['status'];
        $user->save();
    }
    public function updateUser($id , $input){
        $user = User::find($id);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->address = $input['address'];
        $user->status = $input['status'];
        $user->save();
    }
    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
    }
}
