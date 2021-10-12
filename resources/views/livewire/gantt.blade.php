<div>
    <div id='calendar-container' wire:ignore>
        <div id='calendar'></div>
        <div id='calendarByUser'></div>
    </div>
    
    @push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.5.0/main.min.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.5.0/main.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function () {
        
            var calendarEl = document.getElementById('calendar');
            var calendarE2 = document.getElementById('calendarByUser');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                schedulerLicenseKey: '{{ env('SERIAL_FULLCALENDAR') }}',
                timeZone: 'UTC',
                initialView: 'resourceTimelineMonth',
                //aspectRatio: 2,
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title'
                },
                nowIndicator: true,
                editable: true,
                resourceAreaColumns: [
                    {
                        group: true,
                        field: 'milestone',
                        headerContent: 'Milestones'
                    },
                    {
                        field: 'title',
                        headerContent: 'Evento'
                    },
                    {
                        field: 'assignees',
                        headerContent: 'Asignado a:'
                    }
                ],
                //resources: 'https://fullcalendar.io/demo-resources.json?with-nesting&with-colors',
                resources: JSON.parse(@this.resources),
                //events: 'https://fullcalendar.io/demo-events.json?single-day&for-resource-timeline'
                events: JSON.parse(@this.events),

                eventResize: info => @this.eventResize(info.event, info.oldEvent),
                eventDrop: info => @this.eventDrop(info.event, info.oldEvent)
            });

            var calendarByUser = new FullCalendar.Calendar(calendarE2, {
                locale: 'es',
                schedulerLicenseKey: '{{ env('SERIAL_FULLCALENDAR') }}',
                timeZone: 'UTC',
                initialView: 'resourceTimelineMonth',
                aspectRatio: 2,
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title'
                },
                nowIndicator: true,
                editable: true,
                resourceAreaColumns: [
                    {
                        group: true,
                        field: 'assignees',
                        headerContent: 'Usuario'
                    },
                    {
                        field: 'title',
                        headerContent: 'Evento'
                    },
                    {
                        field: 'milestone',
                        headerContent: 'Milestone:'
                    }
                ],
                //resources: 'https://fullcalendar.io/demo-resources.json?with-nesting&with-colors',
                resources: JSON.parse(@this.resources),
                //events: 'https://fullcalendar.io/demo-events.json?single-day&for-resource-timeline'
                events: JSON.parse(@this.events),

                eventResize: info => @this.eventResize(info.event, info.oldEvent),
                eventDrop: info => @this.eventDrop(info.event, info.oldEvent)
            });
            calendar.render();

            calendarByUser.render();
        });
    </script>
    @endpush
</div>
