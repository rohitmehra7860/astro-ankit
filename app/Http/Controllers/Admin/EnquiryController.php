<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::latest()->paginate(10);
        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function show($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        return view('admin.enquiries.show', compact('enquiry'));
    }


    public function delete($id)
    {
        Enquiry::find($id)->delete();
        return redirect()->route('admin.enquires.index')->with('success', 'Enquiry deleted successfully.');
    }

    public function multipleDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
        ], [
            'ids.required' => 'Please select the item(s) to delete.',
        ]);

        Enquiry::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.enquires.index')->with('success', 'Enquiries deleted successfully.');
    }
}
