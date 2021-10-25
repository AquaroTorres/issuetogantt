<div>
    <style>
		html, body {
			margin: 0;
			padding: 0;
			font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
			font-size: 14px;
		}
		#calendarByUser {
            overflow:auto;
			margin: 40px auto;
		}
		#calendarByUser .fc-day-sun, 
		#calendarByUser .fc-day-sat{
			background-color: #cccccc;
		}
		.fc-toolbar .fc-toolbar-title:before {
			float: right;
			content: ' - {{ session('gh_repos') }}';
		}
	</style>
    
    <div id='calendar-container' wire:ignore>

        <div id='calendarByUser'></div>
    </div>
</div>
    @push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.5.0/main.min.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.5.0/main.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function () {
        
        

            var calendarE2 = document.getElementById('calendarByUser');

            var calendarByUser = new FullCalendar.Calendar(calendarE2, {
                locale: '{{ env('FULLCALENDAR_LOCALE') }}',
                schedulerLicenseKey: '{{ env('FULLCALENDAR_SERIAL') }}',
                timeZone: 'UTC',
                initialView: 'resourceTimelineMonth',
                // aspectRatio: 2,
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title'
                },
                contentHeight: 'auto',
                slotLabelFormat: [
                    { day: 'numeric' }, // top level of text
                    { weekday: 'narrow' } // lower level of text
                ],
                nowIndicator: true,
                editable: true,
                resourceAreaColumns: [

                    {
                        field: 'title',
                        headerContent: '{{ __('messages.project_milestone') }} - {{ __('messages.issue') }}'
                    },
                    {
                        group: true,
                        field: 'assignees',
                        headerContent: '{{ __('messages.assignees') }}'
                    }
                ],
                //resources: 'https://fullcalendar.io/demo-resources.json?with-nesting&with-colors',
                resources: JSON.parse(@this.resources),
                //events: 'https://fullcalendar.io/demo-events.json?single-day&for-resource-timeline'
                events: JSON.parse(@this.events),

                eventResize: info => @this.eventResize(info.event, info.oldEvent),
                eventDrop: info => @this.eventDrop(info.event, info.oldEvent)
            });

            calendarByUser.render();
        });
    </script>
    @endpush
</div>