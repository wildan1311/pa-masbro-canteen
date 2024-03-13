<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use App\Response\ResponseApi;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $ruangan = Ruangan::all();
        return ResponseApi::success(compact('ruangan'), 'data berhasil diambil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'gedung_id' => 'required'
        ]);

        if($validator->fails()){
            // Return Exception error
            return ResponseApi::error($validator->errors()->all());
        }

        $ruangan = Ruangan::create($request->all());

        if($ruangan){
            return ResponseApi::success(compact('ruangan'), 'data berhasil dibuat');
        }else{
            return ResponseApi::error('Gagal Membuat ruangan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        try{
            $ruangan = Ruangan::findOrFail($id);
            return ResponseApi::success(compact('ruangan'), 'data berhasil diambil');
        }catch(ModelNotFoundException $err){
            return ResponseApi::error('data gagal diambil');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'gedung_id' => 'required'
        ]);

        if($validator->fails()){
            // Return Exception error
            return ResponseApi::error($validator->errors()->all());
        }

        $ruangan = Ruangan::where('id', $id)->update($request->only(['nama','gedung_id']));

        if($ruangan){
            return ResponseApi::success(compact('ruangan'), 'data berhasil diupdate');
        }else{
            return ResponseApi::error('data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $ruangan = Ruangan::find($id)->delete();
        if($ruangan){
            return ResponseApi::success(compact('ruangan'), 'data berhasil dihapus');
        }else{
            return ResponseApi::error('data gagal dihapus');
        }
    }
}
