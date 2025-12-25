<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faq = Faq::latest()->get();
        return view('backend.faq.index', compact('faq'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|min:3',
            'answer' => 'required',
        ]);
        

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        $notificaton = array(
            'message' => 'Faq added successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.faq.index')->with($notificaton);
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
        $faq = Faq::find($id);
        return view('backend.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $faq = Faq::findOrFail($id);

        $request->validate([
            'question' => 'required|min:3',
            'answer' => 'required',
        ]);


        // Update record
        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        $notification = [
            'message' => 'Faq updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.faq.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::findOrFail($id);

        // Delete DB record
        $faq->delete();

        $notification = [
            'message' => 'Faq deleted successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.faq.index')->with($notification);
    }
}
