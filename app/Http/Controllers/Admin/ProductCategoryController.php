<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Tarits\ImageUploadTrait;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $productCategories =  ProductCategory::with('parent')->get();
        return view('admin.productCategories.index', compact('productCategories'));
    }

    public function create()
    {
        $productCategories =  ProductCategory::get();
        return view('admin.productCategories.create', compact('productCategories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|max:255|unique:product_categories,slug|regex:/^[a-z0-9-]+$/',
            'parent_id' => 'nullable|integer|exists:product_categories,id',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
        ]);

        $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/productCategories');

        ProductCategory::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'image_url' => $imagePath,
            'content' => $request->content,
            'meta_tags' => $request->meta_tags,
        ]);

        return redirect()->route('admin.productCategories.index')->with('success', 'Category Created successfully!');
    }

    public function edit($slug)
    {
        $productCategory = ProductCategory::where('slug', $slug)->first();
        $productCategories =  ProductCategory::where('slug', '!=', $slug)->get();
        return view('admin.productCategories.edit', compact('productCategory', 'productCategories'));
    }

    public function update(Request $request, $slug)
    {
        $productCategory = ProductCategory::where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string|max:255|unique:product_categories,slug,' . $productCategory->id . '|regex:/^[a-z0-9-]+$/',
            'parent_id' => 'nullable|integer|exists:product_categories,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
        ]);

        if ($request->hasFile('image_url')) {
            if ($productCategory->image_url && file_exists(public_path($productCategory->image_url))) {
                unlink(public_path($productCategory->image_url));
            }

            $imagePath = $this->uploadImage($request->file('image_url'), 'uploads/productCategories');
            $productCategory->image_url = $imagePath;
        }

        $productCategory->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'parent_id' => $request->parent_id,
            'meta_tags' => $request->meta_tags,
        ]);

        return redirect()->route('admin.productCategories.edit', $productCategory->slug)->with('success', 'Category updated successfully!');
    }


    public function delete($slug)
    {
        $productCategory = ProductCategory::where('slug', $slug)->first();

        $sub_categories = ProductCategory::where('parent_id', $productCategory->id)->get();

        if ($sub_categories->count() > 0) {
            return redirect()->route('admin.productCategories.index')->with('error', 'You cannot delete a product category which has sub product categories!');
        }

        if ($productCategory->image_url && file_exists(public_path($productCategory->image_url))) {
            unlink(public_path($productCategory->image_url));
        }

        $productCategory->delete();
        return redirect()->route('admin.productCategories.index')->with('success', 'Category Deleted successfully!');
    }

    public function multipleDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
        ], [
            'ids.required' => 'Please select the item(s) to delete.',
        ]);


        $productCategories = ProductCategory::whereIn('id', $request->ids)
            ->orderByRaw('CASE WHEN parent_id IS NOT NULL THEN 0 ELSE 1 END')
            ->get();

        $notDeleted = [];

        foreach ($productCategories as $productCategory) {
            $sub_productCategory = ProductCategory::where('parent_id', $productCategory->id)->exists();

            if ($sub_productCategory) {
                $notDeleted[] = $productCategory->title;
                continue;
            }

            if ($productCategory->image_url && file_exists(public_path($productCategory->image_url))) {
                unlink(public_path($productCategory->image_url));
            }

            $productCategory->delete();
        }

        if (count($notDeleted) > 0) {
            $sub_productCategory_names = implode(', ', $notDeleted);
            return redirect()->route('admin.productCategories.index')
                ->with('error', 'Some Product categories could not be deleted because they have sub product categories: ' . $sub_productCategory_names);
        }

        return redirect()->route('admin.productCategories.index')
            ->with('success', 'Selected Product categories deleted successfully.');
    }



    public function reorder(Request $request)
    {
        foreach ($request->order as $orderData) {
            ProductCategory::where('id', $orderData['id'])->update(['order' => $orderData['position']]);
        }

        return redirect()->route('admin.product-categories.index')->with('success', 'Category order updated successfully!');
    }
}
