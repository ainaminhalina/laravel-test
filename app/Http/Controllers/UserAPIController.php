<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//library to do database query
use Illuminate\Support\Facades\DB; 

class UserAPIController extends Controller
{
	//Request to get data we pass from the form (put, post, get, delete)
    public function update(Request $request){
		$id = $request->input('id');
		$name = $request->input('name');
		$email = $request->input('email');
		$address = $request->input('address');
		$phoneno = $request->input('phoneno');
			
		$returnJSON = array();
		$isUpdated = DB::table('users')
						  ->where('id', $id)
						  ->update(
								[
									'name' => $name,
									'email' => $email,
									'address' => $address,
									'phoneno' => $phoneno,
								]
							);
            if($isUpdated){
				$returnJSON['code'] = 200;
				$returnJSON['message'] = "Profile updated successful!";
			}
			else{
				$returnJSON['code'] = 500;
				$returnJSON['message'] = "Profile updated fail";
			}
		echo json_encode($returnJSON);
	}
}
