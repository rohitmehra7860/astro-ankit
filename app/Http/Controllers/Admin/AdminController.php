<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Service;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $enquiriesCount = Enquiry::count();
        $productsCount = Product::count();
        $servicesCount = Service::count();
        $blogsCount = Blog::count();
        return view('admin.index', compact('enquiriesCount', 'productsCount', 'servicesCount', 'blogsCount'));
    }
}
