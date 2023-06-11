<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Vinkla\Hashids\Facades\Hashids;
use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Inertia::share('blogs', $this->getBlogs() );
        return Inertia::render('Blog/index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:255',
        ]);

        $user = Blog::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog, String $id)
    {
        $blog = Blog::where('id','=',Hashids::decode($id)[0])->where('user_id','=',Auth::user()->id)->first();
        Inertia::share('blog', $blog );
        return Inertia::render('Blog/edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog, String $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:255',
        ]);
        Blog::where('id','=',Hashids::decode($id)[0])->update([
            'title' =>  $request->title,
            'body' =>  $request->body,
        ]);
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, string $id)
    {
        Blog::find(Hashids::decode($id)[0])->delete();
        return  $this->getBlogs();
    }


    /**
     * returns blog listing
     */
    private function getBlogs()
    {
        return Blog::where('user_id','=',Auth::user()->id)->orderBy('created_at','desc')->with('comments.user')->get();
    }

}
