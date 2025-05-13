<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTAuth;

class CompanyController extends Controller
{
	

		public function login(Request $request)
		{
			$credentials = request(['email', 'password']);
			if (! $token = JWTAuth::attempt($credentials)) 
			{
				return response()->json(['success' => 0, 'message' => 'These credentials do not match our records.'], 200);
			}

			$user = JWTAuth::user();

			if(JWTAuth::user())
			{

			return response()->json(['success' => 1, 'token' => $token,'user'=>$user,'message'=>'Login Successfully.']);
			}
			
			else
			{
				return response()->json(['success' => 0, 'message'=>'Error.']);
			}
		}

	public function getuser(Request $request){

		$data=User::where('id',JWTAuth::user()->id)->first();

		return response()->json(['success'=>1,'data' => $data]);
	}


	public function list($id){

		return User::find($id);
	} 

	public function store(Request $request){

		$param=$request->all();
		$param['show_password']=$param['password'];
             
		$company=User::create($param);

		if(isset($request['image'])){

                $data=time().'.'. $request->image->getClientOriginalExtension();
                $request->image->move(public_path('img/'),$data);
                $param['image']=$data;
            }



		return response()->json(['success' =>  1, 'message' => 'company created Successfully']);

	}


	public function update(Request $request)
	{
		$param=$request->all();
		
		$param=User::where('id',$request->id)->update($param);
		if($param){

		return response()->json(['Success' => 1,'message' => 'update Successfully']);
	
		}else{
			return response()->json(['Success' => 0,'message' => 'error']);
	 }
}



	public function delete(Request $request)
	{

		$data=User::where('id',$request->id)->delete();    	
		
		if($data){

			return response()->json(['Success' => 1 ,'message' => 'delete Successfully']);
		}
		else{
			return response()->json(['success' => 0,'message' => 'Error']);
		}

	
 }



	
}