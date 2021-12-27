<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuItem;
use Carbon\Carbon;

class MenuBuliderController extends Controller
{
    public function index($id)
    {
        Gate::authorize('app.menus.index');
        $menu = Menu::findOrFail($id);
       return view('backend.menu.builder',compact('menu'));
    }


   public function Order(Request $request, $id)
    {
        Gate::authorize('app.menus.index');
        $menuitemorder = json_decode($request->get('order'));
        $this->orderMenu($menuitemorder, null);
        
    }

    private function orderMenu($menuitems, $parentid)
    {
        foreach ($menuitems as $index => $item) {
            $menuItem = MenuItem::findOrFail($item->id);
            $menuItem->update([
                'order'       => $index + 1,
                'parent_id'   => $parentid
            ]);

            if (isset($item->children)) {
               $this->orderMenu($item->children, $menuItem->id);
            }
        }
    }



    public function ItemCreate($id)
    {
           Gate::authorize('app.menus.create');
           $menu = Menu::findOrFail($id);
           return view('backend.menu.item.create',compact('menu'));

    }

    public function ItemStore(Request $request, $id)
    {
        $request->validate([
            'type'            => 'required',
            'divider_title'   => 'nullable|string',
            'title'           => 'nullable|string',
            'url'             => 'nullable|string',
            'target'          => 'nullable|string',
            'icon_class'      => 'nullable|string',
        ]);

         $menu = Menu::findOrFail($id);

         MenuItem::create([
               'menu_id'          => $menu->id,
               'type'             => $request->type,
               'divider_title'    => $request->divider_title,
               'title'            => $request->title,
               'url'              => $request->url,
               'target'           => $request->target,
               'icon_class'       => $request->icon_class,
                'created_at'       => Carbon::now(),
         ]);

         notify()->success('MenuItem created','Success');
         return redirect()->route('app.menus.bulider',$menu->id);
    }


     public function ItemEdit($id, $itemId)
    {
           Gate::authorize('app.menus.edit');
           $menu = Menu::findOrFail($id);
           $menuitem = MenuItem::where('menu_id',$menu->id)->findOrFail($itemId);
           return view('backend.menu.item.create',compact('menu','menuitem'));

    }

    public function ItemUpdate(Request $request, $id, $itemId)
    {
        Gate::authorize('app.menus.edit');
        $request->validate([
            'type'            => 'required',
            'divider_title'   => 'nullable|string',
            'title'           => 'nullable|string',
            'url'             => 'nullable|string',
            'target'          => 'nullable|string',
            'icon_class'      => 'nullable|string',
        ]);

         $menu = Menu::findOrFail($id);
          $menuitem = MenuItem::where('menu_id',$menu->id)
          ->findOrFail($itemId)
          ->update([
               'type'             => $request->type,
               'divider_title'    => $request->divider_title,
               'title'            => $request->title,
               'url'              => $request->url,
               'target'           => $request->target,
               'icon_class'       => $request->icon_class,
                'created_at'       => Carbon::now(),
         ]);

         notify()->success('MenuItem Update','Success');
         return redirect()->route('app.menus.bulider',$menu->id);
    }

    public function ItemDelete($id, $itemId)
    {
        Gate::authorize('app.menus.delete');
        Menu::findOrFail($id)
        ->MenuItems()
        ->findOrFail($itemId)
        ->delete();
         notify()->success('MenuItem Deleted','Success');
         return redirect()->back();
    }
}
