<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\carbon;
use Storage;
use Image;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.pages.index');
        $pages = Page::latest('id')->get();
        return view('backend.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.pages.create');
        return view('backend.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.pages.create');

        $request->validate([
            'title'   => 'required|string|unique:pages',
            'body'    => 'required|string',
            'image'   => 'nullable|image',
        ]);

           $image = $request->file('image');
           $slug  = Str::slug($request->title);

          if (isset($image))
        {
           //  make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           //    check category dir is exists
            if (!Storage::disk('public')->exists('page'))
            {
                Storage::disk('public')->makeDirectory('page');
            }

         //  resize image for page and upload
        
            Image::make($image)->resize(600,450)->save(storage_path('app/public/page').'/'.$imagename);

        }


        $page = Page::insert([
            'image'               => $imagename,
            'title'               => $request->title,
            'slug'                => Str::slug($request->title),
            'excerpt'             => $request->excerpt,
            'body'                => $request->body,
            'meta_description'    => $request->meta_description,
            'meta_keywords'       => $request->meta_keywords,
            'status'              => $request->filled('status'),
            'created_at'          => Carbon::now()
        ]);

        notify()->success('Page Created', "Success");
        return redirect()->route('app.pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        Gate::authorize('app.pages.create');
        return view('backend.page.show',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        Gate::authorize('app.menus.edit');
        return view('backend.page.create',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {

         Gate::authorize('app.pages.edit');

        $request->validate([
            'title'   => 'required|string',
            'body'    => 'required|string',
            'image'   => 'nullable|image',
        ]);


            $image = $request->file('image');
            $slug  =  $slug = Str::lower($request->name);
         
          if (isset($image))
        {
           //  make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           //    check category dir is exists
            if (!Storage::disk('public')->exists('page'))
            {
                Storage::disk('public')->makeDirectory('page');
            }

              if (Storage::disk('public')->exists('page/'.$page->image)) {
                Storage::disk('public')->delete('page/'.$page->image);
            }
         //  resize image for category and upload
        
            Image::make($image)->resize(600, 450)->save(storage_path('app/public/page').'/'.$imagename);

        }else{
             $imagename = $page->image;
        }


        $page->update([
            'image'               => $imagename,
            'title'               => $request->title,
            'excerpt'             => $request->excerpt,
            'body'                => $request->body,
            'meta_description'    => $request->meta_description,
            'meta_keywords'       => $request->meta_keywords,
            'status'              => $request->filled('status'),
            'update_at'           => carbon::now(),
        ]);

        notify()->success('User Updated', "Success");
       return redirect()->route('app.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        Gate::authorize('app.menus.delete');
        if (Storage::disk('public')->exists('page/'.$page->avatar)) {
                Storage::disk('public')->delete('page/'.$page->avatar);
            }
            
        $page->delete();
        notify()->success('Page Deleted', "Success");
        return redirect()->back();
    
    }
}
