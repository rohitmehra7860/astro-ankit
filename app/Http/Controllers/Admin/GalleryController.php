<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Tarits\ImageUploadTrait;

class GalleryController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $galleries = Gallery::get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'nullable|string',
        //     'image_url' => 'required',
        //     'image_url.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
        // ]);

        // if ($request->hasFile('image_url')) {
        //     foreach ($request->file('image_url') as $image) {
        //         $imagePath = $this->uploadImage($image, 'uploads/galleries');

        //         Gallery::create([
        //             'title' => $request->title,
        //             'image_url' => $imagePath,
        //         ]);
        //     }
        // }
        $request->validate([
            'title' => 'nullable|string',
            'image_url' => 'required|array',
            'image_url.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
        ]);

        if ($request->hasFile('image_url')) {
            foreach ($request->file('image_url') as $image) {
                $imagePath = $this->uploadImage($image, 'uploads/galleries');

                Gallery::create([
                    'title' => $request->title,
                    'image_url' => $imagePath,
                ]);
            }
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery images created successfully!');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.galleries.edit', compact('gallery'));
    }


    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
        ]);

        $data = [
            'title' => $request->title,
        ];

        if ($request->hasFile('image_url')) {
            // Delete old image if it exists
            if ($gallery->image_url && file_exists(public_path($gallery->image_url))) {
                unlink(public_path($gallery->image_url));
            }

            // Upload new image
            $image = $request->file('image_url');
            $imagePath = $this->uploadImage($image, 'uploads/galleries');

            $data['image_url'] = $imagePath;
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery updated successfully!');
    }




    public function delete($id)
    {
        $gallery = Gallery::where('id', $id)->first();

        if ($gallery->image_url && file_exists(public_path($gallery->image_url))) {
            unlink(public_path($gallery->image_url));
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery image Deleted successfully!');
    }

    public function multipleDelete(Request $request)
    {

        $request->validate([
            'ids' => 'required|array',
        ], [
            'ids.required' => 'Please select the item(s) to delete.',
        ]);

        $galleries = Gallery::whereIn('id', $request->ids)->get();

        foreach ($galleries as $item) {
            if ($item->image_url && file_exists(public_path($item->image_url))) {
                unlink(public_path($item->image_url));
            }
        }
        Gallery::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery images deleted successfully.');
    }


    public function reorder(Request $request)
    {
        foreach ($request->order as $orderData) {
            Gallery::where('id', $orderData['id'])->update(['order' => $orderData['position']]);
        }
        return redirect()->route('admin.galleries.index')->with('success', 'Gallery order updated successfully!');
    }
}
