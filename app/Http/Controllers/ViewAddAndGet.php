<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ViewAddAndGet extends Controller
{
    public function AddView(Request $request,$id)
    {
        $post = Post::find($id);
        $post->views =$post->views+ $request->views;
        $post->save();
    }
    public function GetView()
    {
     $post= Post::orderBy('views', 'DESC')->first();
     return  response()->json(["success"=>$post]);

        // DB::table('Post')max('views');
    }
}
