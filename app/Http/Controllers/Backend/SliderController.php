<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\carbon;
use Storage;
use Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         Gate::authorize('app.slider.index');
        $Sliders = Slider::latest('id')->get();
        return view('backend.slider.index',compact('Sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         Gate::authorize('app.slider.create');
         return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


         Gate::authorize('app.slider.create');

        $request->validate([
            'title'      => 'required',
            'sub_title'  => 'required',
            'image'      => 'required|image',
        ]);

            $image = $request->file('image');
            $slug  = Str::lower($request->title);
         
          if (isset($image))
        {
           //  make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           //    check slider dir is exists
            if (!Storage::disk('public')->exists('slider'))
            {
                Storage::disk('public')->makeDirectory('slider');
            }
         //  resize image for slider and upload
        
            Image::make($image)->resize(1800, 991)->save(storage_path('app/public/slider').'/'.$imagename);

        }


        Slider::create([
            'title'      => $request->title,
            'sub_title'  => $request->sub_title,
            'image'      => $imagename,
            'created_at'  => carbon::now(),
        ]);

        notify()->success('Slider Added', "Added");
        return redirect()->route('app.sliders.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
         Gate::authorize('app.slider.edit');
        return view('backend.slider.create',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {


         Gate::authorize('app.slider.create');

        $request->validate([
            'title'      => 'required',
            'sub_title'  => 'required',
            'image'      => 'image',
        ]);

            $image = $request->file('image');
            $slug  = Str::lower($request->title);
         
          if (isset($image))
        {
           //  make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           //    check slider dir is exists
            if (!Storage::disk('public')->exists('slider'))
            {
                Storage::disk('public')->makeDirectory('slider');
            }

            if (Storage::disk('public')->exists('slider/'.$slider->image)) {
                Storage::disk('public')->delete('slider/'.$slider->image);
            }

         //  resize image for slider and upload
        
            Image::make($image)->resize(1800, 991)->save(storage_path('app/public/slider').'/'.$imagename);

        }
        else{
             $imagename = $slider->image;
        }


        $slider->update([
            'title'      => $request->title,
            'sub_title'  => $request->sub_title,
            'image'      => $imagename,
            'created_at'  => carbon::now(),
        ]);

        notify()->success('Slider Updated', "Success");
        return redirect()->route('app.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        Gate::authorize('app.slider.delete');
        if (Storage::disk('public')->exists('slider/'.$slider->image)) {
                Storage::disk('public')->delete('slider/'.$slider->image);
            }
            
        $slider->delete();
        notify()->success('Slider Deleted', "Success");
        return redirect()->back();
    }
}
