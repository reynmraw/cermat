<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legal Forms List</title>
</head>
<body>
    <h1>Legal Forms</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul Legal</th>
                <th>Sub Judul</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($legalForms as $legalForm)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $legalForm->judul_legal }}</td>
                <td>{{ $legalForm->sub_judul }}</td>
                <td>{{ $legalForm->status }}</td>
                <td>
                    <a href="{{ route('form.legal.edit', $legalForm->id) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
