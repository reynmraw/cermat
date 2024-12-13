<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Legal Form</title>
</head>
<body>
    <h1>Edit Legal Form</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('form.legal.update', $legalForm->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="judul_legal">Judul Legal:</label>
            <input type="text" id="judul_legal" name="judul_legal" value="{{ $legalForm->judul_legal }}" required>
        </div>

        <div>
            <label for="sub_judul">Sub Judul:</label>
            <input type="text" id="sub_judul" name="sub_judul" value="{{ $legalForm->sub_judul }}" required>
        </div>

        <div>
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="active" {{ $legalForm->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $legalForm->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('form.legal.index') }}">Back to List</a>
</body>
</html>
