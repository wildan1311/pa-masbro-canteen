<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menus;
use App\Response\ResponseApi;
use Illuminate\Http\Request;

class MenuKategoriController extends Controller
{
    public function index(){
        $menuKategori = Menus::all();
        return ResponseApi::success($menuKategori);
    }
}
