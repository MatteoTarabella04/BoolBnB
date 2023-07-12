<?php

namespace App\Http\Controllers\API;

use App\Models\Apartment;
use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Models\ApartmentType;

class ApartmentController extends Controller
{
    /**
     * Updates the apartments data
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $apartments = Apartment::with(['apartment_type', 'services', 'visits', 'sponsorization_plans'])->orderByDesc('id')->get();

        if ($apartments) {
            return response()->json([
                'success' => true,
                'apartments' => $apartments,
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    /**
     * Updates the apartments data and also retrieves services and apartment types
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function all() {
        $apartments = Apartment::with(['apartment_type', 'services', 'sponsorization_plans'])->orderByDesc('id')->get();
        $apartment_types = ApartmentType::orderBy("name")->get();
        $services = Service::orderBy("name")->get();

        if ($apartments && $services) {
            return response()->json([
                'success' => true,
                'apartments' => $apartments,
                'apartment_types' => $apartment_types,
                'services' => $services,
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    /**
     * Updates the single apartment data
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug) {
        $apartment = Apartment::with(['apartment_type', 'services'])->where("slug", $slug)->first();
        if ($apartment) {
            return response()->json([
                "success" => true,
                "apartment" => $apartment,
            ]);
        } else {
            return response()->json([
                "success" => false,
            ]);
        }
    }
}
