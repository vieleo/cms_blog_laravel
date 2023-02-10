<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    // api list-category
    public function categories()
    {
        $categories = DB::table('categories')->paginate(5);
        return response(['data'=>$categories]);
    }


}
