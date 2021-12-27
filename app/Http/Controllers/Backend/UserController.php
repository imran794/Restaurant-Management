<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\carbon;
use Storage;
use Image;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.user.index');
        $users = User::all();
        return view('backend.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         Gate::authorize('app.user.create');
         $roles = Role::all();
         return view('backend.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


         Gate::authorize('app.user.create');

        // $request->validate([
        //      'name'     => 'required|string|max:255',
        //     'role_id'  => 'required',
        //     'email'    => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|confirmed|string|min:8',
        //     'avatar'   => 'required|image',
        // ]);

            $avatar = $request->file('avatar');
            $slug  =  $slug = Str::lower($request->name);
         
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
         //  resize image for category and upload
        
            Image::make($avatar)->resize(350, 350)->save(storage_path('app/public/avatar').'/'.$imagename);

        }

        User::create([
            'name'        => $request->name,
            'role_id'     => $request->role,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'avatar'      => $imagename,
            'status'      => $request->filled('status'),
            'created_at'  => carbon::now(),
        ]);

        notify()->success('User Added', "Added");
        return redirect()->route('app.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
          Gate::authorize('app.user.index');
         return view('backend.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
          Gate::authorize('app.user.edit');
         $roles = Role::all();
         return view('backend.user.create',compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //  $request->validate([
        //      'name'     => 'required|string|max:255',
        //     'role_id'  => 'required',
        //     'email'    => 'required|string|email|max:255|unique:users,email' .$user->id,
        //     'password' => 'required|confirmed|string|min:8',
        //     'avatar'   => 'required|image',
        // ]);

            $avatar = $request->file('avatar');
            $slug  =  $slug = Str::lower($request->name);
         
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

        }

        $user->update([
            'name'        => $request->name,
            'role_id'     => $request->role,
            'email'       => $request->email,
            'password'    => isset($request->password) ? Hash::make($request->password) : $user->password,
            'avatar'      => $imagename,
            'status'      => $request->filled('status'),
            'update_at'   => carbon::now(),
        ]);

        notify()->success('User Updated', "Success");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Gate::authorize('app.user.delete');
        if (Storage::disk('public')->exists('avatar/'.$user->avatar)) {
                Storage::disk('public')->delete('avatar/'.$user->avatar);
            }
            
        $user->delete();
        notify()->success('User Deleted', "Success");
        return redirect()->back();
    }
}
