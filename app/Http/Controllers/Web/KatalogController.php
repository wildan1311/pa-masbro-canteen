<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KatalogController extends Controller
{
    public function index(){
        $this->authorize('read katalog');

        $user = Auth::user();

        $tenant = Tenants::whereHas('pemilik', function($pemilik) use($user){
            $pemilik->where('user_id', $user->id);
        })->with('listMenu')->first();

        return view('pages.katalog.index', compact('tenant'));
    }
}
