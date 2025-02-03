<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class GeneralView extends Controller
{
    //
    public function HomeIndex(){
        return inertia::render('home');
    }
    public function About(){
        return inertia::render('about');
    }

    public function Privacy(){
        return inertia::render('privacy');
    }

    public function Drivers(){
        return inertia::render('drivers/overview');
    }

    public function Vendors(){
        return inertia::render('vendors/overview');
    }

    public function Stores(){
        return Inertia::render('stores/home');
    }
    

    public function Contact(){
        return Inertia::render('contact');
    }

}
