<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Tarits\ImageUploadTrait;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $testimonials =  Testimonial::get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
            'content' => 'required'
        ]);

        $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/testimonials');

        Testimonial::create([
            'name' => $request->name,
            'content' => $request->content,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Created successfully!');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::where('id', $id)->first();
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::where('id', $id)->firstOrFail();

        $request->validate([
            'name' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
            'content' => 'required'
        ]);

        if ($request->hasFile('image_url')) {
            if ($testimonial->image_url && file_exists(public_path($testimonial->image_url))) {

                unlink(public_path($testimonial->image_url));
            }
            $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/testimonials');
            $testimonial->image_url = $imagePath;
        }

        $testimonial->update([
            'name' => $request->name,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.testimonials.edit', $testimonial->id)->with('success', 'Testimonial updated successfully!');
    }


    public function delete($id)
    {
        $testimonial = Testimonial::where('id', $id)->first();

        if ($testimonial->image_url && file_exists(public_path($testimonial->image_url))) {
            unlink(public_path($testimonial->image_url));
        }

        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial Deleted successfully!');
    }

    public function multipleDelete(Request $request)
    {

        $request->validate([
            'ids' => 'required|array',
        ], [
            'ids.required' => 'Please select the item(s) to delete.',
        ]);

        $Testimonials = Testimonial::whereIn('id', $request->ids)->get();

        foreach ($Testimonials as $item) {
            if ($item->image_url && file_exists(public_path($item->image_url))) {
                unlink(public_path($item->image_url));
            }
        }
        Testimonial::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonials deleted successfully.');
    }


    public function reorder(Request $request)
    {
        foreach ($request->order as $orderData) {
            Testimonial::where('id', $orderData['id'])->update(['order' => $orderData['position']]);
        }
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial order updated successfully!');
    }
}
