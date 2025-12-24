<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::latest()->get();
        return view('backend.features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:50',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $ext = strtolower($image->getClientOriginalExtension());

            // Create filename
            $baseName = str_replace(' ', '-', $request->title);
            $newFileName = $baseName . '-' . now()->format('YmdHis') . '.' . $ext;

            // If SVG → store directly (NO Intervention)
            if ($ext === 'svg') {
                $path = $image->storeAs('features', $newFileName, 'public');
            }
            // Raster images → resize using Intervention
            else {
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image)->resize(60, 60);

                $path = 'features/' . $newFileName;
                Storage::disk('public')->put($path, (string) $img->encode());
            }
        }

        Feature::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
        ]);

        $notification = [
            'message' => 'Feature added successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.feature.index')->with($notification);
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
        $feature = Feature::find($id);
        return view('backend.features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feature = Feature::findOrFail($id);

        $request->validate([
            'title' => 'required|min:3|max:50',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        // Keep old image by default
        $path = $feature->image;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $ext = strtolower($image->getClientOriginalExtension());


            // Create filename
            $baseName = str_replace(' ', '-', $request->name);
            $newFileName = $baseName . '-' . now()->format('YmdHis') . '.' . $ext;

            // If SVG → store directly (NO Intervention)
            if ($ext === 'svg') {
                $path = $image->storeAs('features', $newFileName, 'public');
            }
            // Raster images → resize using Intervention
            else {
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image)->resize(60, 60);

                $path = 'features/' . $newFileName;
                Storage::disk('public')->put($path, (string) $img->encode());
            }
        }

        // Update record
        $feature->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
        ]);

        $notification = [
            'message' => 'Feature updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.feature.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature = Feature::findOrFail($id);

        // Delete image if exists
        if ($feature->image && Storage::disk('public')->exists($feature->image)) {
            Storage::disk('public')->delete($feature->image);
        }

        // Delete DB record
        $feature->delete();

        $notification = [
            'message' => 'Feature deleted successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.feature.index')->with($notification);
    }
}
