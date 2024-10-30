<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Process the form data, e.g., send an email or save to the database
        // Example: Sending an email
        Mail::raw($validated['message'], function ($message) use ($validated) {
            $message->to('admin@example.com')
                    ->subject('Contact Form Submission from ' . $validated['name'])
                    ->replyTo($validated['email']);
        });

        // Redirect back with a success message
        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}
