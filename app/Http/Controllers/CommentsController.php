<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use Vinkla\Hashids\Facades\Hashids;
use Auth;

class CommentsController extends Controller
{

    public function store(Request $request, String $id)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Comments::create([
            'comment' => $request->comment,
            'blog_id' => Hashids::decode($id)[0],
            'user_id' => Auth::user()->id
        ]);


    }
}
