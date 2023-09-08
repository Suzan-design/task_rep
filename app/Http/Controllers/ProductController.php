<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(Request $request){
        $data = Product::create([
            'url'=>$request->url,
            'name'=>$request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => $request->userId,
            'page_id' => $request->pageId,
        ]);
        return $data;
       }
}
