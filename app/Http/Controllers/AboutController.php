<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'file' => 'required | image',
            'body' => 'required',

        ]);
        $name = $request->name;
        $body = $request->input('body');
        $imagePath = 'storage/' . $request->file('file')->store('aboutImages', 'public');

        // create and save

        $about = new About();
        $about->name = $name;
        $about->body = $body;
        $about->imagePath = $imagePath;
        $about->save();

    }
}
