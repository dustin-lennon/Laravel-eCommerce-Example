<?php

namespace App\Http\Controllers;

use App\Models\Post; // Import the Post model class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Post::withTrashed()->find(56)->forceDelete();
        // Post::withTrashed()->find(57)->restore();

        // return Post::all();
        return Post::onlyTrashed()->get();
    }
}
