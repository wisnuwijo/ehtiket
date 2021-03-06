<?php

namespace Ehtiket\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use DB;
use Auth;
use Redirect;

class UserController extends Controller
{
    public function register(Request $request)
    {
        return view('app.register');
    }

    public function show_user(Request $request)
    {
        $getUser = DB::table('users')
                    ->join('table_roles','users.role_id','table_roles.id')
                    ->where('users.institution_id', Auth::user()->institution_id)
                    ->select([
                        'users.*',
                        'table_roles.role_name'
                    ])
                    ->orderBy('users.id','desc')
                    ->paginate(15);

        $data = [
            'data' => $getUser
        ];

        return view('modules.user.index', $data);
    }

    public function add_user(Request $request)
    {
        return view('modules.user.add');
    }

    public function save(Request $request)
    {
        $insertUser = DB::table('users')
                      ->insert([
                          'name' => $request->name,
                          'email' => $request->email,
                          'password' => bcrypt($request->password),
                          'gender' => $request->gender,
                          'phone' => $request->phone,
                          'role_id' => 2,
                          'institution_id' => Auth::user()->institution_id,
                          'created_at' => now(),
                      ]);

        return redirect('user')->with(['success' => 'Pengguna baru berhasil disimpan']);
    }

    public function check_email(Request $request)
    {
        if ($request->id != null) {
            $checkEmail = DB::table('users')
                          ->where([
                              ['id', '!=', $request->id],
                              ['email',$request->email]
                          ])
                          ->count();
        } else {
            $checkEmail = DB::table('users')->where('email', $request->email)->count();
        }
        return $checkEmail;
    }

    public function delete(Request $request, $id)
    {
        $getUser = DB::table('users')
                    ->where('id', $id)
                    ->first();

        $deleteUser = DB::table('users')->where('id', $id)->delete();
        return redirect('user')->with(['success' => $getUser->name.' berhasil dihapus']);
    }

    public function edit(Request $request, $id)
    {
        $getUser = DB::table('users')->where('id', $id)->first();

        $data = [
            'data' => $getUser
        ];
        return view('modules.user.edit', $data);
    }

    public function update_user(Request $request)
    {
        if ($request->password != null) {
            $updateUser = DB::table('users')
                          ->where('id', $request->id)
                          ->update([
                              'name' => $request->name,
                              'email' => $request->email,
                              'password' => bcrypt($request->password),
                              'gender' => $request->gender,
                              'phone' => $request->phone,
                              'updated_at' => now(),
                          ]);
        } else {
            $updateUser = DB::table('users')
                          ->where('id', $request->id)
                          ->update([
                              'name' => $request->name,
                              'email' => $request->email,
                              'gender' => $request->gender,
                              'phone' => $request->phone,
                              'updated_at' => now(),
                          ]);
        }

        return redirect('user')->with(['success' => 'Data berhasil disimpan']);
    }

    public function register_new_user(Request $request)
    {
        if ($request->origin_institution != null && $request->origin_institution_address != null) {
            $institutionId = count(DB::table('table_institution')->get()) + 1;
            $createdIntitution = DB::table('table_institution')
                                 ->insert([
                                     'id' => $institutionId,
                                     'institution_name' => $request->origin_institution,
                                     'institution_address' => $request->origin_institution_address
                                 ]);
        }

        $createUser = DB::table('users')
                      ->insert([
                          'name' => $request->name,
                          'email' => $request->email,
                          'password' => bcrypt($request->password),
                          'role_id' => 3,
                          'gender' => $request->gender,
                          'identifier_type' => $request->identifier_type,
                          'identifier_file' => $request->identifier_file,
                          'institution_id' => $institutionId ?? null,
                          'phone' => $request->phone,
                          'created_at' => now()
                      ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }
    }

    public function register_or_login(Request $request)
    {
        if ($request->action == 'register') {
            // register
            if ($request->origin_institution != null && $request->origin_institution_address != null) {
                $institutionId = count(DB::table('table_institution')->get()) + 1;
                $createdIntitution = DB::table('table_institution')
                                    ->insert([
                                        'id' => $institutionId,
                                        'institution_name' => $request->origin_institution,
                                        'institution_address' => $request->origin_institution_address
                                    ]);
            }

            $createUser = DB::table('users')
                        ->insert([
                            'name' => $request->name,
                            'email' => $request->email,
                            'password' => bcrypt($request->password),
                            'role_id' => 3,
                            'gender' => $request->gender,
                            'identifier_type' => $request->identifier_type,
                            'identifier_file' => $request->identifier_file,
                            'institution_id' => $institutionId ?? null,
                            'phone' => $request->phone,
                            'created_at' => now()
                        ]);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return Redirect::to($request->fromUrl);
            }
        } else {
            // login
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return Redirect::to($request->fromUrl);
            }
        }
    }
}
