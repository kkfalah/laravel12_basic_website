<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cta;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\MidSectionOne;
use App\Models\MidSectionTwo;
use App\Models\MidSectionVideo;
use App\Models\MidSectionVideoBottom;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\Title;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {

        $testimonials = Testimonial::latest()->get();
        $features = Feature::limit(6)->get();
        $sliders = Slider::find(1);
        $title = Title::find(1);
        $midSectionOne = MidSectionOne::find(1);
        $midSectionTwo = MidSectionTwo::find(1);
        $midSectionVideo = MidSectionVideo::find(1);
        $midSectionVideoBottom = MidSectionVideoBottom::latest()->get();
        $faq = Faq::limit(6)->get();
        $cta = Cta::find(1);
        return view('frontend.index', compact(
            'testimonials',
            'sliders',
            'title',
            'features',
            'midSectionOne',
            'midSectionTwo',
            'midSectionVideo',
            'midSectionVideoBottom',
            'faq',
            'cta',
        ));
    }


    public function team()
    {
        $team = Team::orderBy('name', 'ASC')->paginate(12);
        $cta = Cta::find(1);
        return view('frontend.team', compact(
            'cta',
            'team',
        ));
    }

    public function about()
    {
        $team = Team::orderBy('name', 'ASC')->paginate(12);
        $title = Title::find(1);
        $faq = Faq::limit(6)->get();
        $cta = Cta::find(1);
        return view('frontend.about', compact(
            'cta',
            'team',
            'title',
            'faq',
        ));
    }
}
