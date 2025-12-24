<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Feature;
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
        return view('frontend.index', compact('testimonials','sliders', 'title', 'features'));
    }

    public function editTitle(Request $request, $id)
    {
        $title = Title::findOrFail($id);

        if ($request->has('features')) {
            $title->features = $request->features;
        }

        if ($request->has('testimonials')) {
            $title->testimonials = $request->testimonials;
        }
        
        if ($request->has('answers')) {
            $title->answers = $request->answers;
        }

        $title->save();

        return response()->json(['success' => true]);
    }
}
