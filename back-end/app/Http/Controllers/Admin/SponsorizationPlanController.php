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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSponsorizationPlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSponsorizationPlanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SponsorizationPlan  $sponsorizationPlan
     * @return \Illuminate\Http\Response
     */
    public function show(SponsorizationPlan $sponsorizationPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SponsorizationPlan  $sponsorizationPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(SponsorizationPlan $sponsorizationPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSponsorizationPlanRequest  $request
     * @param  \App\Models\SponsorizationPlan  $sponsorizationPlan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSponsorizationPlanRequest $request, SponsorizationPlan $sponsorizationPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SponsorizationPlan  $sponsorizationPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SponsorizationPlan $sponsorizationPlan)
    {
        //
    }
}