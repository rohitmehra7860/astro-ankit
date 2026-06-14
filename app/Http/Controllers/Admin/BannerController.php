<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Tarits\ImageUploadTrait;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $banners =  Banner::get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'title' => 'nullable|string',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
            'mobile_image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
            'content' => 'nullable',
            'link' => 'nullable|url'
        ]);

        $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/banners');

        $mobileImagePath = $request->hasFile('mobile_image_url')
            ? $this->uploadImage($request->file('mobile_image_url'), 'uploads/banners')
            : null;

        Banner::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $imagePath,
            'mobile_image_url' => $mobileImagePath,
            'link' => $request->link
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner Created successfully!');
    }

    public function edit($id)
    {
        $banner = Banner::where('id', $id)->first();
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::where('id', $id)->firstOrFail();

        $request->validate([
            'title' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
            'mobile_image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
            'content' => 'nullable',
            'link' => 'nullable|url'
        ]);

        if ($request->hasFile('image_url')) {
            if ($banner->image_url && file_exists(public_path($banner->image_url))) {

                unlink(public_path($banner->image_url));
            }
            $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/banners');
            $banner->image_url = $imagePath;
        }

        if ($request->hasFile('mobile_image_url')) {
            if ($banner->mobile_image_url && file_exists(public_path($banner->mobile_image_url))) {

                unlink(public_path($banner->mobile_image_url));
            }
            $mobileImagePath = $this->uploadImage($request->file('mobile_image_url'), 'uploads/banners');
            $banner->mobile_image_url = $mobileImagePath;
        }


        $banner->update([
            'title' => $request->title,
            'content' => $request->content,
            'link' => $request->link
        ]);

        return redirect()->route('admin.banners.edit', $banner->id)->with('success', 'Banner updated successfully!');
    }


    public function delete($id)
    {
        $banner = Banner::where('id', $id)->first();

        if ($banner->image_url && file_exists(public_path($banner->image_url))) {
            unlink(public_path($banner->image_url));
        }

        if ($banner->mobile_image_url && file_exists(public_path($banner->mobile_image_url))) {
            unlink(public_path($banner->mobile_image_url));
        }

        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner Deleted successfully!');
    }

    public function multipleDelete(Request $request)
    {

        $request->validate([
            'ids' => 'required|array',
        ], [
            'ids.required' => 'Please select the item(s) to delete.',
        ]);

        $banners = Banner::whereIn('id', $request->ids)->get();

        foreach ($banners as $item) {
            if ($item->image_url && file_exists(public_path($item->image_url))) {
                unlink(public_path($item->image_url));
            }

            if ($item->mobile_image_url && file_exists(public_path($item->mobile_image_url))) {
                unlink(public_path($item->mobile_image_url));
            }
        }
        Banner::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banners deleted successfully.');
    }


    public function reorder(Request $request)
    {
        foreach ($request->order as $orderData) {
            Banner::where('id', $orderData['id'])->update(['order' => $orderData['position']]);
        }
        return redirect()->route('admin.banners.index')->with('success', 'Banner order updated successfully!');
    }
}
