<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View{
        $categories = Category::all();

        return view('admin.category.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.category.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'cat_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ], [
            'cat_name.required' => 'Nama kategori wajib diisi',
            'cat_name.string' => 'Nama kategori harus berupa teks',
            'cat_name.max' => 'Nama kategori maksimal 255 karakter',
            'description.required' => 'Deskripsi wajib diisi',
            'description.string' => 'Deskripsi harus berupa teks',
            'description.max' => 'Deskripsi maksimal 255 karakter',
        ]);

        $category = Category::create($validatedData);

        $message = 'Kategori ' . $category->cat_name .' berhasil ditambahkan';

        return redirect()->route('admin.categories.index')
            ->with('success', $message);
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, string $id){

        $validatedData = $request->validate([
            'cat_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ], [
            'cat_name.required' => 'Nama kategori wajib diisi',
            'cat_name.string' => 'Nama kategori harus berupa teks',
            'cat_name.max' => 'Nama kategori maksimal 255 karakter',
            'description.required' => 'Deskripsi wajib diisi',
            'description.string' => 'Deskripsi harus berupa teks',
            'description.max' => 'Deskripsi maksimal 255 karakter',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        $message = 'Kategori ' . $category->cat_name .' berhasil diperbarui';

        return redirect()->route('admin.categories.index')
            ->with('success', $message);
    }

    public function destroy(string $id){
        $category = Category::findOrFail($id);
        $category->delete();

        $message = 'Kategori ' . $category->cat_name .' berhasil dihapus';

        return redirect()->route('admin.categories.index')
            ->with('success', $message);
    }

}
