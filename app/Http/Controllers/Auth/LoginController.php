<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Auth;
use Hash;

class LoginController extends Controller
{
	public function authenticate()
	{
		$credentials = request()->only(['email', 'password']);

		if (Auth::attempt($credentials)) {
			if (Auth::user()->role == 'admin') {
				return redirect()->intended('admin');
			} else {
				return redirect()->intended('user');
			}
		} else {
			return back()->with('error', 'Login gagal');
		}
	}

	public function register(Request $request, User $user)
	{
		if ($request->password) {
			$password = Hash::make($request->password);
		} else {
			$password = $request->old_password;
		}

		$prepare = [
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'name' => $request->name,
			'role' => 'user',
			'member' => 'non member',
			'gender' => $request->gender,
		];

		$request->request->add(['password' => $password]);
		$res = $user->insert($prepare);
		if ($res) {
			return back()->with('success', 'Register successfully, please login now');
		} else {
			return back()->with('error', 'Register failed');
		}
	}
}
