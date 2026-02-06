<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Provider;

class ProviderController extends Controller{
    public function create(){
        return view('providers.create');

    }

    public function store(Request $request){
	Provider::create($request->except('_token'));

        return redirect()->route('home')->with('ok', 'PROVEEDOR_VINCULADO');

    }

    public function index(){
        $providers = Provider::all();
        return view('providers.index', compact('providers'));

    }

    public function destroy(Provider $provider){
	$provider -> delete();

	return redirect()->route('providers.index')->with('ok', 'PROVEEDOR_ELIMINADO');

    }
}
