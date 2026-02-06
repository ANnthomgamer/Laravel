<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Provider;


class CategoryController extends Controller{

    public function create(){
	return view('categories.create');

    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($data);

	return redirect()->route('products.index')->with('ok', 'Categoría creada correctamente');

    }
}

