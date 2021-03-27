<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('id', 'desc')->get()->each(function ($message) {
            $message->content = str_replace('<p><br></p>', '', $message->content);
        });

        return Inertia::render('Messages', compact('messages'));
    }
}
