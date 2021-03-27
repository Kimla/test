<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('id', 'desc')->get();

        return Inertia::render('Admin/Messages/Index', compact('messages'));
    }

    public function create()
    {
        return Inertia::render('Admin/Messages/Create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        Message::create($validated);

        $request->session()->flash('flash.banner', __('The Message is now created!'));

        return redirect()->route('admin.messages.index');
    }

    public function edit(Message $message)
    {
        return Inertia::render('Admin/Messages/Edit', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $validated = $this->validateRequest($request);

        $message->fill($validated);

        $message->save();

        $request->session()->flash('flash.banner', __('The Message is now updated!'));

        return back();
    }

    public function destroy(Request $request, Message $message)
    {
        $message->delete();

        $request->session()->flash('flash.banner', __('The Message is now deleted!'));

        return redirect()->route('admin.messages.index');
    }

    protected function validateRequest(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:255',
            'image' => 'required',
            'content' => 'required',
        ]);
    }
}
