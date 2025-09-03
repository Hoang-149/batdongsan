<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Broker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('pages.admin.users.users', compact('users'));
    }
    public function create()
    {
        return view('pages.admin.users.create_user');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:Users,username',
            'email' => 'required|string|email|max:100|unique:Users,email',
            'password' => 'required|string|min:8|confirmed',
            'full_name' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:15',
            'is_verified' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password_hash' => $request->password, // Handled by mutator in User model
                'full_name' => $request->full_name,
                'phone_number' => $request->phone_number,
                'is_verified' => $request->is_verified,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $roleId = $request->role === 'user' ? 3 : 2;
            $user->roles()->attach($roleId, ['assigned_at' => now()]);

            if ($request->role === 'broker') {
                $user->broker()->create([
                    // 'license_number' => $request->license_number,
                    // 'experience_years' => $request->experience_years,
                    // 'is_professional' => $request->is_professional,
                    'created_at' => now()
                ]);
            }

            return redirect()->route('admin.users.create')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create user. Please try again.' . $e->getMessage())->withInput();
        }
    }
    /**
     * Show the form for editing a user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.users.edit_user', compact('user'));
    }

    /**
     * Update the specified user in the database.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'username' => 'nullable|string|max:50|unique:Users,username,' . $id . ',user_id',
            'email' => 'nullable|string|email|max:100|unique:Users,email,' . $id . ',user_id',
            'password' => 'nullable|string|min:8|confirmed',
            'full_name' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:15',
            'is_verified' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = [
                'updated_at' => now(),
            ];

            if ($request->filled('username')) {
                $data['username'] = $request->username;
            }
            if ($request->filled('email')) {
                $data['email'] = $request->email;
            }
            if ($request->filled('password')) {
                $data['password_hash'] = $request->password; // Handled by mutator in User model
            }
            if ($request->has('full_name')) { // Use has() to allow empty string
                $data['full_name'] = $request->full_name;
            }
            if ($request->has('phone_number')) { // Use has() to allow empty string
                $data['phone_number'] = $request->phone_number;
            }
            $data['is_verified'] = $request->is_verified;

            $user->update($data);

            return redirect()->route('admin.users.user')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update user. Please try again.')->withInput();
        }
    }

    /**
     * Delete the specified user from the database.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.users.user')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.user')->with('error', 'Failed to delete user. Please try again.');
        }
    }
}
