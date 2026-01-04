<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Mail\CommentAdded;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = $ticket->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        Mail::to($ticket->user->email)->send(
            new CommentAdded($comment)
        );
        return redirect()->back();
    }
}
