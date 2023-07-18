<?php

namespace App\Http\Controllers;

use App\Models\ApartmentType;
use App\Http\Requests\StoreApartmentTypeRequest;
use App\Http\Requests\UpdateApartmentTypeRequest;

class ApartmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreApartmentTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApartmentType  $apartmentType
     * @return \Illuminate\Http\Response
     */
    public function show(ApartmentType $apartmentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApartmentType  $apartmentType
     * @return \Illuminate\Http\Response
     */
    public function edit(ApartmentType $apartmentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApartmentTypeRequest  $request
     * @param  \App\Models\ApartmentType  $apartmentType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentTypeRequest $request, ApartmentType $apartmentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApartmentType  $apartmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApartmentType $apartmentType)
    {
        //
    }
}
