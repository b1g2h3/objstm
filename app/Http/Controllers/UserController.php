<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
         $users = User::all();
         $users->load('invoice');
         return UserResource::collection($users);
    }
    
    public function show($id) 
    {
        $user = User::find($id);
        $user->load('orders.amounts.product', 'invoice');
        return new UserResource($user);
        
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->orders()->delete();
        $user->delete();
    }

    public function changeContact()
    {
            $user =auth()->user();
            $data = request()->validate($this->contact());
            if (!Hash::check($data['password'], $user->password)) {
                return  response(200, 'The specified password does not match the database password');
            } else {
              
                $user->email = $data['email'];
                $user->phone = $data['phone'];
                $user->push();
            }
    }
    public function changePassword() 
    {

        $user = auth()->user();
        $data = request()->validate($this->password());
        if (!Hash::check($data['old_password'], $user->password)) {
            return back()->with('error', 'The specified password does not match the database password');
        } else {
          
             $user->password = Hash::make($data['password']);
             $user->push();
        }
    }

    public function password()
    {
        return [
            'old_password' => 'required:min:8|max:200',
            'password' => 'required|min:8|max:200',
            'confirm_password' => 'required_with:password|same:password|min:8|max:200'
        ];
    }

    public function contact()
    {
        return [
            'password' => 'required:min:8|max:200',
            'email' => 'required|unique:users|string|email|max:255',
            'phone' => 'required|unique:users|max:13|min:9'
        ];
    }
}
