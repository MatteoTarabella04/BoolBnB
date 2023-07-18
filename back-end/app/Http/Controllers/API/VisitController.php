<?php

namespace App\Http\Controllers\API;

use App\Models\Visit;
use App\Http\Requests\StoreVisitRequest;
use App\Http\Requests\UpdateVisitRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VisitController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVisitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVisitRequest $request)
    {
        $recordNotPresent = DB::table('visits')->where([
            ['ip_address', '=', $request->ip_address],
            ['apartment_id', '=', $request->apartment_id],
        ])->get()->isEmpty();

        if($recordNotPresent) {
            $visit = Visit::create([
                "apartment_id" => $request->apartment_id,
                "visit_date" => $request->visit_date,
                "ip_address" => $request->ip_address
            ]);
    
            return response()->json([
                "success" => true,
                "visit" => $visit,
            ]);
        } else {
            return response()->json([
                "success" => true,
                "visit" => "Apartment already visited",
            ]);
        }
    }
}
