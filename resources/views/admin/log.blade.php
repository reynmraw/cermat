<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a, .pagination span {
            display: inline-block; 
            margin: 0 5px; 
            padding: 8px 12px;
            text-decoration: none;
            color: #4CAF50;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination .active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        .pagination a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Log Summary</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Type</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Logins</td>
                <td>{{ $summary['logins'] }}</td>
            </tr>
            <tr>
                <td>Logouts</td>
                <td>{{ $summary['logouts'] }}</td>
            </tr>
            <tr>
                <td>Form Submissions</td>
                <td>{{ $summary['form_submissions'] }}</td>
            </tr>
            <tr>
                <td>Form Updates</td>
                <td>{{ $summary['form_updates'] }}</td>
            </tr>
        </tbody>
    </table>

    <h2>User Activity Logs</h2>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Message</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log['date'] }}</td>
                <td>{{ $log['message'] }}</td>
                <td>{{ json_encode($log['details']) }}</td> <!-- Option 1: Display as JSON -->
                <!-- Option 2: Display specific key from the array -->
                <!-- <td>{{ $log['details']['user_id'] ?? 'N/A' }}</td> -->
            </tr>
            @endforeach
        </tbody>
    </table>
    

    {{ $logs->links() }} <!-- Pagination links -->
</body>
</html>
