<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::latest()->get();
        return view('backend.blog.index',  compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::orderBy('name')->get();
        return view('backend.blog.create', compact('categories'));
    }

    
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|min:3|max:50',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = '';

        if ($request->file('image')) {

            $image = $request->file('image');

            $manager = new ImageManager(new Driver());

            $baseName = str_replace(' ', '-', $request->title);
            $ext = $image->getClientOriginalExtension();
            $newFileName = $baseName . '-' . now()->format('YmdHis') . '.' . $ext;

            // Read & resize image
            $img = $manager->read($image)->resize(746, 500);

            // Store resized image into storage/app/public/blog
            Storage::disk('public')->put(
                'blog/' . $newFileName,
                (string) $img->encode() // encode image content
            );

            // Save path in DB if needed
            $path = 'blog/' . $newFileName;
        }

        Blog::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'slug' => strtolower(str_replace(' ', '-', $request->title)),
            'image' => $path,
        ]);

        $notificaton = array(
            'message' => 'Post added successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.blog.index')->with($notificaton);
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
        $blog = Blog::find($id);
        $categories = BlogCategory::orderBy('name')->get();
        return view('backend.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|min:3|max:50',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Keep old image by default
        $path = $blog->image;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $manager = new ImageManager(new Driver());

            // Create filename
            $baseName = str_replace(' ', '-', $request->title);
            $ext = $image->getClientOriginalExtension();
            $newFileName = $baseName . '-' . now()->format('YmdHis') . '.' . $ext;

            // Resize image
            $img = $manager->read($image)->resize(746, 500);

            // Store image
            $path = 'blog/' . $newFileName;
            Storage::disk('public')->put($path, (string) $img->encode());

            // Delete old image
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
        }
        // Update record
        $blog->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'slug' => strtolower(str_replace(' ', '-', $request->title)),
            'image' => $path,
        ]);

        $notification = [
            'message' => 'Post updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.blog.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blgo = Blog::findOrFail($id);

        // Delete image if exists
        if ($blgo->image && Storage::disk('public')->exists($blgo->image)) {
            Storage::disk('public')->delete($blgo->image);
        }

        // Delete DB record
        $blgo->delete();

        $notification = [
            'message' => 'Post deleted successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.blog.index')->with($notification);
    }


    // Blog Category
    public function categoryIndex(){
        $categories = BlogCategory::latest()->get();
        return view('backend.blog.category.index',  compact('categories'));
    }

    public function categoryStore(Request $request){
        BlogCategory::insert([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',  $request->name)), 
        ]);

         $notificaton = array(
            'message' => 'Category added successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.blog.category.index')->with($notificaton);
    }

    public function categoryEdit($id){
        $categories = BlogCategory::find($id);

        return response()->json($categories);
    }

    public function categoryUpdate(Request $request){
        $id = $request->catid;
        BlogCategory::find($id)->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',  $request->name)), 
        ]);

         $notificaton = array(
            'message' => 'Category updated successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.blog.category.index')->with($notificaton);
    }

    public function categoryDestroy(string $id)
    {
        $category = BlogCategory::findOrFail($id);

        // Delete DB record
        $category->delete();

        $notification = [
            'message' => 'Category deleted successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.blog.category.index')->with($notification);
    }
}
