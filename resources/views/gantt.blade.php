<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    @livewireStyles
	<style>


	#calendar {
		max-height: 800px;
		margin: 40px auto;
	}

</style>

	</head>
  	<body>
		<livewire:gantt /> 
		@livewireScripts
		@stack('scripts')
	</body>
</html>