<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Activity;
use App\Models\Tag;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $projects =  Activity::with(['task.project'])->where('user_id', auth()->id())->get();
        dd($projects);
        $categories = Category::get();

        $tags = Tag::get();

        return view('frontend.home', compact('categories', 'projects', 'tags'));
    }
}
