<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index', [
            'products' => Product::active()->latest()->paginate(12),
            'productsCount' => Product::where('is_active', true)->count(),
            'archivedProductsCount' => Product::where('is_active', false)->count(),
            'categoryOptions' => Product::categoryOptions(),
        ]);
    }

    public function create()
    {
        return view('product.create', [
            'products' => Product::latest()->paginate(9),
            'productsCount' => Product::where('is_active', true)->count(),
            'archivedProductsCount' => Product::where('is_active', false)->count(),
            'categoryOptions' => Product::categoryOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'category' => ['required', Rule::in(Product::categoryValues())],
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:5120',
        ]);

        $data['is_active'] = true;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect($request->input('redirect_to', '/product/create'))
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit(Product $product)
    {
        return view('product.edit', [
            'product' => $product,
            'productsCount' => Product::where('is_active', true)->count(),
            'archivedProductsCount' => Product::where('is_active', false)->count(),
            'categoryOptions' => Product::categoryOptions(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'category' => ['required', Rule::in(Product::categoryValues())],
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect($request->input('redirect_to', '/product/create'))
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product)
    {
        $product->update(['is_active' => false]);

        return redirect('/product/create')->with('success', 'Produto arquivado com sucesso!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        if (! $product->is_active && ! (auth()->check() && auth()->user()->isAdmin())) {
            abort(404);
        }

        return view('product.show', [
            'product' => $product,
            'categoryOptions' => Product::categoryOptions(),
        ]);
    }
}
