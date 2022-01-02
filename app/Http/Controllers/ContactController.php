<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
     public function Store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'subject'   => 'required',
            'message'   => 'required',
        ]);


        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

         notify()->success('Your Message successfully Send', 'Success');
        return back();
    }
}
