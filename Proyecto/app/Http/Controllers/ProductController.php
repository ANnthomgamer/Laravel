<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // OPCION3: listado general
    public function index()
    {
        $products = Product::with('category')->orderBy('id')->get();
        return view('products.index', compact('products'));
    }

    // OPCION2: formulario alta
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    // OPCION2: guardar alta
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required|min:3',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($data);
        return redirect()->route('products.index')->with('ok', 'Producto guardado correctamente');
    }

    // OPCION4: formulario filtro
    public function filterForm()
    {
        return view('products.filter');
    }

    // OPCION4: resultados filtro (ejemplo simple)
    public function filterResults(Request $request)
    {
        $request->validate([
            'criterion' => 'required|in:low_stock,stock_gt_10,price_lt_20',
        ]);

        $q = Product::with('category');

        if ($request->criterion === 'low_stock') {
            $q->where('stock', '<=', 5);
        } elseif ($request->criterion === 'stock_gt_10') {
            $q->where('stock', '>', 10);
        } else { // price_lt_20
            $q->where('price', '<', 20);
        }

        $products = $q->orderBy('id')->get();
        return view('products.index', compact('products'));
    }

    // OPCION5: pantalla “gestión” (elige y accede a editar/borrar)
    public function manage()
    {
        $products = Product::with('category')->orderBy('id')->get();
        return view('products.manage', compact('products'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'description' => 'required|min:3',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($data);
        return redirect()->route('products.manage')->with('ok', 'Producto actualizado');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.manage')->with('ok', 'Producto borrado');
    }
}


