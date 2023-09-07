<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gedung = Gedung::all();
        return response()->json([
            'data' => $gedung
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
        ]);

        if($validator->fails()){
            // Return Exception error
            return response()->json($validator->errors());
        }

        $gedung = Gedung::create($request->all());

        if($gedung){
            return response()->json([
                'messages' => 'Berhasil',
                'data' => $gedung
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
            $gedung = Gedung::findOrFail($id);
            return response()->json(['messages' => 'Sukses', 'data' => $gedung]);
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
        ]);

        if($validator->fails()){
            // Return Exception error
            return response()->json($validator->errors());
        }

        $gedung = Gedung::where('id', $id)->update($request->all());

        if($gedung){
            return response()->json([
                'messages' => 'Berhasil Update',
                'data' => $gedung
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
        $gedung = Gedung::find($id)->delete();
        if($gedung){
            return response()->json([
                'messages' => 'Berhasil Update',
                'data' => $gedung
            ]);
        }else{
            return response()->json([
                'messages' => 'Gagal',
            ]);
        }
    }
}
