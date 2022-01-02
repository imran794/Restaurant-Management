<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function Show()
    {
        return view('backend.contact.index',[
            'contacts'     => Contact::latest('id')->get()
        ]);
    }

    public function ContactDestroy($id)
    {
        $contact =  Contact::find($id);
        $contact->delete();
         notify()->success('Contact Deleted', "Success");
        return redirect()->back();
    }

    public function ContactDetails($id)
    {
        $contact =  Contact::find($id);
        return view('backend.contact.details',compact('contact'));
    }
}
