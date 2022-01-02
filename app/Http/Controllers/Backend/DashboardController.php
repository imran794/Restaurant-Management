<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Role;
use App\Models\Page;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Item;
use App\Models\Slider;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        Gate::authorize('app.dashboard');
        $data['usercount'] = User::count();
        $data['rolecount'] = Role::count();
        $data['pagecount'] = Page::count();
        $data['menucount'] = Menu::count();
        $data['categorycount'] = Category::count();
        $data['itemcount'] = Item::count();
        $data['slidercount'] = Slider::count();
        $data['reservationcount'] = Reservation::count();
        $data['users'] = User::orderBy('created_at','desc')->take(10)->get();
        return view('backend.dashboard',$data);
    }
}


