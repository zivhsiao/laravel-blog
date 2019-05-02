<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;

class BlogController extends Controller
{

    public function home($id){

        $post = Post::leftJoin('categories', 'categories.id', '=', 'posts.category_id')
                    ->where([['posts.status', 'PUBLISHED'], ['posts.id', $id]])->first();

        return view('blog.view', ['post' => $post]);

    }
}
