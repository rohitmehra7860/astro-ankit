<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Tarits\ImageUploadTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $blogs =  Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|max:255|unique:blogs,slug|regex:/^[a-z0-9-]+$/',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
        ]);

        $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/blogs');

        Blog::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'image_url' => $imagePath,
            'meta_tags' => $request->meta_tags,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog Created successfully!');
    }

    public function edit($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id . '|regex:/^[a-z0-9-]+$/',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
        ]);

        if ($request->hasFile('image_url')) {
            if ($blog->image_url && file_exists(public_path($blog->image_url))) {

                unlink(public_path($blog->image_url));
            }
            $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/blogs');
            $blog->image_url = $imagePath;
        }

        $blog->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'meta_tags' => $request->meta_tags,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        return redirect()->route('admin.blogs.edit', $blog->slug)->with('success', 'blog updated successfully!');
    }


    public function delete($slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        if ($blog->image_url && file_exists(public_path($blog->image_url))) {
            unlink(public_path($blog->image_url));
        }

        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'blog Deleted successfully!');
    }

    public function multipleDelete(Request $request)
    {

        $request->validate([
            'ids' => 'required|array',
        ], [
            'ids.required' => 'Please select the item(s) to delete.',
        ]);

        $blogs = Blog::whereIn('id', $request->ids)->get();

        foreach ($blogs as $item) {
            if ($item->image_url && file_exists(public_path($item->image_url))) {
                unlink(public_path($item->image_url));
            }
        }
        Blog::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blogs deleted successfully.');
    }
}
