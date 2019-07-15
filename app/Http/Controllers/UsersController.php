<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{

	function index(){
		return view('dashboard.users.index');
	}

	function getUsers(){

		$users = User::all();
		return response()->json(['users' => $users]);

	}

	function store(Request $request){

		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->save();

		return response()->json(['success' => true, 'message' => 'Usuario creado']);

	}

	function delete($id){

		$user = User::findOrFail($id);
		$user->delete();

		return response()->json(['success' => true, 'message' => 'Usuario eliminado']);

	}

}
