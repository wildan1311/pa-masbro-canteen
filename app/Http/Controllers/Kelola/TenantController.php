<?php

namespace App\Http\Controllers\Kelola;

use App\Http\Controllers\Controller;
use App\Models\MenusKelola;
use App\Models\Tenants;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $tenant = Tenants::where('user_id', $user->id)->with('listMenu')->get();
        return response()->json(compact('tenant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMenu(Request $request)
    {
        $tenant = Tenants::where("user_id", $request->user()->id)->first();
        Gate::authorize('add-tenant-menu', $tenant);

        $validator = Validator::make($request->all(), [
            'menu_id' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "Bad Request",
                "message" => $validator->errors()
            ], 400);
        }

        try {
            $newMenu = MenusKelola::create([
                "harga" => $request->harga,
                "gambar"=> $request->gambar ?? "halo",
                "tenant_id" => $tenant->id,
                "menu_id" => $request->menu_id
            ]);

            return response()->json([
                "status" => "success",
                "message" => "menu makanan berhasil ditambahkan",
                "data" => $newMenu
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => $th->getMessage(),
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $tenant = Tenants::where("user_id", $request->user()->id)->first();
        // Gate::authorize('update-tenant', $tenant);

        $validator = Validator::make($request->all(), [
            'nama_kavling' => 'required',
            'nama_tenant' => 'required',
            'gambar' => 'required|mimes:png,jpg',
            'jam' => 'required|timezone'
        ]);

        $image = $request->file('image');
        $fileName = time(). '-' . $image->getBasename() . '.' . $image->getClientOriginalExtension();
        $imagePath = Storage::disk('local')->put('public/images/', $fileName);

        if ($validator->fails()) {
            return response()->json([
                'messages' => $validator->errors()
            ]);
        }

        $update = $tenant->update([
            'nama_kavling' => $request->input('nama_kavling'),
            'nama_tenant' => $request->input('nama_tenant'),
            'jam' => Carbon::parse($request->input('jam'))->format('H:i:s'),
            'gambar' => $fileName
        ]);

        if (!$update) {
            return response()->json([
                'messages' => 'gagal'
            ]);
        }

        return response()->json([
            'messages' => 'berhasil'
        ]);
    }
    public function updateMenu(Request $request, $id)
    {
        // $tenant = Tenants::where("user_id", $request->user()->id)->first();
        $menu = MenusKelola::find($id);
        // Gate::authorize('update-tenant-menu', ["menu" => $menu]);

        $validator = Validator::make($request->all(), [
            'menu_id' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'nullable',
            'isReady' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'messages' => $validator->errors()
            ]);
        }

        try {
            $menu->update([
                "menu_id" => $request->menu_id,
                "harga" => $request->harga,
                "gambar" => $request->gambar ?? $menu->gambar,
                "isReady" => $request->isReady ?? $menu->isReady
            ]);

            return response()->json([
                'messages' => 'berhasil'
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                'status' => 'gagal',
                "messages" => "Terjadi Kesalahan Pada Server"
            ]);
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMenu($id)
    {
        try {
            $menu = MenusKelola::find($id)->delete();

            return response()->json([
                "status" => "success",
                "message" => "data berhasil dihapus",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "fail",
                "message" => $th->getMessage(),
            ]);
        }
    }
}
