<?php

namespace App\Http\Controllers\Admin;

use App\Models\SponsorizationPlan;
use App\Http\Requests\StoreSponsorizationPlanRequest;
use App\Http\Requests\UpdateSponsorizationPlanRequest;
use App\Http\Controllers\Controller;
use App\Models\Apartment;

class SponsorizationPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Apartment $apartment)
    {
        $plans = SponsorizationPlan::all();
        return view('admin.sponsor.plans.index', compact('plans', 'apartment'));
    }
}