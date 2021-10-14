<form method="post" action="{{ route('config.store') }}">
    @csrf
    @method('POST')
    <h2>{{ __('messages.configuration') }}</h2>
    <table>
        <tr>
            <td><label for="">{{ __('messages.github_user') }}</label></td>
            <td><input type="text" name="gh_user" required size="40"></td>
        </tr>
        <tr>
            <td><label for="">{{ __('messages.github_token') }}</label></td>
            <td><input type="text" name="gh_token" required size="40"></td>
        </tr>
        <tr>
            <td><label for="">{{ __('messages.github_repos') }}</label></td>
            <td><input type="text" name="gh_repos" required size="40" placeholder="repo1/project1,repo2/project2,..."></td>
        </tr>
    </table>
    <input type="submit" value="Guardar">
</form>