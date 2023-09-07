<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruangan = Ruangan::all();
        return response()->json([
            'data' => $ruangan
        ]);
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
            'nama' => 'required',
            'gedung_id' => 'required'
        ]);

        if($validator->fails()){
            // Return Exception error
            return response()->json($validator->errors());
        }

        $ruangan = Ruangan::create($request->all());

        if($ruangan){
            return response()->json([
                'messages' => 'Berhasil',
                'data' => $ruangan
            ]);
        }else{
            return response()->json([
                'messages' => 'Gagal',
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
        try{
            $ruangan = Ruangan::findOrFail($id);
            return response()->json(['messages' => 'Sukses', 'data' => $ruangan]);
        }catch(ModelNotFoundException $err){
            return response()->json(['messages' => 'Tidak Ditemukan']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'gedung_id' => 'required'
        ]);

        if($validator->fails()){
            // Return Exception error
            return response()->json($validator->errors());
        }

        $ruangan = Ruangan::where('id', $id)->create($request->all());

        if($ruangan){
            return response()->json([
                'messages' => 'Berhasil',
                'data' => $ruangan
            ]);
        }else{
            return response()->json([
                'messages' => 'Gagal',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruangan = Ruangan::find($id)->delete();
        if($ruangan){
            return response()->json([
                'messages' => 'Berhasil Update',
                'data' => $ruangan
            ]);
        }else{
            return response()->json([
                'messages' => 'Gagal',
            ]);
        }
    }
}
