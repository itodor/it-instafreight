<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(Request $req)
    {
        $query = Shipment::join('companies', 'shipments.company_id', '=', 'companies.id')
            ->join('carriers', 'shipments.carrier_id', '=', 'carriers.id')
            ->join('stops', 'shipments.id', '=', 'stops.shipment_id')
            ->with('company')
            ->with('carrier')
            ->with('stops')
            ->select('shipments.*');

        if ($req->has('company')) {
            $query->where(function ($query) use ($req) {
                $query->where('companies.email', 'ilike', sprintf('%%%s%%', $req->get('company')))
                    ->orWhere('companies.name', 'ilike', sprintf('%%%s%%', $req->get('company')));
            });
        }

        if ($req->has('carrier')) {
            $query->where(function ($query) use ($req) {
                $query->where('carriers.email', 'ilike', sprintf('%%%s%%', $req->get('carrier')))
                    ->orWhere('carriers.name', 'ilike', sprintf('%%%s%%', $req->get('carrier')));
            });
        }

        if ($req->has('address')) {
            $location = $req->get('address');

            if (isset($location['postcode'])) {
                $query->where('stops.postcode', '=', $location['postcode']);
            } elseif (isset($location['city'])) {
                $query->where('stops.city', 'ilike', $location['city']);
            }
        }

        return response()->json($query->groupBy('shipments.id')->paginate(20)->withQueryString());
    }
}
