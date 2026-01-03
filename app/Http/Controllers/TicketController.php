<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $tickets = Ticket::with('category')
        ->where('user_id', auth()->id())
        ->get();

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
