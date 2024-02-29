<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Konfigurrasi\Menu;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Silber\Bouncer\Bouncer;
use Silber\Bouncer\BouncerFacade;

class AuthController extends Controller
{
    public function register(Request $request){
        $validate = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'name' => 'required',
            'role' => 'required'
        ]);

        if($validate->fails()){
            return response()->json([
                'messages' => $validate->errors()
            ]);
        }

        // User Management
        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Token Management
        $token = $newUser->createToken('secret')->plainTextToken;

        // Assign Role
        // BouncerFacade::assign($request->role)->to($newUser);
        $newUser->assignRole('user');

        return response()->json([
            'name' => $newUser->name,
            'token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
    public function login(Request $request){
        if(! Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'messages' => 'Unauthorization'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        // $menu = Menu::with('subMenus')->whereHas('permissions.roles.users', function($query) use ($user){
        //     $query->where('model_id', $user->id);
        // })->whereNull('main_menu_id')->get();

        $menu = Menu::get();

        $role = Role::findByName('user');
        $role->revokePermissionTo('read /katalog/pesan/antar');

        $menu = $menu->filter(function($mm) use($user){
            if($user->hasPermissionTo('read '.$mm->url)){
                return $mm;
            }
        })->values();

        $permission = ($user->getPermissionsViaRoles()->pluck('name')->toArray());

        $token = $user->createToken('secret', $permission)->plainTextToken;

        return response()->json([
            'nama' => $user->name,
            'token' => $token,
            'token_type' => 'Bearer',
            'role' => $user->getRoleNames(),
            'menu' => $menu,
            'permission' => $permission,
        ]);
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }
}
