<div>
    <pre wire:model='events'>{{ $events }}</pre>

    <div id='calendar-container' wire:ignore>
        <div id='calendar'></div>
    </div>
    
    @push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.9.0/main.min.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.9.0/main.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function () {
        
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                schedulerLicenseKey: '0404885988-fcs-1582214203',
                timeZone: 'UTC',
                initialView: 'resourceTimelineMonth',
                aspectRatio: 1.5,
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title'
                },
                editable: true,
                resourceAreaHeaderContent: 'Dias',
                //resources: 'https://fullcalendar.io/demo-resources.json?with-nesting&with-colors',
                resources: JSON.parse(@this.resources),
                //events: 'https://fullcalendar.io/demo-events.json?single-day&for-resource-timeline'
                events: JSON.parse(@this.events),
                
                eventResize: info => @this.eventResize(info.event, info.oldEvent),
                eventDrop: info => @this.eventDrop(info.event, info.oldEvent)
            });
            calendar.render();
        });
    </script>
    @endpush
</div>
