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
    // public function NavDesign(){
    //     return Inertia::render('navdesign');
    // }
    // public function GetRight(){
    //     return Inertia::render('getright');
    // }
    public function NewHome(){
        return Inertia::render('newhome');
    }
    public function About(){
        return inertia::render('about');
    }

    public function Privacy(){
        return inertia::render('support/privacy');
    }

    public function Drivers(){
        return inertia::render('occupations/drivers');
    }

    public function Faqs(){
        return Inertia::render('support/faqs');
    }

    public function Vendors(){
        return inertia::render('occupations/vendors');
    }

    public function Stores(){
        return Inertia::render('stores/home');
    }
    

    public function Contact(){
        return Inertia::render('support/contact');
    }

}
