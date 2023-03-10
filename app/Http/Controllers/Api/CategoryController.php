<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Constants\Params;

class CategoryController extends Controller
{

    // api list-category
    public function categories()
    {
        $categories = DB::table('categories')->paginate(Params::LIMIT_SHOW);
        return response(['data'=>$categories]);
    }


}
