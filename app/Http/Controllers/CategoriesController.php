<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsModel;
use App\Models\CategoriesModel;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = CategoriesModel::get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')],
            'code' => ['required', 'string', 'max:50', Rule::unique('categories', 'code')],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama sudah digunakan.',
            'code.required' => 'Kode wajib diisi.',
            'code.unique'   => 'Kode sudah digunakan.',
        ]);

        $category = CategoriesModel::create([
            'name' => $validated['name'],
            'code' => $validated['code'],
        ]);

        if ($request->ajax()) {
            return response()->json([
                'id' => $category->id,
                'name' => $category->name,
                'code' => $category->code,
            ], 201);
        }

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(CategoriesModel $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, CategoriesModel $category)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('categories', 'code')->ignore($category->id),
            ],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama sudah digunakan.',
            'code.required' => 'Kode wajib diisi.',
            'code.unique'   => 'Kode sudah digunakan.',
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil diperbaharui.');
    }

    public function destroy(CategoriesModel $category)
    {
        if ($category->checkRelasi() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih dipakai produk.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
