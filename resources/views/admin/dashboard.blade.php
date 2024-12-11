<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }} ({{ Auth::user()->role }})</p>
    <p>Welcome, {{ Auth::user() }} ({{ Auth::check() }})</p>
    <a href="{{ route('admin.articles.edit') }}">Edit Articles</a>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
