<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
   public function addPage(Request $request){
    $data = Page::create([
        'url'=>$request->url,
        'name'=>$request->name,
        'description' => $request->description,
        'category' => $request->category,
        'user_id' => $request->id
    ]);
    return $data;
   }
}
