<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $team = Team::latest()->get();
        return view('backend.team.index', compact('team'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'position' => 'required|min:2|max:50',
        ]);

        $path = '';

        if ($request->file('image')) {

            $image = $request->file('image');

            $manager = new ImageManager(new Driver());

            $baseName = str_replace(' ', '-', $request->name);
            $ext = $image->getClientOriginalExtension();
            $newFileName = $baseName . '-' . now()->format('YmdHis') . '.' . $ext;

            // Read & resize image
            $img = $manager->read($image)->resize(306, 400);

            // Store resized image into storage/app/public/team
            Storage::disk('public')->put(
                'team/' . $newFileName,
                (string) $img->encode() // encode image content
            );

            // Save path in DB if needed
            $path = 'team/' . $newFileName;
        }

        Team::create([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $path,
        ]);

        $notificaton = array(
            'message' => 'Team added successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.team.index')->with($notificaton);
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
        $team = Team::find($id);
        return view('backend.team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $team = Team::findOrFail($id);

        $request->validate([
            'name' => 'required|min:3|max:50',
            'position' => 'required|min:2|max:50',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Keep old image by default
        $path = $team->image;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $manager = new ImageManager(new Driver());

            // Create filename
            $baseName = str_replace(' ', '-', $request->name);
            $ext = $image->getClientOriginalExtension();
            $newFileName = $baseName . '-' . now()->format('YmdHis') . '.' . $ext;

            // Resize image
            $img = $manager->read($image)->resize(306, 400);

            // Store image
            $path = 'team/' . $newFileName;
            Storage::disk('public')->put($path, (string) $img->encode());

            // Delete old image
            if ($team->image && Storage::disk('public')->exists($team->image)) {
                Storage::disk('public')->delete($team->image);
            }
        }

        // Update record
        $team->update([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $path,
        ]);

        $notification = [
            'message' => 'Team updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.team.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);

        // Delete image if exists
        if ($team->image && Storage::disk('public')->exists($team->image)) {
            Storage::disk('public')->delete($team->image);
        }

        // Delete DB record
        $team->delete();

        $notification = [
            'message' => 'Team deleted successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.team.index')->with($notification);
    }
}
