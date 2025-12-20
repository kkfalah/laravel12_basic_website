<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


use function Pest\Laravel\session;

class AdminController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin');
    }


    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $verificationCode = random_int(100000, 999999);

            session(['verification_code' => $verificationCode, 'user_id' => $user->id]);

            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

            Auth::logout();

            return redirect()->route('custom.verification.form')->with('status', 'Verification code sent to your email!');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credential provided']);
        }
    }

    public function verification()
    {
        return view('auth.verify-login');
    }

    public function verify(Request $request)
    {
        $request->validate(['code' => 'required|numeric']);

        if ($request->code == session(['verification_code'])) {
            Auth::loginUsingId(session(['user_id']));

            $request->session()->forget(['verification_code', 'user_id']);

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['code' => 'Invalid verification code']);
    }

    public function profile()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        return view('backend.profile', compact('user'));
    }


    public function profileStore(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;

        $oldPhoto = $user->photo;

        if ($request->hasFile('photo')) {

            // Get original file name and extension
            $original = pathinfo($request->file('photo')->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = str_replace(' ', '-', $request->name);
            $ext = $request->file('photo')->getClientOriginalExtension();

            // Create new filename: originalName-2025-01-20-153015.jpg
            $newFileName = $filename . '-' . now()->format('YmdHis') . '.' . $ext;

            // Store in storage/app/public/users
            $path = $request->file('photo')->storeAs('users', $newFileName, 'public');

            // Save new path to database
            $user->photo = $path;

            // Delete old photo if exists
            if ($oldPhoto && Storage::disk('public')->exists($oldPhoto)) {
                Storage::disk('public')->delete($oldPhoto);
            }
        }

        $user->save();  

        $notificaton = array(
            'message' => 'Profile updated successfully',
            'alert-type' => 'success',
        );

        return back()->with($notificaton);
    }

    public function passwordUpdate(Request $request){
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if(!Hash::check($request->old_password,$user->password)){
            $notificaton = array(
                'message' => 'Old password does not match',
                'alert-type' => 'error',
            );
            
            return back()->with($notificaton);
        }

        User::whereId($user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        Auth::logout();

        $notificaton = array(
            'message' => 'Password updated successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('login')->with($notificaton);


    }

}
