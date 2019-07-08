<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use App\PartnerStatesCovered;

class PartnersController extends Controller
{
    function index(){

    	return view('dashboard.partners.index');

    }

    function getAll(){

    	$partners = Partner::all();
    	return response()->json(['partners' => $partners]);

    }

	function create(){

		return view('dashboard.partners.create');

	}

	function store(Request $request){

		$partner = new Partner;
		$partner->name = $request->name;
		$partner->phone = $request->phone;
		$partner->address = $request->address;
		$partner->city_id = $request->city;
		$partner->save();

		foreach($request->statesCovered as $stateCovered){

			$state = new PartnerStatesCovered;
			$state->partner_id = $partner->id;
			$state->state_id = $stateCovered['id'];
			$state->save();

		}

		return response()->json(['success' => true, 'message' => 'Partner created']);

	}

}
