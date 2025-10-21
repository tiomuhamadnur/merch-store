<?php

namespace App\Http\Controllers;

use App\Models\RolesModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function index()
    {
        $roles = RolesModel::get();

        return view('settings.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('settings.roles.create');
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

        $category = RolesModel::create([
            'name' => $validated['name'],
            'code' => $validated['code'],
        ]);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(RolesModel $role)
    {
        return view('settings.roles.edit', compact('role'));
    }

    public function update(Request $request, RolesModel $role)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($role->id),
            ],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('categories', 'code')->ignore($role->id),
            ],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama sudah digunakan.',
            'code.required' => 'Kode wajib diisi.',
            'code.unique'   => 'Kode sudah digunakan.',
        ]);

        $role->update($validated);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Kategori berhasil diperbaharui.');
    }

    public function destroy(RolesModel $category)
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
