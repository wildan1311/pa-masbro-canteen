<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Response\ResponseApi;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index(){
        $pengaturan = Pengaturan::all();
        return ResponseApi::success($pengaturan, "berhasil mengambil data");
    }
}
