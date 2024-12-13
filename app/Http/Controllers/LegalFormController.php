<?php

namespace App\Http\Controllers;

use App\Models\LegalForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



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
            'dibuat_oleh' => Auth::user()->name,
        ]);

        $user = Auth::user();
        Log::info("Form Submitted", ['name' => $user->name]);

        return back()->with('success', 'Form successfully submitted!');
    }
    public function index()
    {
        // Get all legal forms from the database
        $legalForms = LegalForm::all(); 

        // Pass them to the view
        return view('admin/showLegal', compact('legalForms'));
    }

    /**
     * Show the form for editing the specified legal form.
     */
    public function edit($id)
    {
        // Find the specific legal form by ID
        $legalForm = LegalForm::findOrFail($id);

        // Pass the legal form data to the view
        return view('admin/editLegal', compact('legalForm'));
    }

    /**
     * Update the specified legal form in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'judul_legal' => 'required|string|max:255',
            'sub_judul' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        // Find the legal form and update its values
        $legalForm = LegalForm::findOrFail($id);
        $legalForm->update([
            'judul_legal' => $request->judul_legal,
            'sub_judul' => $request->sub_judul,
            'status' => $request->status,
        ]);

        $user = Auth::user();
        Log::info("Form Updated", ['name' => $user->name]);

        // Redirect back to the legal forms list with a success message
        return redirect()->route('form.legal.index')->with('success', 'Legal form updated successfully.');
    }
}
