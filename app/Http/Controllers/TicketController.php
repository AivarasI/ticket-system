<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketStatusChanged;

use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $user = auth()->user();

    if ($user->isAdmin()) {
        $tickets = Ticket::with('category')->get();
    } else {
            $tickets = Ticket::with('category')
        ->where('user_id', $user->id())
        ->get();
    }

    return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
         return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'title' => 'required',
        'description' => 'required',
        'category_id' => 'required|exists:categories,id',
    ]);

    Ticket::create([
        'title' => $request->title,
        'description' => $request->description,
        'category_id' => $request->category_id,
        'user_id' => auth()->id(),
        'status' => 'new',
    ]);

    return redirect()->route('tickets.index');
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
    public function edit(Ticket $ticket)
    {
            // Tik ticket savininkas arba admin gali redaguoti
   if(Auth::id() !== $ticket->user_id && Auth::user()->role !== 'admin') {
        abort(403, 'Unauthorized');
    }

    $categories = Category::all();
    $statuses = ['new', 'in_progress', 'done'];

    return view('tickets.edit', compact('ticket', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
            // Tik ticket savininkas arba admin gali atnaujinti
   if (Auth::id() !== $ticket->user_id && Auth::user()->role !== 'admin') {
        abort(403, 'Unauthorized');
    }

    $oldStatus = $ticket->status;

    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'category_id' => 'required|exists:categories,id',
        'status' => 'required|in:new,in_progress,done',
    ]);

    $ticket->update([
        'title' => $request->title,
        'description' => $request->description,
        'category_id' => $request->category_id,
        'status' => $request->status,
    ]);

        if ($oldStatus !== $ticket->status) {
        Mail::to($ticket->user->email)->send(new TicketStatusChanged($ticket));
    }

    return redirect()->route('tickets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
