<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to Laravel';
        $posts = Post::all();
        return view('Pages.index',
            [
                'title' => $title,
                'posts' => $posts,
            ]
        );
    }

    public function about(){
        $title = 'About Us!';
        return view('Pages.about')->with('title', $title);
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('Pages.services')->with($data);
    }


}
