<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show form for creating a new user
    public function create()
    {
        return view('users.create');
    }

    // Store a new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Ensure the email is unique
            'password' => 'required|confirmed|min:6', // Ensure passwords match and have a minimum length of 6
        ]);

        // Create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password before storing
        ]);

        // Redirect to users index with success message
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // Show the form for editing a user
    public function edit(User $user)
    {
        // Here, you already pass $user to the view
        return view('users.edit', compact('user'));
    }

    // Update a user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ignore current user's email during uniqueness check
            'role' => 'required|string',
        ]);

        // Update the user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, // Assuming you are updating role too
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Delete a user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    // Check if the user is deleted during login and log out if so
    public function __construct()
    {
        // Ensure only authenticated users can access the routes
        $this->middleware('auth');

        // Check if the current authenticated user exists in the database
        $this->middleware(function ($request, $next) {
            $user = auth()->user(); // Get the currently authenticated user

            // Check if the user exists and if the user is deleted
            if ($user && !$user->exists) {
                auth()->logout(); // Log out the user if they don't exist (e.g., deleted)
                return redirect()->route('login')->with('error', 'Your account has been deleted.');
            }

            return $next($request);
        });
    }
}
