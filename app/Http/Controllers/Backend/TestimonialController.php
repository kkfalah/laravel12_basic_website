<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('backend.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'position' => 'required|min:2|max:50',
            'rating' => 'integer|min:1|max:5',
        ]);

        $path = '';

        if ($request->file('image')) {

            $image = $request->file('image');

            $manager = new ImageManager(new Driver());

            $baseName = str_replace(' ', '-', $request->name);
            $ext = $image->getClientOriginalExtension();
            $newFileName = $baseName . '-' . now()->format('YmdHis') . '.' . $ext;

            // Read & resize image
            $img = $manager->read($image)->resize(60, 60);

            // Store resized image into storage/app/public/testimonials
            Storage::disk('public')->put(
                'testimonials/' . $newFileName,
                (string) $img->encode() // encode image content
            );

            // Save path in DB if needed
            $path = 'testimonials/' . $newFileName;
        }

        Testimonial::create([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $path,
            'rating' => $request->rating,

        ]);

        $notificaton = array(
            'message' => 'Testimonial added successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.testimonial.index')->with($notificaton);
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
        $testimonial = Testimonial::find($id);
        return view('backend.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'name' => 'required|min:3|max:50',
            'position' => 'required|min:2|max:50',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Keep old image by default
        $path = $testimonial->image;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $manager = new ImageManager(new Driver());

            // Create filename
            $baseName = str_replace(' ', '-', $request->name);
            $ext = $image->getClientOriginalExtension();
            $newFileName = $baseName . '-' . now()->format('YmdHis') . '.' . $ext;

            // Resize image
            $img = $manager->read($image)->resize(60, 60);

            // Store image
            $path = 'testimonials/' . $newFileName;
            Storage::disk('public')->put($path, (string) $img->encode());

            // Delete old image
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }
        }

        // Update record
        $testimonial->update([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $path,
            'rating' => $request->rating,
        ]);

        $notification = [
            'message' => 'Testimonial updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.testimonial.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Delete image if exists
        if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
            Storage::disk('public')->delete($testimonial->image);
        }

        // Delete DB record
        $testimonial->delete();

        $notification = [
            'message' => 'Testimonial deleted successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.testimonial.index')->with($notification);
    }
}
