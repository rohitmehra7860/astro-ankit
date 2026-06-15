<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Catalog;
use App\Models\Enquiry;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Product;
use App\Models\Service;
use App\Mail\EnquiryMail;
use App\Models\Banner;
use App\Models\ProductCategory;
use App\Models\SMTPSetting;
use App\Models\Testimonial;
use App\Models\ZodiacSign;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //home Page
    public function index()
    {
        $page = Page::where('identifier', 'home')->firstOrFail();
        $title = $page->title;
        $meta_tags = $page->meta_tags;
        $meta_title = $page->meta_title;
        $meta_description = $page->meta_description;
        $meta_keywords = $page->meta_keywords;
        $banners = Banner::get();
        $testimonials = Testimonial::get();
        $services = Service::take(3)->get();
        $blogs = Blog::take(3)->latest()->get();
        $zodiacSigns = ZodiacSign::get();
        return view('front.index', compact('page', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords', 'banners', 'testimonials', 'services', 'blogs', 'zodiacSigns'));
    }

    //about Page
    public function about()
    {
        $page = Page::where('identifier', 'about')->firstOrFail();
        $title = $page->title;
        $meta_tags = $page->meta_tags;
        $meta_title = $page->meta_title;
        $meta_description = $page->meta_description;
        $meta_keywords = $page->meta_keywords;
        $zodiacSigns = ZodiacSign::get();
        $testimonials = Testimonial::get();
        $blogs = Blog::get();
        $services = Service::take(3)->get();
        return view('front.about', compact('page', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords', 'zodiacSigns', 'testimonials', 'blogs', 'services'));
    }

    //contact Page
    public function contact()
    {
        $page = Page::where('identifier', 'contact')->firstOrFail();
        $title = $page->title;
        $meta_tags = $page->meta_tags;
        $meta_title = $page->meta_title;
        $meta_description = $page->meta_description;
        $meta_keywords = $page->meta_keywords;
        return view('front.contact', compact('page', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    //products Page
    public function products()
    {
        $page = Page::where('identifier', 'products')->firstOrFail();
        $title = $page->title;
        $meta_tags = $page->meta_tags;
        $meta_title = $page->meta_title;
        $meta_description = $page->meta_description;
        $meta_keywords = $page->meta_keywords;
        $products = Product::all();
        return view('front.products', compact('page', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords', 'products'));
    }

    //Product Category
    public function productCategory($slug)
    {
        $productCategory = ProductCategory::where('slug', $slug)->firstOrFail();
        $title = $productCategory->title;
        $meta_tags = $productCategory->meta_tags;
        $meta_title = $productCategory->meta_title;
        $meta_description = $productCategory->meta_description;
        $meta_keywords = $productCategory->meta_keywords;
        $products = $productCategory->products;
        return view('front.product-category', compact('productCategory', 'products', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    public function productCategories()
    {
        $page = Page::where('identifier', 'product-categories')->firstOrFail();
        $title = $page->title;
        $meta_tags = $page->meta_tags;
        $meta_title = $page->meta_title;
        $meta_description = $page->meta_description;
        $meta_keywords = $page->meta_keywords;
        $product_categories = ProductCategory::all();

        dd($product_categories);

        return view('front.products-categories', compact('page', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords', 'product_categories'));
    }


    //services Page
    public function services()
    {
        $page = Page::where('identifier', 'services')->firstOrFail();
        $title = $page->title;
        $meta_tags = $page->meta_tags;
        $meta_title = $page->meta_title;
        $meta_description = $page->meta_description;
        $meta_keywords = $page->meta_keywords;
        $services = Service::all();
        return view('front.services', compact('page', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords', 'services'));
    }

    //gallery Page
    public function gallery()
    {
        $page = Page::where('identifier', 'gallery')->firstOrFail();
        $title = $page->title;
        $meta_tags = $page->meta_tags;
        $meta_title = $page->meta_title;
        $meta_description = $page->meta_description;
        $meta_keywords = $page->meta_keywords;
        $gallery = Gallery::all();
        return view('front.gallery', compact('page', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords', 'gallery'));
    }

    //catalogs Page
    public function catalogs()
    {
        $page = Page::where('identifier', 'catalogs')->firstOrFail();
        $title = $page->title;
        $meta_tags = $page->meta_tags;
        $meta_title = $page->meta_title;
        $meta_description = $page->meta_description;
        $meta_keywords = $page->meta_keywords;
        $catalogs = Catalog::all();
        return view('front.catalogs', compact('page', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords', 'catalogs'));
    }

    //blogs Page
    public function blogs()
    {
        $page = Page::where('identifier', 'blogs')->firstOrFail();
        $title = $page->title;
        $meta_tags = $page->meta_tags;
        $meta_title = $page->meta_title;
        $meta_description = $page->meta_description;
        $meta_keywords = $page->meta_keywords;
        $blogs = Blog::all();
        return view('front.blogs', compact('page', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords', 'blogs'));
    }

    //single Product Page
    public function singleProduct($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $title = $product->title;
        $meta_tags = $product->meta_tags;
        $meta_title = $product->meta_title;
        $meta_description = $product->meta_description;
        $meta_keywords = $product->meta_keywords;
        return view('front.singel-product', compact('product', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    //single Service Page
    public function singleService($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $title = $service->title;
        $meta_tags = $service->meta_tags;
        $meta_title = $service->meta_title;
        $meta_description = $service->meta_description;
        $meta_keywords = $service->meta_keywords;
        $zodiacSigns = ZodiacSign::get();
        $testimonials = Testimonial::get();
        $blogs = Blog::take(6)->get();
        return view('front.single-service', compact('service', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords', 'zodiacSigns', 'testimonials', 'blogs'));
    }


    public function singleZodiacSign($slug)
    {
        $zodiacSign = ZodiacSign::where('slug', $slug)->firstOrFail();
        $title = $zodiacSign->title;
        $meta_tags = $zodiacSign->meta_tags;
        $meta_title = $zodiacSign->meta_title;
        $meta_description = $zodiacSign->meta_description;
        $meta_keywords = $zodiacSign->meta_keywords;
        $zodiacSigns = ZodiacSign::get();
        $testimonials = Testimonial::get();
        $blogs = Blog::get();
        return view('front.single-zodiac-sign', compact('zodiacSign', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords', 'zodiacSigns', 'testimonials', 'blogs'));
    }

    //single blog Page
    public function singleBlog($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $title = $blog->title;
        $meta_tags = $blog->meta_tags;
        $meta_title = $blog->meta_title;
        $meta_description = $blog->meta_description;
        $meta_keywords = $blog->meta_keywords;
        $zodiacSigns = ZodiacSign::get();
        $testimonials = Testimonial::get();
        $blogs = Blog::get();
        return view('front.single-blog', compact('blog', 'title', 'meta_tags', 'meta_title', 'meta_description', 'meta_keywords', 'zodiacSigns', 'testimonials', 'blogs'));
    }

    //enquiry Submit
    public function enquiry(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => [
                'required',
            ],
            'message' => 'required',
        ]);


        // Normalize phone
        // $phone = preg_replace('/[^0-9]/', '', $validated['phone']);
        // if (strlen($phone) === 11 && substr($phone, 0, 1) === '0') {
        //     $phone = substr($phone, 1);
        // }
        // if (strlen($phone) === 12 && substr($phone, 0, 2) === '91') {
        //     $phone = substr($phone, 2);
        // }
        // $validated['phone'] = $phone;

        // Store to DB
        $enquiry = Enquiry::create($validated);
        $smtp_settings = SMTPSetting::firstOrFail();

        $emails = array_map('trim', explode(',', $smtp_settings->mail_to));

        Mail::to($emails)->send(new EnquiryMail($enquiry));

        return back()->with('success', 'Thank you for your enquiry!');
    }
}
