<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use Illuminate\Http\Request;
use Psr\Http\Message\ResponseInterface;

class TenantController extends Controller
{
    public function getAll(){
        $tenants = Tenants::with(['listMenu' => function($query) {
            $query->limit(5);
        }])->get();

        return response()->json(compact($tenants));
    }

    public function getSpecificTenant($id){
        $tenants = Tenants::find($id)->with(['listMenu'])->get();

        return response()->json(compact($tenants));
    }
}
