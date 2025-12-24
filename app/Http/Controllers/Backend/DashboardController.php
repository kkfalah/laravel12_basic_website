<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MidSectionOne;
use App\Models\MidSectionTwo;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class DashboardController extends Controller
{
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

    public function midSectionOneIndex(){
        $midSectionOne = MidSectionOne::find(1);
        return view('backend.sections.mid_section_one', compact('midSectionOne'));
    }

    public function midSectionOneEdit(){
        $midSectionOne = MidSectionOne::find(1);
        return view('backend.sections.mid_section_one_edit', compact('midSectionOne'));
    }

    public function midSectionOneUpdate(Request $request){

        $midSectionOne = MidSectionOne::findOrFail(1);

        // Keep old image by default
        $path = ($midSectionOne->image) ? $midSectionOne->image : '';

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $manager = new ImageManager(new Driver());

            // Create filename
            $baseName = str_replace(' ', '-', $request->title);
            $ext = $image->getClientOriginalExtension();
            $newFileName = $baseName . '-' . now()->format('YmdHis') . '.' . $ext;

            // Resize image
            $img = $manager->read($image)->resize(302, 618);

            // Store image
            $path = 'sections/' . $newFileName;
            Storage::disk('public')->put($path, (string) $img->encode());

            // Delete old image
            if ($midSectionOne->image && Storage::disk('public')->exists($midSectionOne->image)) {
                Storage::disk('public')->delete($midSectionOne->image);
            }
        }

        // Update record
        $midSectionOne->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
        ]);

        $notification = [
            'message' => 'Mid Section One updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.section.one.index')->with($notification);
    }

    public function midSectionTwoIndex(){
        $midSectionTwo = MidSectionTwo::find(1);
        return view('backend.sections.mid_section_two', compact('midSectionTwo'));
    }

    public function midSectionTwoEdit(){
        $midSectionTwo = MidSectionTwo::find(1);
        return view('backend.sections.mid_section_two_edit', compact('midSectionTwo'));
    }

    public function midSectionTwoUpdate(Request $request){
        
        $midSectionTwo = MidSectionTwo::findOrFail(1);

        // Keep old image by default
        $path = ($midSectionTwo->image) ? $midSectionTwo->image : '';

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $manager = new ImageManager(new Driver());

            // Create filename
            $baseName = str_replace(' ', '-', $request->title);
            $ext = $image->getClientOriginalExtension();
            $newFileName = $baseName . '-' . now()->format('YmdHis') . '.' . $ext;

            // Resize image
            $img = $manager->read($image)->resize(302, 618);

            // Store image
            $path = 'sections/' . $newFileName;
            Storage::disk('public')->put($path, (string) $img->encode());

            // Delete old image
            if ($midSectionTwo->image && Storage::disk('public')->exists($midSectionTwo->image)) {
                Storage::disk('public')->delete($midSectionTwo->image);
            }
        }

        // Update record
        $midSectionTwo->update([
            'title' => $request->title,
            'sub_title1' => $request->sub_title1,
            'sub_title2' => $request->sub_title2,
            'description' => $request->description,
            'sub_description1' => $request->sub_description1,
            'sub_description2' => $request->sub_description2,
            'image' => $path,
        ]);

        $notification = [
            'message' => 'Mid Section Two updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.section.two.index')->with($notification);
    }
}
