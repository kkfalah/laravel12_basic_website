<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\MidSectionOne;
use App\Models\MidSectionTwo;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\Title;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        $testimonials = Testimonial::latest()->get();
        $features = Feature::limit(6)->get();
        $sliders = Slider::find(1);
        $title = Title::find(1);
        $midSectionOne = MidSectionOne::find(1);
        $midSectionTwo = MidSectionTwo::find(1);
        return view('frontend.index', compact(
            'testimonials',
            'sliders', 
            'title', 
            'features',
            'midSectionOne',
            'midSectionTwo'
        ));
    }

    
}
