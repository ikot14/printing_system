<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FileUpload;

class FileUploadController extends Controller
{
    /**
     * Handle file download request.
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\RedirectResponse
     */
    public function download($id)
    {
        // Find the file by ID
        $file = FileUpload::find($id);

        if (!$file) {
            return redirect()->back()->with('error', 'File not found.');
        }

        // Get the file path
        $filePath = str_replace('/storage/', '', $file->file_path);

        // Check if file exists in storage
        if (!Storage::exists($filePath)) {
            return redirect()->back()->with('error', 'File does not exist.');
        }

        // Serve the file for download
        return Storage::download($filePath, $file->file_name); 
    }
    
    /**
     * Display the file upload form.
     *
     * @return \Illuminate\View\View
     */
    public function getFileUploadForm()
    {
        return view('layouts.file-upload');
    }

    /**
     * Store the uploaded file and student data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'file' => 'required|mimes:pdf,xlsx,xls,docx,doc,csv,txt,png,gif,jpg,jpeg|max:2048',
            'student_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:50',
        ]);
 
        // Get uploaded file details
        $fileName = $request->file('files')->getClientOriginalName();
        $filePath = 'storage.app.public.uploads' . $fileName;

        // Store file
        $path = $request->file('file')->storeAs('public', $filePath);
        $fileUrl = Storage::url($filePath);

        // Save data to database
        $fileUpload = FileUpload::create([
            'student_name' => $request->input('student_name'),
            'student_id' => $request->input('student_id'),
            'file_name' => $fileName,
            'file_path' => $fileUrl,
        ]);

        // Return response
        return back()->with('success', "File uploaded successfully for {$fileUpload->student_name} (ID: {$fileUpload->student_id}).");
    }

    /**
     * List all uploaded files.
     *
     * @return \Illuminate\View\View
     */
    public function index()
{

    // Fetch all uploaded files from the database
    $files = FileUpload::all();
     dd($files);

    // Pass the files to the view
    return view('admin.index', compact('files'));
}



}
