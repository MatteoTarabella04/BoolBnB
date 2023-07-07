<?php

namespace App\Http\Controllers\API;

use App\Models\Apartment;
use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Models\ApartmentType;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $apartments = Apartment::with(['apartment_type', 'services', 'visits'])->orderByDesc('id')->get();

        if ($apartments) {
            return response()->json([
                'success' => true,
                'apartments' => $apartments
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function all() {
        $apartments = Apartment::with(['apartment_type', 'services', 'visits'])->orderByDesc('id')->get();
        $apartment_types = ApartmentType::orderBy("name")->get();
        $services = Service::orderBy("name")->get();

        if ($apartments && $services) {
            return response()->json([
                'success' => true,
                'apartments' => $apartments,
                'apartment_types' => $apartment_types,
                'services' => $services
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function show($slug) {
        $apartment = Apartment::with(['apartment_type', 'services'])->where("slug", $slug)->get();
        if ($apartment) {
            return response()->json([
                "success" => true,
                "apartment" => $apartment[0],
            ]);
        } else {
            return response()->json([
                "success" => false,
            ]);
        }
    }
}
