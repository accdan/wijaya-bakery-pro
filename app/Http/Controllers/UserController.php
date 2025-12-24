<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Helpers\ImageOptimizer;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'asc')->with('role')->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'nullable|email|max:255|unique:users,email',
            'no_telepon' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'role_id' => 'required|exists:role,id',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $destinationPath = storage_path('app/public/uploads/profile');
            $filename = ImageOptimizer::processUpload($file, $destinationPath, null, 300, 85);
            if ($filename) {
                $data['profile_picture'] = $filename;
            }
        }

        User::create($data);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'no_telepon' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'role_id' => 'required|exists:role,id',
        ]);

        $data = $request->only([
            'name',
            'username',
            'email',
            'no_telepon',
            'password',
            'role_id'
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $destinationPath = storage_path('app/public/uploads/profile');
            $filename = ImageOptimizer::processUpload($file, $destinationPath, null, 300, 85);
            if ($filename) {
                $data['profile_picture'] = $filename;
            }
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function show($id)
    {
        $user = User::with('role')->findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->deletePengguna();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
    }
}

