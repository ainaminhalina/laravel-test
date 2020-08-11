<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoryAPIController extends Controller
{
	public function addStory(Request $request){
		$title = ($request->input('title') !== null) ? $request->input('title') : "";
		$content = ($request->input('content') !== null) ? $request->input('content') : "";
		$user_id = ($request->input('user_id') !== null) ? $request->input('user_id') : "";
		
		$returnJSON = array();
		
		$story_id = DB::table('stories')->insertGetId(
			[
				'title' => $title, 
				'content' => $content,
				'user_id' => $user_id
			]
		);
		
		if($story_id){
			$returnJSON['story_id'] = $story_id;
			$returnJSON['code'] = 200;
			$returnJSON['message'] = "Story added successfully!";
		}
		else{
			$returnJSON['story_id'] = 0;
			$returnJSON['code'] = 500;
			$returnJSON['message'] = "Failed to add story!";
		}
		
		echo json_encode($returnJSON);
	}
	
	public function updateStory(Request $request){
		$id = ($request->input('id') !== null) ? $request->input('id') : "";
		$title = ($request->input('title') !== null) ? $request->input('title') : "";
		$content = ($request->input('content') !== null) ? $request->input('content') : "";
		
		$returnJSON = array();
		
		$isUpdated = DB::table('stories')
						  ->where('id', $id)
						  ->update(
								[
									'title' => $title,
									'content' => $content
								]
							);
		
		if($isUpdated){
			$returnJSON['code'] = 200;
			$returnJSON['message'] = "Story updated successfully!";
		}
		else{
			$returnJSON['code'] = 500;
			$returnJSON['message'] = "Story update failed!";
		}
		
		echo json_encode($returnJSON);
	}
	
	public function deleteStory($id){
		$isDeleted = DB::table('stories')
				->where('id', $id)
				->delete();
				
		$returnJSON = array();
		
		if($isDeleted){
			$returnJSON['code'] = 200;
			$returnJSON['message'] = "Story deleted successfully!";
		}
		else{
			$returnJSON['code'] = 500;
			$returnJSON['message'] = "Story delete failed!";
		}
		
		echo json_encode($returnJSON);
	}
}
