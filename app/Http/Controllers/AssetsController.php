<?php

namespace App\Http\Controllers;
use App\Asset;

use Illuminate\Http\Request;


class AssetsController extends Controller
{

    function index(){

        return view('dashboard.assets.index');

    }

    function create(){

        return view('dashboard.assets.create');

    }

    function store(Request $request){

        $asset = new Asset;
        $asset->name = $request->asset;
        $asset->save();

        return redirect()->back()->with('success', 'Activo creado');

    }
}
