<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Friend;
use App\Models\Invite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);
        if($validator->fails()){
            return $validator->errors();
        }else{
            $data = User::create([
                'name'=>$request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return $data;
        }

    }

    public function login(Request $request){
        if(auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            $user = auth()->user();
            return $user;
            return "ok";
        }
        return "no";
    }

    public function discount(Request $request){
        $product = Product::find($request->id);
        $product->withDiscount = true;
        $product->price = $product->price - $request->discount;
        $product->save();
    }

    public function addMember(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);
        if($validator->fails()){
            return $validator->errors();
        }else{
            $data = User::create([
                'name'=>$request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $permission = Permission::create([
                'name' => $data->name,
                'permission' => 'add posts',
                'status' => true,
            ]);
            return $data;
        }
    }

    public function getInformation(Request $request){
        $match = ['user_id' => $request->id];
        $Number_of_products = Product::where($match)
                ->count('name');

        $matchThese = ['status' => 'sold', 'user_id' => $request->id];
        $Number_of_products_sold = Product::where($matchThese)
                ->count('name');

        $profits = DB::table('users')
                ->where('id', $request->id)
                ->value('profits');

        return (array
        (
            $Number_of_products,
            $Number_of_products_sold,
            $profits
        ));
    }

    public function blockUser(Request $request){
        $user = User::find($request->id);
        DB::table('permissions')
            ->where('name', $user->name)
            ->update(['status' => false]);
        return "User permissions have been changed";
    }

    public function addFriend(Request $request){
        $data = Friend::create([
            'first_user_id'=>$request->first_user_id,
            'second_user_id' => $request->second_user_id,
        ]);
        return "Users are friends";
    }

    public function sendInvite(Request $request){
        $data = Invite::create([
            'sender_user_id'=>$request->sender_user_id,
            'reciever_user_id' => $request->reciever_user_id,
            'message' => $request->message,
        ]);
        return "The invitation has been sent";
    }

    public function sell(Request $request){
        $product = Product::find($request->product_id);
        DB::table('products')
            ->where('id', $request->product_id)
            ->update(['status' => 'sold']);
        $user = User::find($request->user_id);
        DB::table('users')
            ->where('id', $request->user_id)
            ->update(['profits' => $user->profits + $product->price * 0.02]);
    }
}
