<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAccountController extends Controller
{
    public function index()
    {

        if (Auth::user()?->role !== 'admin') {
            $useraccount = User::where('username', Auth::user()->username)->get();
        } else {
            $useraccount = User::all();
        }
        return view('masterdata.useraccount', compact('useraccount'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|exists:user,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->where('username',$request->username)->update(['password' => Hash::make($request->password), 'updated_at' => now(),]);

        // return redirect()->route('useraccount.index')->with('success', 'Password berhasil diperbarui! Password Baru : '.$request->password);
        return redirect()->route('useraccount.index')->with('success', 'Password berhasil diperbarui!');

    }

}
