<!DOCTYPE html>
<html lang='en'>
<head>
	<title>GanttIssue</title>
    <meta charset='utf-8' />
    @livewireStyles
</head>
<body>
	<form method="post" action="{{ route('config.delete') }}">
		@csrf
		@method('DELETE')
		
		<input type="submit" value="Logout">
	</form>
	<livewire:gantt /> 
	@livewireScripts
	@stack('scripts')
</body>
</html>