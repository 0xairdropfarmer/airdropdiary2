<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Category;
use App\Models\Activity;
use App\Models\Tag;
class HomeController
{
    public function index()
    {
        $activities =  Activity::where('user_id', auth()->id())->get();
        // dd($activities);
        if($activities->count() == 0){
            $uniqueProject = [];
            return view('frontend.home',compact('uniqueProject'));
        }
        // dd($activities);
        foreach ($activities as $activity) {
            $project[] = $activity->task->project;
             
        } 
        $uniqueProject = collect($project)->unique(function ($project) {
            return $project->id;
        })->values()->all(); 
        $categories = Category::get();

        $tags = Tag::get();
        // dd($uniqueProject);
        return view('frontend.home', compact('uniqueProject'));
    }
}
