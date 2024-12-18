<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FileUpload;  // Assuming you have a FileUpload model to save the data

class FileUploadController extends Controller
{
    public function getFileUploadForm()
    {
        return view('file-upload2');
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'file' => 'required|mimes:pdf,xlsx,xls,docx,doc,csv,txt,png,gif,jpg,jpeg|max:2048',
            'student_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:50',
        ]);

        // Get the uploaded file and student data
        $fileName = $request->file('file')->getClientOriginalName();
        $filePath = 'uploads/' . $fileName;
        $studentName = $request->input('student_name');
        $studentId = $request->input('student_id');

        // Store the file
        $path = $request->file('file')->storeAs('public', $filePath);
        $fileUrl = Storage::url($filePath);

        // Save file and student info to the database (assuming you have a FileUpload model)
        $fileUpload = new FileUpload();
        $fileUpload->student_name = $studentName;
        $fileUpload->student_id = $studentId;
        $fileUpload->file_name = $fileName;
        $fileUpload->file_path = $fileUrl;
        $fileUpload->save();

        // Return success message
        return back()->with('success', 'File has been successfully uploaded.');
    }
}
