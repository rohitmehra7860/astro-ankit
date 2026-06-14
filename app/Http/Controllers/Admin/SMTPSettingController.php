<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SMTPSetting;
use Illuminate\Http\Request;

class SMTPSettingController extends Controller
{
    public function edit()
    {
        $smtp = SMTPSetting::first(); // Get the first (and only) SMTP record
        return view('admin.smtp.edit', compact('smtp'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'mailer' => 'required',
            'host' => 'required',
            'port' => 'required|numeric',
            'username' => 'required',
            'password' => 'required',
            'encryption' => 'nullable|in:ssl,tls',
            'from_address' => 'required|email',
            'from_name' => 'required',
            'mail_to' => 'required'
        ]);

        $smtp = SMTPSetting::first();

        if (!$smtp) {
            // Create record if it doesn't exist
            $smtp = new SMTPSetting();
        }

        $smtp->fill($request->all())->save();

        return redirect()->back()->with('success', 'SMTP settings updated successfully!');
    }

    public function delete()
    {
        $smtp = SMTPSetting::first();
        if ($smtp) {
            $smtp->delete();
        }
        return redirect()->back()->with('success', 'SMTP settings reset successfully!');
    }
}
