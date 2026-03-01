<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.restaurant.home');
    }

    public function menu(): View
    {
        return view('pages.restaurant.menu');
    }

    public function about(): View
    {
        return view('pages.restaurant.about');
    }

    public function reservations(): View
    {
        return view('pages.restaurant.reservations');
    }

    public function gallery(): View
    {
        return view('pages.restaurant.gallery');
    }

    public function contact(): View
    {
        return view('pages.restaurant.contact');
    }
}
