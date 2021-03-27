<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Company;
use App\Models\User;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return Inertia::render('Profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
        ]);

        $user->fill($validated);

        if (!empty($request->password)) {
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);

            $user->password = bcrypt($request->password);
        }

        $user->save();

        $request->session()->flash('flash.banner', __('Your account is now updated!'));

        return back();
    }
}
