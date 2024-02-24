<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index(){
        $ruangan = Ruangan::all();

        return response()->json([
            'success' => true,
            'message' => 'Data ruangan berhasil diambil.',
            'data' => $ruangan,
        ]);
    }
}
