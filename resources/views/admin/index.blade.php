@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Welcome sa ahung gihimo</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <h1>Uploaded Files</h1>

    <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Student Name</th>
            <th>Student ID</th>
            <th>File Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($files as $file)
    <tr>
        <td>{{ $file->student_name }}</td>
        <td>{{ $file->student_id }}</td>
        <td>{{ $file->file_name }}</td>
        <td>
            <a href="{{ route('download.file', $file->id) }}" class="btn btn-sm btn-primary">Download</a>
        </td>
    </tr>
@endforeach
<pre>{{ print_r($files, true) }}</pre>

    </tbody>
</table>

</div>
@endsection