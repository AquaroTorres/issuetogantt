<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue to Gantt</title>
    <style type="text/css">
        table.center {
            margin-left: auto;
            margin-right: auto;
        }

        html, body {
            width: 100%;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center">Issue to Gantt</h1>
    
    <form method="post" action="{{ route('config.store') }}" style="text-align: center">
        @csrf
        @method('POST')
        <h2 style="text-align: center">{{ __('messages.configuration') }}</h2>
        <table class="center">
            <tr>
                <td><label for="">{{ __('messages.github_user') }}</label></td>
                <td><input type="text" name="gh_user" required size="50"></td>
            </tr>
            <tr>
                <td><label for="">{{ __('messages.github_token') }}</label></td>
                <td><input type="text" name="gh_token" required size="50" placeholder="Personal access token"></td>
            </tr>
            <tr>
                <td><label for="">{{ __('messages.github_repos') }}</label></td>
                <td><input type="text" name="gh_repos" required size="50" placeholder="repo1/project1,repo2/project2,..."></td>
            </tr>
        </table>
        <br><br>
        <input type="submit" value="{{ __('messages.save') }}">
    </form>

    @include('issue_template')

</body>
</html>