<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admin(UsersDataTable $dataTables) {
        return $dataTables->render('dashboard.accounts.index');
    }

    public function create() {
        return view('dashboard.accounts.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
        ]);

        $user = User::latest()->first();
        $idColumn = $user->id ? $user->id + 1 : 0;
        $validated['password'] = bcrypt(substr($request->email, 0, 4) . $idColumn);
        $validated['default_pw'] = substr($request->email, 0, 4) . $idColumn;

        User::create($validated);

        return redirect()->route('dashboard.accounts.'. $validated['role'])->with('success', 'Akun berhasil dibuat');
    }

    public function edit(User $user) {
        return view('dashboard.accounts.edit', compact('user'));
    }

    public function editOperator() {
        return view('dashboard.accounts.editOperator');
    }

    public function update(Request $request, User $user) {
        if($request->password){
            $user->default_pw = 'This account already edited the password';
            $user->password = bcrypt($request->password);
        }
        if($request->email){
            $user->email = $request->email;
        }
        if($request->name){
            $user->name = $request->name;
        }
        $user->password = $user->password;
        $user->update();
        return back()->with('success', 'Akun berhasil diubah');
    }

    public function resetPassword(User $user) {
        $resetPassword = substr($user->email, 0, 4) . $user->id;

        $user->password = bcrypt($resetPassword);
        $user->default_pw = $resetPassword;

        $user->update();
        return back()->with('success', 'Password berhasil direset');
    }

    public function delete(User $user) {
        $user->delete();
        return redirect()->route('dashboard.accounts.'. $user->role)->with('success', 'Akun berhasil dihapus');
    }
}
