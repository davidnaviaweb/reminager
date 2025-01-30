import './bootstrap';

import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

let calendar = null;

document.addEventListener('livewire:navigated', () => {
    let calendarEl = document.getElementById('calendar');

    // Verifica si window.reminders está definido
    const reminders = window.reminders || [];
    console.log(reminders); // Muestra los datos cargados desde Blade

    // Inicializa el calendario
    calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        events: reminders, // Usa los datos cargados desde Blade
        editable: false,
        selectable: false,
        expandRows: true,
        eventClassNames: ['flex-1', 'overflow-hidden', 'bg-transparent', '!p-0', '!m-0', 'cursor-pointer', 'mb-2', 'border-transparent'],
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek'
        },
        eventContent: function (arg) {
            const {containerClass} = arg.event.extendedProps;
            return {
                html: `<div class="${containerClass}">` + arg.event.extendedProps.html + '</div>',
            };
        },
    });

    // Filtrar por Prioridad
    document.getElementById('priorityFilter').addEventListener('change', function (e) {
        const selectedPriority = e.target.value;

        // Filtra eventos según la prioridad seleccionada
        const filteredEvents = selectedPriority
            ? reminders.filter(event => event.priority === selectedPriority)
            : reminders; // Si no hay filtro, muestra todos los eventos

        calendar.removeAllEvents(); // Limpia los eventos actuales
        calendar.addEventSource(filteredEvents); // Añade los eventos filtrados
    });

    // Filtrar por Labels
    document.getElementById('labelFilter').addEventListener('change', function (e) {
        const selectedLabel = e.target.value;

        // Filtra eventos según la etiqueta seleccionada
        const filteredEvents = selectedLabel
            ? reminders.filter(event =>
                event.labels && event.labels.includes(selectedLabel)
            )
            : reminders; // Si no hay filtro, muestra todos los eventos

        calendar.removeAllEvents(); // Limpia los eventos actuales
        calendar.addEventSource(filteredEvents); // Añade los eventos filtrados
    });

    // Muestra el calendario y oculta el preloader
    document.getElementById('preloader').classList.add('hidden');
    document.getElementById('calendar-wrapper').classList.remove('hidden');

    calendar.render();
    calendar.updateSize();

    window.addEventListener('resize', () => {
        calendar.updateSize();
    });
})
