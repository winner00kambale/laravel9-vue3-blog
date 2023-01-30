<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class RelatedPostController extends Controller
{
    public function index(Post $post){
        $category = $post->category;

        $relatedPost = $category->posts()->where('id', '!=', $post->id)->latest()->take(2)->get();
        return PostResource::collection($relatedPost);
    }
}
