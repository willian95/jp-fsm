<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\County;
use App\City;

class AddressesController extends Controller
{
    
	function allStates(){

		$states = State::all();
		return response()->json(['states' => $states]);

	}

	function allCounties(){

		$counties = County::all();
		return response()->json(['counties' => $counties]);

	}

	function allCities(){

		$cities = City::all();
		return response()->json(['cities' => $cities]);

	}

	function countyByStateId($id){

		$counties = County::where('estado_id', $id)->get();
		return response()->json(['counties' => $counties]);

	}

	function cityByCountyId($id){

		$cities = City::where('municipio_id', $id)->get();
		return response()->json(['cities' => $cities]);

	}

}
