<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('backend.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $path = '';

        if ($request->file('image')) {

            $image = $request->file('image');

            $manager = new ImageManager(new Driver());

            $baseName = str_replace(' ', '-', $request->name);
            $ext = $image->getClientOriginalExtension();
            $newFileName = $baseName . '-' . now()->format('YmdHis') . '.' . $ext;

            // Read & resize image
            $img = $manager->read($image)->resize(306, 618);

            // Store resized image into storage/app/public/sliders
            Storage::disk('public')->put(
                'sliders/' . $newFileName,
                (string) $img->encode() // encode image content
            );

            // Save path in DB if needed
            $path = 'sliders/' . $newFileName;
        }

        Slider::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'image' => $path,

        ]);

        $notificaton = array(
            'message' => 'Slider added successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.slider.index')->with($notificaton);
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::find($id);
        return view('backend.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::findOrFail($id);

        // Keep old image by default
        $path = $slider->image;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $manager = new ImageManager(new Driver());

            // Create filename
            $baseName = str_replace(' ', '-', $request->name);
            $ext = $image->getClientOriginalExtension();
            $newFileName = $baseName . '-' . now()->format('YmdHis') . '.' . $ext;

            // Resize image
            $img = $manager->read($image)->resize(306, 618);

            // Store image
            $path = 'sliders/' . $newFileName;
            Storage::disk('public')->put($path, (string) $img->encode());

            // Delete old image
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
        }

        // Update record
        $slider->update([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'image' => $path,
        ]);

        $notification = [
            'message' => 'Slider updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.slider.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);

        // Delete image if exists
        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        // Delete DB record
        $slider->delete();

        $notification = [
            'message' => 'Slider deleted successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.slider.index')->with($notification);
    }

    public function editSlider(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        if ($request->has('title')) {
            $slider->title = $request->title;
        }

        if ($request->has('description')) {
            $slider->description = $request->description;
        }

        $slider->save();

        return response()->json(['success' => true]);
    }
}
