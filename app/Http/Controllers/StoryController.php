<?php

//controller that returns view to user
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoryController extends Controller
{
	public function __construct()
    {
		//kene authenticate user
        $this->middleware('auth');
    }

	public function storylist(){	
		$stories = DB::table('stories')
				 ->where('user_id', Auth::id())
				 ->orderBy('id','DESC')
				 ->get();
		
		return view('storylist')
				->with('stories',$stories);
	}
	
	public function updateStoryView($id){
		$story = DB::table('stories')
                     ->where('id', $id)
                     ->get();
					 
		return view('updatestory')
					->with('story', $story);
	}
}
