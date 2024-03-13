<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use App\Response\ResponseApi;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $gedung = Gedung::all();
        return ResponseApi::success(compact('gedung'), 'data berhasil diambil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if($validator->fails()){
            // Return Exception error
            return ResponseApi::error($validator->errors()->all(), 403);
        }

        $gedung = Gedung::create($request->all());

        if($gedung){
            return ResponseApi::success(compact('gedung'), 'data berhasil diambil');
        }else{
            return ResponseApi::error('Gagal Membuat Gedung');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     */
    public function show($id)
    {
        try{
            $gedung = Gedung::findOrFail($id);
            return ResponseApi::success(compact('gedung'), 'data berhasil diambil');
        }catch(ModelNotFoundException $err){
            return ResponseApi::error('data tidak ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if($validator->fails()){
            // Return Exception error
            return ResponseApi::error($validator->errors()->all());
        }

        $gedung = Gedung::where('id', $id)->update($request->all());

        if($gedung){
            return ResponseApi::success(compact('gedung'), 'data berhasil diupdate');
        }else{
            return ResponseApi::error('gagal update gedung');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     */
    public function destroy($id)
    {
        $gedung = Gedung::find($id)->delete();
        if($gedung){
            return ResponseApi::success(compact('gedung'), 'data berhasil dihapus');
        }else{
            return ResponseApi::error('gagal menghapus gedung');
        }
    }
}
