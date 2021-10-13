<form method="post" action="{{ route('config.store') }}">
    @csrf
    @method('POST')

    <label for="">User</label>
    <input type="text" name="gh_user" required>
    <br>
    <label for="">Github Token</label>
    <input type="text" name="gh_token" required>
    <br>
    <label for="">Github Repos (repo/project) comma separated</label>
    <input type="text" name="gh_repos" required>
    <br>
    <input type="submit" value="Guardar">
</form>