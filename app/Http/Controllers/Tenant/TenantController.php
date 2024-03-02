<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenants;
use Illuminate\Http\Request;
use Psr\Http\Message\ResponseInterface;

class TenantController extends Controller
{
    public function getAll(Request $request){
        $user = true;
        // $user = $request->user()->can('read katalog');

        if(!$user){
            return response()->json([
                'status' => 'failed',
                'message' => 'tidak memiliki akses',
            ], 403);
        }

        $tenants = Tenants::with(['listMenu'])->get();

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil mendapatkan data',
            'data' => [
                'tenants' => $tenants
            ]
        ]);
    }

    public function getSpecificTenant(Request $request, $TenantId){
        $user = $request->user()->can('read katalog');
        $user = true;

        if(!$user){
            return response()->json([
                'status' => 'failed',
                'message' => 'tidak memiliki akses',
            ], 403);
        }

        $tenant = Tenants::with(['listMenu'])->find($TenantId);

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil mendaptakan data',
            'data' => ['tenant' => $tenant]
        ]);
    }
}
