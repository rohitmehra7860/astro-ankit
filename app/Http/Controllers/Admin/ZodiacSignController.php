<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZodiacSign;
use App\Tarits\ImageUploadTrait;
use Illuminate\Http\Request;

class ZodiacSignController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $zodiacSigns = ZodiacSign::get();
        return view('admin.zodiac-signs.index', compact('zodiacSigns'));
    }

    public function create()
    {
        $zodiacSigns = ZodiacSign::get();
        return view('admin.zodiac-signs.create', compact('zodiacSigns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|max:255|unique:zodiac_signs,slug|regex:/^[a-z0-9-]+$/',
            'image_url' => 'required|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
        ]);

        $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/zodiac-signs');

        ZodiacSign::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'image_url' => $imagePath,
            'content' => $request->content,
            'date_range' => $request->date_range,
            'meta_tags' => $request->meta_tags,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        return redirect()->route('admin.zodiac-signs.index')
            ->with('success', 'Zodiac Sign Created successfully!');
    }

    public function edit($slug)
    {
        $zodiacSign = ZodiacSign::where('slug', $slug)->firstOrFail();
        return view('admin.zodiac-signs.edit', compact('zodiacSign'));
    }

    public function update(Request $request, $slug)
    {
        $zodiacSign = ZodiacSign::where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|max:255|unique:zodiac_signs,slug,' . $zodiacSign->id . '|regex:/^[a-z0-9-]+$/',
            'image_url' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
        ]);

        if ($request->hasFile('image_url')) {

            if ($zodiacSign->image_url && file_exists(public_path($zodiacSign->image_url))) {
                unlink(public_path($zodiacSign->image_url));
            }

            $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/zodiac-signs');
            $zodiacSign->image_url = $imagePath;
        }

        $zodiacSign->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'date_range' => $request->date_range,
            'meta_tags' => $request->meta_tags,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        return redirect()->route('admin.zodiac-signs.edit', $zodiacSign->slug)
            ->with('success', 'Zodiac Sign updated successfully!');
    }

    public function delete($slug)
    {
        $zodiacSign = ZodiacSign::where('slug', $slug)->firstOrFail();

        if ($zodiacSign->image_url && file_exists(public_path($zodiacSign->image_url))) {
            unlink(public_path($zodiacSign->image_url));
        }

        $zodiacSign->delete();

        return redirect()->route('admin.zodiac-signs.index')
            ->with('success', 'Zodiac Sign Deleted successfully!');
    }

    public function multipleDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
        ], [
            'ids.required' => 'Please select the item(s) to delete.',
        ]);

        $zodiacSigns = ZodiacSign::whereIn('id', $request->ids)->get();

        foreach ($zodiacSigns as $zodiacSign) {

            if ($zodiacSign->image_url && file_exists(public_path($zodiacSign->image_url))) {
                unlink(public_path($zodiacSign->image_url));
            }

            $zodiacSign->delete();
        }

        return redirect()->route('admin.zodiac-signs.index')
            ->with('success', 'Selected Zodiac Signs deleted successfully.');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $orderData) {
            ZodiacSign::where('id', $orderData['id'])
                ->update(['order' => $orderData['position']]);
        }

        return redirect()->route('admin.zodiac-signs.index')
            ->with('success', 'Zodiac Sign order updated successfully!');
    }
}
