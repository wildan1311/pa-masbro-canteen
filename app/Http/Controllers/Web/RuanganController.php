<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('read ruangan');
        $ruangan = Ruangan::all();
        return view('pages.konfigurasi.ruangan.index', compact('ruangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gedung = Gedung::all();
        return view('pages.konfigurasi.ruangan.create', compact('gedung'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'gedung_id' => 'required',
            'kode_ruangan' => 'required',
        ]);

        Ruangan::create([
            'nama' => $request->nama,
            'gedung_id' => $request->gedung_id,
            'kode_ruangan' => $request->kode_ruangan,
        ]);

        return redirect()->route('ruangan.index')->with(["status" => "success", 'message' => "Data Berhasil Diinputkan"]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gedung = Gedung::all();
        $ruangan = Ruangan::find($id);
        return view('pages.konfigurasi.ruangan.edit', compact('gedung', 'ruangan'));
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
        $request->validate([
            'nama' => 'required',
            'gedung_id' => 'required',
            'kode_ruangan' => 'required',
        ]);

        Ruangan::find($id)->update([
            'nama' => $request->nama,
            'gedung_id' => $request->gedung_id,
            'kode_ruangan' => $request->kode_ruangan,
        ]);

        return redirect()->route('ruangan.index')->with(["status" => "success", 'message' => "Ruangan berhasil diupdate"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ruangan::find($id)->delete();
        return redirect()->route('ruangan.index')->with(["status" => "success", 'message' => "Ruangan berhasil dihapus"]);
    }
}
