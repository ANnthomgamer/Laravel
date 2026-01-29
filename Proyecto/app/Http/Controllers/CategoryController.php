<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    //  Muestra el formulario de creación
    public function create()
    {
        // Devuelve la vista donde estará el formulario
        return view('categories.create');
    }

    // Guarda la nueva categoría en la base de datos
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($data);

        // Redirige al listado de productos o a donde prefieras
        return redirect()->route('products.index')->with('ok', 'Categoría creada correctamente');
    }
}

