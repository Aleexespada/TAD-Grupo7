<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InfoController extends Controller
{
    public function aboutUs()
    {
        return view('info.about-us');
    }

    public function cookies()
    {
        return view('info.cookies');
    }

    public function shipping()
    {
        return view('info.shipping');
    }

    public function contactUs()
    {
        return view('info.contact-us');
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $info = new ContactInfo;
        $info->name = $validated['name'];
        $info->email = $validated['email'];
        $info->subject = $validated['subject'];
        $info->message = $validated['message'];

        // Mail::to()
        Mail::send('emails.contact', ['contactInfo' => $info], function ($message) use ($info) {
            $message->to('info@mrpenguin.com', 'Mr Penguin')->subject($info->subject);
            $message->from($info->email, $info->name);
        });

        return back()->with('message', 'Email enviado con éxito');
    }
}
