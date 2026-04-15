<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
           'first_name' => ['required', 'string', 'max:255'],
        'last_name'  => ['nullable', 'string', 'max:255'],
        'username'   => ['nullable', 'string', 'max:255'],
        'bio'        => ['nullable', 'string', 'max:500'],
        'email'      => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        'profile_photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $validated['profile_photo'] = $request->file('profile_photo')->store('profiles', 'public');
        }

        $user->name = trim($validated['first_name'] . ' ' . ($validated['last_name'] ?? ''));
        $user->email = $validated['email'];
          $user->username = $validated['username'] ?? null;
    $user->bio = $validated['bio'] ?? null;

        if (isset($validated['profile_photo'])) {
            $user->profile_photo = $validated['profile_photo'];
        }

        $user->save();

        return back()->with('success', 'Na-update na ang iyong profile!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Mali ang iyong kasalukuyang password.',
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Na-update na ang iyong password!');
    }
}