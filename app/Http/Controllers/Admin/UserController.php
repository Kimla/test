<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')
            ->where('admin', true)
            ->get();

        return Inertia::render('Admin/Users/Index', compact('users'));
    }

    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', compact('user'));
    }

    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')],
            'password' => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = bcrypt($request->password);
        $validated['admin'] = true;

        $request->session()->flash('flash.banner', __('The User is now created!'));

        return redirect()->route('admin.users.index');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->fill($validated);

        if (!empty($request->password)) {
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);

            $user->password = bcrypt($request->password);
        }

        $user->save();

        $request->session()->flash('flash.banner', __('The User is now updated!'));

        return back();
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();

        $request->session()->flash('flash.banner', __('The User is now deleted!'));

        return redirect()->route('admin.users.index');
    }
}
