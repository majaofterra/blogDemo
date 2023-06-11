<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Blog;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $blogs = Blog::where('user_id', '!=', Auth::user()->id)->with('user')->get();
        }else{
            $blogs = Blog::with('user')->get();
        }
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'blogs' => $blogs,
            'logedin' => Auth::check(),
        ]);
    }
}
