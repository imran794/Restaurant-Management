<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.role.index');
        $roles = Role::all();
        return view('backend.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           Gate::authorize('app.role.create');
           return view('backend.role.create',[
            'modules' => Module::all()
           ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Gate::authorize('app.role.create');
        $request->validate([
            'name'         => 'required|unique:roles',
            'permission'   => 'required|array',
            'permission.*'   => 'integer'
        ]);

        Role::create([
            'name'      => $request->name,
            'slug'      => Str::slug($request->name)
        ])->permissions()->sync($request->input('permission'),[]);
        notify()->success('Role Added', "Added");
        return redirect()->route('app.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
         Gate::authorize('app.role.edit');
          $modules = Module::all();
         return view('backend.role.create',compact('modules','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        Gate::authorize('app.role.edit');
        $role->update([
            'name'       => $request->name,
            'slug'      => Str::slug($request->name)
        ]);

        $role->permissions()->sync($request->input('permission'));
        notify()->success('Role Updated', "Updated");
        return redirect()->route('app.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
         Gate::authorize('app.roles.delete');
        if ($role->daletable) {
            $role->delete();
            notify()->success('Role Deleted', "Success");
        }else{
             notify()->error('You Cannot Delete System Role.', "Error");
        }

        return back();

       
    }
}
