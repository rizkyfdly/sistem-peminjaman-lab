<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,user',
    ], [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
        'role.required' => 'Role wajib dipilih.',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'nim_nip' => $request->nim_nip,
        'jurusan' => $request->jurusan,
        'kelas' => $request->kelas,
        'role' => $request->role,
    ]);

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User berhasil ditambahkan');
}

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nim_nip' => $request->nim_nip,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.index');
    }

    public function profile()
    {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'nim_nip' => 'nullable|string|max:50',
            'kelas' =>'nullable|string|max:50',
            'jurusan' => 'nullable|string|max:100',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'kelas' => $request->kelas,
            'nim_nip' => $request->nim_nip,
            'jurusan' => $request->jurusan,
        ];

        // upload foto
        if($request->hasFile('foto')){

            $foto = $request->file('foto')
                            ->store('profile', 'public');

            $data['foto'] = $foto;
        }

        // password baru
        if($request->password){

            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('profile')
            ->with('success', 'Profil berhasil diupdate');
    }
}