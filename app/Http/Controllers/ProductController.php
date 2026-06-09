<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('product.index', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::latest()->get();

        return view('product.create', [
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:5120',
        ]);

        $data['stock'] = 0;
        $data['is_active'] = 1;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect('/product/create')->with('success', 'Produto cadastrado com sucesso!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'category' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        'stock' => 'nullable|integer'
    ]);

    $validated['stock'] = $validated['stock'] ?? 0;

    if ($request->hasFile('image')) {
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }

        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($validated);

    return redirect('/product/create')->with('success', 'Produto atualizado com sucesso!');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Product $product)
{
    if ($product->image && \Storage::disk('public')->exists($product->image)) {
        \Storage::disk('public')->delete($product->image);
    }

    $product->delete();

    return redirect('/product/create')->with('success', 'Produto excluído com sucesso!');
}

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

}
