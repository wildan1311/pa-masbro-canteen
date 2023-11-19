<?php

namespace App\Http\Controllers\Kelola;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tenantUserId)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ''
        ]);
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
    public function update(Request $request, Tenants $tenants)
    {
        Gate::authorize('update-tenant', $tenants);

        $validator = Validator::make($request->all(), [
            'nama_kavling' => 'required',
            'nama_tenant' => 'required',
            'gambar' => 'required|mimes:png,jpg',
            'jam' => 'required|timezone'
        ]);

        if($validator->fails()){
            return response()->json([
                'messages' => $validator->errors()
            ]);
        }

        $update = $tenants->update($request->all());

        if(!$update){
            return response()->json([
                'messages' => 'gagal'
            ]);
        }

        return response()->json([
            'messages' => 'berhasil'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
