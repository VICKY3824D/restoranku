<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemAdminRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::orderBy('name', 'asc')->get();

        return view('admin.item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::orderBy('cat_name', 'asc')->get();

        return view('admin.item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemAdminRequest $request)
    {
        $validated_data = $request->validated();

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img_item_upload/'), $imageName);
            $validated_data['img'] = $imageName;
        }

        $item = Item::create($validated_data);

        $message = 'Item ' . $item->name . ' berhasil ditambahkan';

        return redirect()->route('admin.items.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::orderBy('cat_name', 'asc')->get();

        return view('admin.item.edit', compact('item', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemAdminRequest $request, string $id)
    {
        $validated_data = $request->validated();

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img_item_upload/'), $imageName);
            $validated_data['img'] = $imageName;
        }

        $item = Item::findOrFail($id);
        $item->update($validated_data);

        $message = 'Item ' . $item->name . ' berhasil diubah';

        return redirect()->route('admin.items.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);

        // delete image first from public folder
        if ($item->img) {
            $imagePath = public_path('img_item_upload/' . $item->img);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // then delete the item
        $item->delete();

        $message = 'Item ' . $item->name . ' berhasil dihapus';

        return redirect()->route('admin.items.index')->with('success', $message);
    }
}
