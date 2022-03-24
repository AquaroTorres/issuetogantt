<!DOCTYPE html>
<html lang='es'>
<head>
	<title>GanttIssue</title>
    <meta charset='utf-8' />
	<link rel="apple-touch-icon" sizes="57x57" href="/images/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/images/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/images/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/images/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/images/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/images/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/images/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/images/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/images/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/images/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
	<link rel="manifest" href="/images/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/images/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
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
		<tr>
			<td><a href="{{ route('indexByProject') }}">Gantt By Project</a></td>
			<td><a href="{{ route('indexByUser') }}">Gantt By User</td>
		</tr>
	</table>

	@livewire('gantt-by-project')

    <p style="text-align: center">
		<strong>{{ __('messages.template') }}:</strong><br>
			GanttStart: date("Y-m-d") <br>
            GanttDue: date("Y-m-d", strtotime("+2 day")) <br>
            GanttProgress: 69%
	</p>

	@livewireScripts
	@stack('scripts')
</body>
</html>
