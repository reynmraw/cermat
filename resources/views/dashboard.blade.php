<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome to the Dashboard</h1>
<p>Hi, {{ Auth::user()->name }}! You are logged in as <strong>{{ ucfirst(Auth::user()->role) }}</strong>.</p>

<hr>

<h2>Available Features</h2>

@if(Auth::user()->role === 'admin')
    <h3>Admin Features</h3>
    <ul>
        <li><a href="{{ route('admin.articles.edit') }}">Edit Articles</a></li>
        <li><a href="{{ route('form.legal') }}">Manage Legal Documents</a></li>
        <li><a href="#">User Management</a></li>
    </ul>
@endif

@if(Auth::user()->role === 'editor')
    <h3>Auditor Features</h3>
    <ul>
        <li><a href="#">View Reports</a></li>
        <li><a href="#">Audit Logs</a></li>
    </ul>
@endif

@if(Auth::user()->role === 'user')
    <h3>User Features</h3>
    <ul>
        <li><a href="#">View Personal Profile</a></li>
        <li><a href="#">Submit Requests</a></li>
    </ul>
@endif

<hr>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

</body>
</html>
