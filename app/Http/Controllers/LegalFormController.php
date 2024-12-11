<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LegalForm;

class LegalFormController extends Controller
{
    // Show the form
    public function showForm()
    {
        return view('admin.formLegal'); // Create this view file
    }

    // Handle form submission
    public function submitForm(Request $request)
    {
        $request->validate([
            'judul_legal' => 'required|string|max:255',
            'sub_judul' => 'required|string|max:255',
            'file_legal' => 'required|file|mimes:pdf,docx|max:2048', // Adjust allowed file types
            'status' => 'required|string',
        ]);

        // Process the form (e.g., save data to the database)
        $filePath = $request->file('file_legal')->store('legal_files', 'public');

        // You can save the form data to the database here
        // Example:
        LegalForm::create([
            'judul_legal' => $request->judul_legal,
            'sub_judul' => $request->sub_judul,
            'file_path' => $filePath,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Form successfully submitted!');
    }
}
