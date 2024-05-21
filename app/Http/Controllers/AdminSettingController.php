<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminSettingController extends Controller
{
    public function index()
    {
        $guruRole = Role::where('name', 'guru')->first();

        $admins = DB::table('users')
            ->select(
                'name',
                'email'
            )
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('model_has_roles.role_id', $guruRole->id)
            ->paginate(10);

        return view('pages.auth.index', [
            'admins' => $admins
        ]);
    }
    public function register()
    {
        return view('pages.auth.register');
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->assignRole('guru');

        return redirect()->back()->with('success', 'Berhasil menambah admin!');
    }
}
