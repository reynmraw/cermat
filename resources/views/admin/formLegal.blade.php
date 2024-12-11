<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Legal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Form Legal</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('form.legal.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="judul_legal" class="form-label">Judul Legal</label>
                <input type="text" class="form-control" id="judul_legal" name="judul_legal" placeholder="Masukkan Judul Legal" value="{{ old('judul_legal') }}" required>
                @error('judul_legal')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="sub_judul" class="form-label">Sub Judul</label>
                <input type="text" class="form-control" id="sub_judul" name="sub_judul" placeholder="Pilih Subjudul" value="{{ old('sub_judul') }}" required>
                @error('sub_judul')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="file_legal" class="form-label">File Legal</label>
                <input type="file" class="form-control" id="file_legal" name="file_legal" required>
                @error('file_legal')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit Form</button>
        </form>
    </div>
</body>
</html>
