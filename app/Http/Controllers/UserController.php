<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function viewLayout(){
		$users = DB::table('users')
                     ->where('id', Auth::id())
                     ->get();
					 
		return view('view')
					->with('users', $users);
	}	
}
