<?php

namespace App\Http\Controllers\Web\Konfigurasi;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $pengaturan = Pengaturan::all();
        return view('pages.konfigurasi.pengaturan.index', compact('pengaturan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('pages.konfigurasi.pengaturan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request, Pengaturan $pengaturan)
    {
        $request->validate([
            "nama" => 'required',
            "nilai" => 'required'
        ]);

        $pengaturan->nama = $request->nama;
        $pengaturan->nilai = $request->nilai;
        $pengaturan->save();

        return redirect()->route('pengaturan.index')->with(["status" => "success", "messages" => "Pengaturan Berhasil Ditambahkan"]);
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
    public function edit(Pengaturan $pengaturan)
    {
        return view('pages.konfigurasi.pengaturan.edit', compact('pengaturan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     */
    public function update(Request $request, Pengaturan $pengaturan)
    {
        $request->validate([
            "nama" => 'required',
            "nilai" => 'required'
        ]);

        $pengaturan->nama = $request->nama;
        $pengaturan->nilai = $request->nilai;
        $pengaturan->save();

        return redirect()->route('pengaturan.index')->with(["status" => "success", "messages" => "Pengaturan Berhasil Ditambahkan"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     */
    public function destroy(Pengaturan $pengaturan)
    {
        try {
            $pengaturan->delete();
            return redirect()->route('pengaturan.index')->with(["status" => "success", "messages" => "Pengaturan Berhasil Dihapus"]);
        } catch (\Throwable $th) {
            return redirect()->route('pengaturan.index')->with(["status" => "failed", "messages" => "Pengaturan Gagal Dihapus"]);
        }
    }
}
