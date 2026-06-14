<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::latest()->paginate(10);
        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:colors,name',
            'code' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/|unique:colors,code'
        ]);

        Color::create($request->all());

        return redirect()->route('admin.colors.index')->with('success', 'Color created successfully');
    }

    public function edit($id)
    {
        $color = Color::where('id', $id)->first();

        return view('admin.colors.edit', compact('color'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:colors,name,' . $id,
            'code' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/|unique:colors,code,' . $id,
        ]);

        $color = Color::where('id', $id)->first();
        $color->update($request->all());

        return redirect()->route('admin.colors.edit', $id)->with('success', 'Color updated successfully!');
    }

    public function delete($id)
    {
        $color = Color::findOrFail($id);

        $isUsed = ProductAttribute::where('color_id', $color->id)->exists();

        if ($isUsed) {
            return redirect()->route('admin.colors.index')->with('error', 'Cannot delete. This color is used in product.');
        }

        $color->delete();

        return redirect()->route('admin.colors.index')->with('success', 'Color deleted successfully!');
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
            $color = Color::find($id);

            if ($color && !$color->attributes()->exists()) {
                $deletableIds[] = $id;
            } else {
                $nonDeletableNames[] = $color->name ?? 'ID: ' . $id;
            }
        }

        if (!empty($deletableIds)) {
            Color::whereIn('id', $deletableIds)->delete();
        }

        if (!empty($nonDeletableNames)) {
            return redirect()->route('admin.colors.index')->with('error', 'Some colors were not deleted because they are in use: ' . implode(', ', $nonDeletableNames));
        }

        return redirect()->route('admin.colors.index')->with('success', 'Selected colors deleted successfully.');
    }
}
