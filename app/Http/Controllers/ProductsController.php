<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductsModel;
use App\Models\CategoriesModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = ProductsModel::with('category')->latest()->get();

        return view('products.index', compact('products'));
    }


    public function create()
    {
        $categories = CategoriesModel::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'code'        => 'nullable|string|max:255|unique:products,code',
            'merk'        => 'required|string|max:255',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $photoPath = $file->storeAs('products', $filename, 'public');
        }

        ProductsModel::create([
            'category_id' => $validated['category_id'],
            'name'        => $validated['name'],
            'code'        => $validated['code'],
            'merk'        => $validated['merk'],
            'photo'       => $photoPath,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil disimpan!');
    }

    public function edit(ProductsModel $product)
    {
        $categories = CategoriesModel::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, ProductsModel $product)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name'        => 'required|string|max:255',
            'code'        => 'required|string|max:255|unique:products,code,' . $product->id,
            'merk'        => 'required|string|max:255',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($product->photo && Storage::disk('public')->exists($product->photo)) {
                Storage::disk('public')->delete($product->photo);
            }
            $file = $request->file('photo');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $product->photo = $file->storeAs('products', $filename, 'public');
        }

        $product->category_id = $validated['category_id'] ?? null;
        $product->name = $validated['name'];
        $product->code = $validated['code'];
        $product->merk = $validated['merk'];
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbaharui!');
    }

    public function destroy(ProductsModel $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
