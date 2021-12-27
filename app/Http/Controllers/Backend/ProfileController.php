<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\carbon;
use Storage;
use Image;
use Hash;

class ProfileController extends Controller
{
    public function Index()
    {
        return view('backend.profile.index');
    }

    public function ProfileUpdate(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'avatar'   => 'image',
        ]);

           $avatar = $request->file('avatar');
           $slug  = Str::lower($request->name);
            $user = User::findOrFail(Auth::id());
         
          if (isset($avatar))
        {
           //  make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$avatar->getClientOriginalExtension();
           //    check category dir is exists
            if (!Storage::disk('public')->exists('avatar'))
            {
                Storage::disk('public')->makeDirectory('avatar');
            }

              if (Storage::disk('public')->exists('avatar/'.$user->avatar)) {
                Storage::disk('public')->delete('avatar/'.$user->avatar);
            }
         //  resize image for category and upload
        
            Image::make($avatar)->resize(350, 350)->save(storage_path('app/public/avatar').'/'.$imagename);

        }else{
             $imagename = $user->avatar;
        }

    

        $user->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'avatar'      => $imagename,
            'update_at'   => carbon::now(),
        ]);

        notify()->success('User Updated', "Success");
        return redirect()->back();
    }

    public function Password()
    {
        return view('backend.profile.password');
    }

    public function PasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password'  => 'required',
            'password'  => 'required|confirmed'
        ]);


        $hashedpassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashedpassword)) {
            if (!Hash::check($request->password, $hashedpassword)) {
                
              $user =   User::find(Auth::id());
              $user->password = Hash::make($request->password);
              $user->save();
               notify()->success('Password Successfully Changed :)','Success');
               Auth::logout();
               return redirect()->back();

            }
            else{
                notify()->success('New Password Cannot the same as old Password','Error');
                return redirect()->back();

            }
        }
        else{
             notify()->success('Current Password Not Match','Error');
             return redirect()->back();
        }
    }
}
