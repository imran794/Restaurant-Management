<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\carbon;
use Storage;
use Image;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.item.index',[
            'items'   => Item::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.item.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

           $request->validate([
            'category_id'      => 'required',
            'name'             => 'required',
            'description'      => 'required',
            'price'            => 'required',
            'image'            => 'required|mimes:jpeg,jpg,bmp,png',
        ]);


            $image = $request->file('image');
            $slug  = Str::slug($request->name);
         
          if (isset($image))
        {
           //  make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           //    check item dir is exists
            if (!Storage::disk('public')->exists('item_image'))
            {
                Storage::disk('public')->makeDirectory('item_image');
            }
         //  resize image for item and upload
        
            Image::make($image)->resize(370, 300)->save(storage_path('app/public/item_image').'/'.$imagename);

          }else{
            $imagename = 'default.png';
          }

        Item::create([
            'category_id'      => $request->category_id,
            'name'             => $request->name,
            'description'      => $request->description,
            'price'            => $request->price,
            'image'            => $imagename,
            'created_at'       => carbon::now(),
        ]);

        notify()->success('Item Added', "Added");
        return redirect()->route('app.item.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('backend.item.create',compact('item','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {

           $request->validate([
            'category_id'      => 'required',
            'name'             => 'required',
            'description'      => 'required',
            'price'            => 'required',
            'image'            => 'image|mimes:jpeg,jpg,bmp,png',
        ]);


            $image = $request->file('image');
            $slug  = Str::slug($request->name);
         
          if (isset($image))
        {
           //  make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           //    check item dir is exists
            if (!Storage::disk('public')->exists('item_image'))
            {
                Storage::disk('public')->makeDirectory('item_image');
            }

              //  delete image

            if (Storage::disk('public')->exists('item_image/'.$item->image))
            {
                Storage::disk('public')->delete('item_image/'.$itme->image);
            }

         //  resize image for item and upload
        
            Image::make($image)->resize(370, 300)->save(storage_path('app/public/item_image').'/'.$imagename);

          }else{
            $imagename = 'default.png';
          }

        $item->update([
            'category_id'      => $request->category_id,
            'name'             => $request->name,
            'description'      => $request->description,
            'price'            => $request->price,
            'image'            => $imagename,
            'created_at'       => carbon::now(),
        ]);

        notify()->success('Item Added', "Added");
        return redirect()->route('app.item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if (Storage::disk('public')->exists('item_image/'.$item->image)) {
                Storage::disk('public')->delete('item_image/'.$item->image);
            }

        $item->delete();
        notify()->success('Item Deleted', "Success");
        return redirect()->back();
    }
}
