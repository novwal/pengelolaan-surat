<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home.page')->with('success', 'Login Berhasil!');
        } else {
            return redirect()->back()->with('failed', 'Proses login gagal, silahkan coba kembali dengan data yang benar!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah logout!');
    }

    public function index()
    {
        return view('home');
    }

    public function Staffindex()
    {
        $users = User::all();
        return view('userStaff.index', compact('users'));
    }

    public function Guruindex()
    {
        $users = User::all();
        return view('userGuru.index', compact('users'));
    }

    public function Staffcreate()
    {
        return view('userStaff.create');
    }

    public function Gurucreate()
    {
        return view('userGuru.create');
    }

    public function Staffstore(Request $request)
    {
        $this->validateUser($request, 'staff');
        $this->createOrUpdateUser($request, 'staff');
        return redirect()->back()->with('success', 'Berhasil Menambah Data!');
    }

    public function Gurustore(Request $request)
    {
        $this->validateUser($request, 'guru');
        $this->createOrUpdateUser($request, 'guru');
        return redirect()->back()->with('success', 'Berhasil Menambah Data!');
    }

    public function Staffedit($id)
    {
        $user = User::find($id);
        return view('userStaff.edit', compact('user'));
    }

    public function Guruedit($id)
    {
        $user = User::find($id);
        return view('userGuru.edit', compact('user'));
    }

    public function Staffupdate(Request $request, $id)
    {
        $this->validateUser($request, 'staff', $id);
        $this->createOrUpdateUser($request, 'staff', $id);
        return redirect()->route('userStaff.home')->with('success', 'Akun berhasil diperbarui.');
    }

    public function Guruupdate(Request $request, $id)
    {
        $this->validateUser($request, 'guru', $id);
        $this->createOrUpdateUser($request, 'guru', $id);
        return redirect()->route('userGuru.home')->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil Menghapus Data!');
    }

    private function validateUser(Request $request, $role, $userId = null)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $userId,
            'role' => $role,
        ];

        if ($request->password) {
            $rules['password'] = 'required|min:8';
        }

        $request->validate($rules);
    }

    private function createOrUpdateUser(Request $request, $role, $userId = null)
    {
        $password = $request->password ? Hash::make($request->password) : null;

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'role' => $role,
        ];

        if ($userId) {
            User::find($userId)->update($userData);
        } else {
            User::create($userData);
        }
    }
}
