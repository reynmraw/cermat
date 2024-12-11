<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>

    @if (session('user_email'))
        <p>Welcome, {{ session('user_name') }}</p>
        <p>Your Email: {{ session('user_email') }}</p>
        <p>Your API Token: {{ session('api_token') }}</p>
        <p>Your Department ID: {{ session('department_id') }}</p>
        <p>Check login: {{ Auth::check()}}</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <p>You are not logged in.</p>
    @endif
</body>
</html>
