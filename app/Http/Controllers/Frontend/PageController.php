<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        $testimonials = Testimonial::latest()->get();
        return view('frontend.index', compact('testimonials'));
    }
}
