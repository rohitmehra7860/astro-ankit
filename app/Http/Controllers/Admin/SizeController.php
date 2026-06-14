<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{

    public function index()
    {
        $sizes = Size::latest()->paginate(10);
        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:sizes,name',
            'code' => 'required|string|max:4|unique:sizes,code'
        ]);

        Size::create($request->all());

        return redirect()->route('admin.sizes.index')->with('success', 'Size created successfully');
    }

    public function edit($id)
    {
        $size = Size::where('id', $id)->first();

        return view('admin.sizes.edit', compact('size'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:sizes,name,' . $id,
            'code' => 'required|string|max:4|unique:sizes,code,' . $id,
        ]);

        $size = Size::where('id', $id)->first();
        $size->update($request->all());

        return redirect()->route('admin.sizes.edit', $id)->with('success', 'Size updated successfully!');
    }

    public function delete($id)
    {
        $size = Size::findOrFail($id);

        $isUsed = ProductAttribute::where('size_id', $size->id)->exists();

        if ($isUsed) {
            return redirect()->route('admin.sizes.index')->with('error', 'Cannot delete. This size is used in product.');
        }

        $size->delete();

        return redirect()->route('admin.sizes.index')->with('success', 'Size deleted successfully!');
    }


    public function multipleDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
        ], [
            'ids.required' => 'Please select the item(s) to delete.',
        ]);

        $deletableIds = [];
        $nonDeletableNames = [];

        foreach ($request->ids as $id) {
            $size = Size::find($id);

            if ($size && !$size->attributes()->exists()) {
                $deletableIds[] = $id;
            } else {
                $nonDeletableNames[] = $size->name ?? 'ID: ' . $id;
            }
        }

        if (!empty($deletableIds)) {
            Size::whereIn('id', $deletableIds)->delete();
        }

        if (!empty($nonDeletableNames)) {
            return redirect()->route('admin.sizes.index')->with('error', 'Some sizes were not deleted because they are in use: ' . implode(', ', $nonDeletableNames));
        }

        return redirect()->route('admin.sizes.index')->with('success', 'Selected sizes deleted successfully.');
    }
}
