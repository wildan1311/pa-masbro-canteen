<?php

namespace App\Http\Controllers\Api;

use App\Helper\RoleHelper;
use App\Http\Controllers\Controller;
use App\Models\Konfigurrasi\Menu;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
// use Silber\Bouncer\Bouncer;
use Silber\Bouncer\BouncerFacade;
use Throwable;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|unique:users,email|email|regex:/^\S*$/',
            'password' => 'required',
            'name' => 'required',
            'role' => 'nullable'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'messages' => $validate->errors()
            ], 422);
        }

        DB::beginTransaction();
        try{
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Token Management
            $token = $newUser->createToken('secret')->plainTextToken;

            if ($request->role) {
                // check role ada di database
                RoleHelper::isRoleExist($request->role);

                $newUser->assignRole($request->role);
            } else {
                $newUser->assignRole('user');
            }
            DB::commit();
        }catch(Throwable $th){
            DB::rollBack();
            Log::error($th->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan'
            ], 500);
        }

        // User Management
        return response()->json([
            'name' => $newUser->name,
            'token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'messages' => $validate->errors()
            ], 422);
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => 'failed',
                'messages' => 'email atau password salah'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        $menu = Menu::whereHas('device', function($device){
            return $device->where('device_id', 1);
        })->get();

        $menu = $menu->filter(function ($mm) use ($user) {
            if ($user->hasPermissionTo('read ' . $mm->name)) {
                return $mm;
            }
        })->values();

        $permission = ($user->getPermissionsViaRoles()->pluck('name')->toArray());

        $token = $user->createToken('secret', $permission)->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil login',
            'data' => [
                'nama' => $user->name,
                'token' => $token,
                'token_type' => 'Bearer',
                'role' => $user->getRoleNames(),
                'menu' => $menu,
                'permission' => $permission,
            ],
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'logout success'
        ]);
    }
}
