@extends('layouts.app')
@section('content')

<!-- Custom fonts for this template-->
<link href="sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="sb-admin/css/sb-admin-2.min.css" rel="stylesheet">

<div class="container">
    <h2 class="text-center text-gray-900 mb-4">Users Management</h2>
    
    <!-- Go to Admin Panel Button -->
    <a href="{{ route('admin.index') }}" class="btn btn-secondary mb-3">
        Go to Admin Panel
    </a>
    
    <!-- Add New User Button -->
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add New User</a>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Users Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-warning">Edit</a>
                        
                        <!-- Delete Form -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="sb-admin/vendor/jquery/jquery.min.js"></script>
<script src="sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="sb-admin/js/sb-admin-2.min.js"></script>

@endsection
