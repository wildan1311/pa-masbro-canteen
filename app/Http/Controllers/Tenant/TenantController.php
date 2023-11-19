<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use Illuminate\Http\Request;
use Psr\Http\Message\ResponseInterface;

class TenantController extends Controller
{
    public function getAll(){
        $tenants = Tenants::with(['listMenu'])->get();

        return response()->json(compact('tenants'));
    }

    public function getSpecificTenant($TenantId){
        $tenant = Tenants::with(['listMenu'])->find($TenantId);

        return response()->json(compact('tenant'));
    }
}
