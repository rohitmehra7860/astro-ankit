<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Tarits\ImageUploadTrait;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $catalogs =  Catalog::get();
        return view('admin.catalogs.index', compact('catalogs'));
    }

    public function create()
    {
        return view('admin.catalogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
            'pdf_url' => 'required|mimes:pdf|max:20480',
        ]);

        if ($request->hasFile('image_url')) {
            $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/catalogs');
        }

        $pdfPath = $this->uploadImage($request->file('pdf_url'), 'uploads/catalogs-pdf');

        // Store catalog post
        Catalog::create([
            'title' => $request->title,
            'image_url' => $imagePath ?? "",
            'pdf_url' => $pdfPath
        ]);

        return redirect()->route('admin.catalogs.index')->with('success', 'Catalog Created successfully!');
    }

    public function edit($id)
    {
        $catalog = Catalog::where('id', $id)->first();
        return view('admin.catalogs.edit', compact('catalog'));
    }

    public function update(Request $request, $id)
    {
        $catalog = Catalog::where('id', $id)->firstOrFail();

        $request->validate([
            'title' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
            'pdf_url' => 'nullable|mimes:pdf|max:20480',
        ]);

        if ($request->hasFile('image_url')) {
            if ($catalog->image_url && file_exists(public_path($catalog->image_url))) {
                unlink(public_path($catalog->image_url));
            }
            $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/catalogs');
            $catalog->image_url = $imagePath;
        }

        if ($request->hasFile('pdf_url')) {
            if ($catalog->pdf_url && file_exists(public_path($catalog->pdf_url))) {
                unlink(public_path($catalog->pdf_url));
            }
            $pdfPath = $this->uploadImage($request->file('pdf_url'), 'uploads/catalogs-pdf');
            $catalog->pdf_url = $pdfPath;
        }


        $catalog->update([
            'title' => $request->title,
        ]);

        return redirect()->route('admin.catalogs.edit', $catalog->id)->with('success', 'Catalog updated successfully!');
    }


    public function delete($id)
    {
        $catalog = Catalog::where('id', $id)->first();

        if ($catalog->image_url && file_exists(public_path($catalog->image_url))) {
            unlink(public_path($catalog->image_url));
        }

        if ($catalog->pdf_url && file_exists(public_path($catalog->pdf_url))) {
            unlink(public_path($catalog->pdf_url));
        }

        $catalog->delete();

        return redirect()->route('admin.catalogs.index')->with('success', 'Catalog Deleted successfully!');
    }

    public function multipleDelete(Request $request)
    {

        $request->validate([
            'ids' => 'required|array',
        ], [
            'ids.required' => 'Please select the item(s) to delete.',
        ]);

        $catalogs = Catalog::whereIn('id', $request->ids)->get();

        foreach ($catalogs as $item) {
            if ($item->image_url && file_exists(public_path($item->image_url))) {
                unlink(public_path($item->image_url));
            }
            if ($item->pdf_url && file_exists(public_path($item->pdf_url))) {
                unlink(public_path($item->pdf_url));
            }
        }
        Catalog::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.catalogs.index')->with('success', 'Catalogs deleted successfully.');
    }


    public function reorder(Request $request)
    {
        foreach ($request->order as $orderData) {
            Catalog::where('id', $orderData['id'])->update(['order' => $orderData['position']]);
        }
        return redirect()->route('admin.galleries.index')->with('success', 'Catalogs order updated successfully!');
    }
}
