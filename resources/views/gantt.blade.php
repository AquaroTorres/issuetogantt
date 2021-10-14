<!DOCTYPE html>
<html lang='es'>
<head>
	<title>GanttIssue</title>
    <meta charset='utf-8' />
    @livewireStyles
</head>
<body>
	<table width="100%">
		<tr>
			<td><h1 style="text-align: center">Issue to Gantt</h1></td>
			<td width="100">
				<form method="post" action="{{ route('config.delete') }}">
					@csrf
					@method('DELETE')
					
					<input type="submit" value="{{ __('messages.logout') }}">
				</form>
			</td>
		</tr>
	</table>

	<livewire:gantt />

	<p style="text-align: center">
		<strong>{{ __('messages.template') }}:</strong>
			GanttStart: 2021-10-07 GanttDue: 2021-10-15 GanttProgress: 69%
	</p>

	@livewireScripts
	@stack('scripts')
</body>
</html>