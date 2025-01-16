<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reminders') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <a href="{{ route('reminders.create') }}" class="btn btn-primary">Create Reminder</a>
                        <table class="table tab">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reminders as $reminder)
                                <tr>
                                    <td>{{ $reminder->name }}</td>
                                    <td>{{ $reminder->description }}</td>
                                    <td>{{ $reminder->type }}</td>
                                    <td>{{ $reminder->priority }}</td>
                                    <td>{{ $reminder->status }}</td>
                                    <td>{{ $reminder->due_date }}</td>
                                    <td>
                                        <a href="{{ route('reminders.show', $reminder->id) }}"
                                           class="btn btn-info">View</a>
                                        <a href="{{ route('reminders.edit', $reminder->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST"
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
