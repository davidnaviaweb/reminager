<?php

use App\Enums\ReminderPriority;
use App\Enums\ReminderType;
use App\Enums\ReminderStatus;

$isOverdue = isset($reminder->due_date) && \Carbon\Carbon::parse($reminder->due_date)->isPast();

?>
<div>
    <form action="{{ $action }}" method="POST" onsubmit="{{ $onSubmit }}">
        @csrf
        @method($method)
        <div class="flex flex-wrap gap-1 justify-between">
            <!-- Title, type, priority, status -->
            <div class="flex flex-wrap w-full gap-2">
                <div class="mb-4 w-full flex-grow">
                    <label for="title"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{__('Title')}}</label>
                    <input type="text" id="title" name="title" required value="{{ $reminder->title ?? '' }}"
                           class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col sm:flex-row flex-grow gap-2">
                    <div class="mb-4 w-full md:w-1/3 flex-grow items-stretch">
                        <label for="type"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{__('Type')}}</label>
                        <select id="type" name="type" required value="task"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @foreach(ReminderType::getValues() as $type)
                                <option value="{{ $type }}"
                                    {{ $reminder->type ==  $type ? 'selected' : '' }}>
                                    {{ ReminderType::getConfig( $type)['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4 w-full md:w-1/3 flex-grow items-stretch {{($reminder->type == ReminderType::TASK->value) ? '' : 'hidden'}}">
                        <label for="due_date"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{__('Due date')}}</label>
                        <input type="datetime-local" id="due_date" name="due_date" {{($reminder->type == ReminderType::TASK->value) ? 'required' : ''}}
                               value="{{$reminder->due_date}}"
                               class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4 w-full md:w-1/3 flex-grow items-stretch {{($reminder->type == ReminderType::EVENT->value) ? '' : 'hidden'}}">
                        <label for="due_date"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{__('Start')}}</label>
                        <input type="datetime-local" id="start_date" name="start_date" {{($reminder->type == ReminderType::EVENT->value) ? 'required' : ''}}
                               value="{{$reminder->start_date}}"
                               class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4 w-full md:w-1/3 flex-grow items-stretch {{($reminder->type == ReminderType::EVENT->value) ? '' : 'hidden'}}">
                        <label for="due_date"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{__('End')}}</label>
                        <input type="datetime-local" id="end_date" name="end_date" {{($reminder->type == ReminderType::EVENT->value) ? 'required' : ''}}
                               value="{{$reminder->end_date}}"
                               class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row flex-grow gap-2">
                <div class="mb-4 w-full sm:w-1/2">
                    <label for="priority"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{__('Priority')}}</label>
                    <select id="priority" name="priority" required
                            class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @foreach(ReminderPriority::getValues() as $priority)
                            <option value="{{ $priority }}"
                                {{ $reminder->$priority ==  $priority ? 'selected' : '' }}>
                                {{ ReminderPriority::getConfig( $priority)['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4 w-full sm:w-1/2">
                    <label for="status"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{__('Status')}}</label>
                    <select id="status" name="status" {{$reminder->id == 0 ? 'disabled' : 'required' }}
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @foreach(ReminderStatus::getValues() as $status)
                            <option value="{{ $status }}"
                                {{ $reminder->status ==  $status ? 'selected' : '' }}>
                                {{ ReminderStatus::getConfig( $status)['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex flex-wrap w-full gap-2">
                <div class="mb-4 w-full">
                    <label for="description"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{__('Description')}}</label>
                    <textarea id="description" name="description"
                              class="w-full h-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none">{{$reminder->description ?? ''}}</textarea>
                </div>
            </div>
            <div class="mt-4 mb-4 w-full">
                <label for="labels"
                       class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{__('Labels')}}</label>
                <div class="relative">
                    <button type="button" id="labels-dropdown-{{ $reminder->id }}"
                            class="w-full text-left px-3 py-2 bg-white border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        Select Labels
                        <span class="float-right">▼</span>
                    </button>
                    <div id="labels-menu-{{ $reminder->id }}"
                         class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 border rounded-md shadow-lg hidden">
                        @foreach($labels as $label)
                            <div class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <input {{$reminder->labels->contains($label->id) ? 'checked' : ''}} type="checkbox"
                                       name="labels[]" value="{{ $label->id }}"
                                       id="label-{{ $label->id }}-{{ $reminder->id }}"
                                       class="mr-2" onchange="updateSelectedLabels({{ $reminder->id }})">
                                <label for="label-{{ $label->id }}-{{ $reminder->id }}"
                                       class="text-sm text-gray-700 dark:text-gray-300">
                                    <x-label-badge :label="$label"/>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end gap-2">
            @if($reminder->id === 0)
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm flex items-center justify-center shadow">
                    <x-heroicon-m-document-check class="w-4 h-4 mr-1"/>
                    {{ $submitLabel }}
                </button>
            @else
                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded text-sm flex items-center justify-center shadow">
                    <x-heroicon-m-check-circle class="w-4 h-4 mr-1"/>
                    {{__('Save')}}
                </button>
            @endif
            <button type="button" @click="{{ $onCancel }}"
                    class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded text-sm flex items-center justify-center shadow">
                <x-heroicon-m-x-circle class="w-4 h-4 mr-1"/>
                {{ __('Cancel') }}
            </button>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const dueDateField = document.getElementById('due_date').parentElement;
        const startDateField = document.getElementById('start_date').parentElement;
        const endDateField = document.getElementById('end_date').parentElement;

        function toggleFields() {
            const type = typeSelect.value;
            if (type === '{{ \App\Enums\ReminderType::TASK->value }}') {
                dueDateField.classList.toggle('hidden');
                startDateField.classList.toggle('hidden');
                endDateField.classList.toggle('hidden');
                document.getElementById('due_date').required = true;
                document.getElementById('start_date').required = false;
                document.getElementById('end_date').required = false;
            } else if (type === '{{ \App\Enums\ReminderType::EVENT->value }}') {
                dueDateField.classList.toggle('hidden');
                startDateField.classList.toggle('hidden');
                endDateField.classList.toggle('hidden');
                document.getElementById('due_date').required = false;
                document.getElementById('start_date').required = true;
                document.getElementById('end_date').required = true;
            }
        }

        typeSelect.addEventListener('change', toggleFields);

        const labelsDropdown = document.querySelectorAll('[id^="labels-dropdown-"]');
        labelsDropdown.forEach(dropdown => {
            dropdown.addEventListener('click', function (event) {
                debugger
                event.target.closest('div').querySelector('[id^="labels-menu-"]').classList.toggle('hidden')
            });
        });

        const labels = document.querySelectorAll('[id^="labels-menu-"]');

        labels.forEach(label => {
            inputs = label.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('change', function (event) {
                    updateSelectedLabels(event.target.id.split('-').pop());
                });
            });
        });

        function updateSelectedLabels(reminderId) {
            const selectedLabelsContainer = document.getElementById(`selected-labels-${reminderId}`);
            selectedLabelsContainer.innerHTML = '';

            const selectedCheckboxes = document.querySelectorAll(`#labels-menu-${reminderId} input[name="labels[]"]:checked`);

            selectedCheckboxes.forEach(checkbox => {
                const labelId = checkbox.value;
                const labelName = checkbox.nextElementSibling.querySelector('span').textContent;

                const badge = document.createElement('span');
                badge.className = 'px-1 rounded text-xs';
                badge.style.backgroundColor = checkbox.parentElement.querySelector('span').style.backgroundColor;
                badge.textContent = labelName;

                selectedLabelsContainer.appendChild(badge);
            });
        }
    });
</script>
