<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('read katalog');

        $user = Auth::user();

        $tenant = Tenants::whereHas('pemilik', function ($pemilik) use ($user) {
            $pemilik->where('user_id', $user->id);
        })->with('listMenu');

        if ($request->has('search')) {
            $tenant->with('listMenu', function ($listMenu) use ($request) {
                $search = $request->search;
                $listMenu->where(function ($query) use ($search) {
                    $query->where('menus.nama', 'like', "%$search%");
                });
            });
        }
        $tenant = $tenant->first();
        // dd($tenant);
        return view('pages.katalog.index', compact('tenant'));
    }
}
