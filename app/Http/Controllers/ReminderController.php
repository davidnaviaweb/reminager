<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Reminder::query();

        // Filtrar por etiqueta si se proporciona
        if ($request->has('label') && $request->label) {
            $query->where('label', 'like', '%' . $request->label . '%');
        }

        $reminders = $query->get();

        return view('reminders.index', compact('reminders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['user_id' => auth()->id()]);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:Task,Event', // Conserva la capitalización correcta de las opciones
            'priority' => 'required|in:High,Medium,Low',
            'status' => 'required|in:Completed,In progress,Pending',
            'due_date' => 'required|date',
            'label' => 'nullable|string|max:255', // Asegura que 'label' sea validado correctamente
            'user_id' => 'required|exists:users,id',
        ]);

        Reminder::create($request->all());

        return redirect()->route('reminders.index')->with('success', 'Reminder created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reminder $reminder)
    {
        return view('reminders.show', compact('reminder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reminder $reminder)
    {
        return view('reminders.edit', compact('reminder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reminder $reminder)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:Task,Event',
            'priority' => 'required|in:High,Medium,Low',
            'status' => 'required|in:Completed,In progress,Pending',
            'due_date' => 'required|date',
            'label' => 'nullable|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $reminder->update($request->all());

        return redirect()->route('reminders.index')->with('success', 'Reminder updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();

        return redirect()->route('reminders.index')->with('success', 'Reminder deleted successfully.');
    }
}
