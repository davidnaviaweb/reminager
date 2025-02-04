<?php

namespace App\Http\Controllers;

use App\Enums\ReminderPriority;
use App\Enums\ReminderStatus;
use App\Enums\ReminderType;
use App\Models\Label;
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

        if ($request->filled('label')) {
            $query->whereHas('labels', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->label . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('sort')) {
            $sort = explode('.', $request->sort);
            $query->orderBy($sort[0], $sort[1]);
        }

        \Log::info('Query:', (array)$query->toSql());

        $reminders = $query->get();

        $labels = Label::all();

        return view('reminders.list', compact('reminders', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Datos recibidos en store:', $request->all());

        $request->merge(['user_id' => auth()->id(), 'status' => ReminderStatus::PENDING->value]);

        \Log::info('Request:', $request->all());

        $validatedData = $this->validateRequest($request);

        \Log::info('Datos validados en store:', $validatedData);

        // Creación del recordatorio
        $reminder = Reminder::create($validatedData);

        if ($request->filled('labels')) {
            $reminder->labels()->attach($request->labels);
        }

        return redirect()->route('reminders.index')->with('success', 'Reminder created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reminder $reminder)
    {
        \Log::info('Datos recibidos para actualizar:', $request->all());

        $validatedData = $this->validateRequest($request);

        \Log::info('Datos validados para actualizar:', $validatedData);

        // Actualizar los campos del recordatorio
        $reminder->update($validatedData);

        // Actualizar etiquetas asociadas
        if ($request->filled('labels')) {
            \Log::info('Etiquetas a sincronizar:', $request->labels);
            $reminder->labels()->sync($request->labels); // Sincronizar etiquetas
        } else {
            \Log::info('No se enviaron etiquetas, eliminando asociaciones existentes.');
            $reminder->labels()->sync([]); // Eliminar todas las etiquetas si no se enviaron
        }

        \Log::info('Recordatorio actualizado correctamente:', $reminder->toArray());

        return redirect()->route('reminders.index')->with('success', 'Reminder updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reminder $reminder)
    {
        $labels = Label::all();
        return view('reminders.show', compact('reminder', 'labels'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();

        return redirect()->route('reminders.index')->with('success', 'Reminder deleted successfully.');
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateRequest(Request $request): array
    {
        $validation = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:' . implode(',', ReminderType::getValues()),
            'priority' => 'required|in:' . implode(',', ReminderPriority::getValues()),
            'status' => 'required|in:' . implode(',', ReminderStatus::getValues()),
            'due_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'labels' => 'nullable|array',
            'labels.*' => 'integer|exists:labels,id',
            'user_id' => 'integer|exists:users,id',
        ];

        if ($request->filled('type')) {
            if ($request->type == ReminderType::TASK->value) {
                $request->merge(['start_date' => $request->due_date, 'end_date' => $request->due_date]);
            } else {
                $request->merge(['due_date' => $request->end_date]);
            }
        }

        return $request->validate($validation);
    }
}
