<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Tarits\ImageUploadTrait;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $services =  Service::get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $services =  Service::get();
        return view('admin.services.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|max:255|unique:services,slug|regex:/^[a-z0-9-]+$/',
            'parent_id' => 'nullable|integer|exists:services,id',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
        ]);

        $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/services');

        Service::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'image_url' => $imagePath,
            'content' => $request->content,
            'meta_tags' => $request->meta_tags,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service Created successfully!');
    }

    public function edit($slug)
    {
        $service = Service::where('slug', $slug)->first();
        $services =  Service::where('slug', '!=', $slug)->get();
        return view('admin.services.edit', compact('service', 'services'));
    }

    public function update(Request $request, $slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|max:255|unique:services,slug,' . $service->id . '|regex:/^[a-z0-9-]+$/',
            'parent_id' => 'nullable|integer|exists:services,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
        ]);

        if ($request->hasFile('image_url')) {
            if ($service->image_url && file_exists(public_path($service->image_url))) {
                unlink(public_path($service->image_url));
            }

            $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/services');
            $service->image_url = $imagePath;
        }

        $service->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'parent_id' => $request->parent_id,
            'meta_tags' => $request->meta_tags,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        return redirect()->route('admin.services.edit', $service->slug)->with('success', 'Service updated successfully!');
    }


    public function delete($slug)
    {
        $service = Service::where('slug', $slug)->first();

        $sub_services = Service::where('parent_id', $service->id)->get();

        if ($sub_services->count() > 0) {
            return redirect()->route('admin.services.index')->with('error', 'You cannot delete a service which has sub services!');
        }

        if ($service->image_url && file_exists(public_path($service->image_url))) {
            unlink(public_path($service->image_url));
        }

        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service Deleted successfully!');
    }


    public function multipleDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
        ], [
            'ids.required' => 'Please select the item(s) to delete.',
        ]);

        $services = Service::whereIn('id', $request->ids)
            ->orderByRaw('CASE WHEN parent_id IS NOT NULL THEN 0 ELSE 1 END')
            ->get();

        $notDeleted = [];

        foreach ($services as $service) {
            $sub_services = Service::where('parent_id', $service->id)->exists();

            if ($sub_services) {
                $notDeleted[] = $service->title;
                continue;
            }

            if ($service->image_url && file_exists(public_path($service->image_url))) {
                unlink(public_path($service->image_url));
            }

            $service->delete();
        }

        if (count($notDeleted) > 0) {
            $serviceNames = implode(', ', $notDeleted);
            return redirect()->route('admin.services.index')
                ->with('error', 'Some services could not be deleted because they have sub-services: ' . $serviceNames);
        }

        return redirect()->route('admin.services.index')
            ->with('success', 'Selected services deleted successfully.');
    }


    public function reorder(Request $request)
    {
        foreach ($request->order as $orderData) {
            Service::where('id', $orderData['id'])->update(['order' => $orderData['position']]);
        }

        return redirect()->route('admin.services.index')->with('success', 'Service order updated successfully!');
    }
}
