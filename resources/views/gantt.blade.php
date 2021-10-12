<!DOCTYPE html>
<html lang='en'>
<head>
	<title>GanttIssue</title>
    <meta charset='utf-8' />
    @livewireStyles
	<style>
	#calendar {
		max-height: 800px;
		margin: 40px auto;
	}
	#calendar .fc-day-sun, 
	#calendar .fc-day-sat,
	#calendarByUser .fc-day-sun, 
	#calendarByUser .fc-day-sat{
    	background-color: #ffc2c2;
	}
</style>

	</head>
  	<body>
		<livewire:gantt /> 
		@livewireScripts
		@stack('scripts')
	</body>
</html>