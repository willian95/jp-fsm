<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FieldManager as FE;
use App\Partner;

class FEController extends Controller
{
    
	function index(){
		return view('dashboard.fieldengineers.index');
	}

	function getFE(){

		$feData = [];
		$fe = FE::all();

		foreach($fe as $data){
			$partner = Partner::find($data->partner_id);
			$feData[] = [

				"name" => $data->name,
				"phone" => $data->phone,
				"address" => $data->address,
				"partner" => $partner->name

			];

		}

		return response()->json(['fe' => $feData]);

	}

	function store(Request $request){

		$fe = new FE;
		$fe->name = $request->name;
		$fe->phone = $request->phone;
		$fe->address = $request->address;
		$fe->partner_id = $request->partner_id;
		$fe->save();

		return response()->json(['success' => true, 'message' => 'Field Engineer creado']);

	}

}
