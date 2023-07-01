<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Auth::user()->apartments()->orderByDesc('id')->paginate(6);
        return view("admin.apartments.index", compact("apartments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.apartments.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        $val_data = $request->validated();
        $val_data["slug"] = Apartment::generateSlug($val_data["name"]);
        if(count(Apartment::where('slug', $val_data["slug"])->get()->toArray()) > 0) {
            return to_route("admin.apartments.create")->with("message", "Per favore usa un nome univoco, senza considerare la punteggiatura");
        }
        $val_data["user_id"] = Auth::id();
        if($request->hasFile("image")) {
            $imagePath = Storage::put("uploads", $val_data["image"]);
            $val_data["image"] = $imagePath;
        }
        $newApartment = Apartment::create($val_data);
        return to_route("admin.apartments.index")->with("message", "Annuncio aggiunto");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view("admin.apartments.show", compact("apartment"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            return view("admin.apartments.edit", compact("apartment"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApartmentRequest  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $val_data = $request->validated();
        $val_data["slug"] = Apartment::generateSlug($val_data["name"]);
        if(count(Apartment::where('slug', $val_data["slug"])->get()->toArray()) > 1) {
            return to_route("admin.apartments.edit", $apartment)->with("message", "Per favore usa un nome univoco, senza considerare la punteggiatura");
        }
        if($request->hasFile("image")) {
            if($apartment->image) {
                Storage::delete($apartment->image);
            }
            $imagePath = Storage::put("uploads", $val_data["image"]);
            $val_data["image"] = $imagePath;
        }
        $apartment->update($val_data);
        return to_route("admin.apartments.show", $apartment)->with("message", "Annuncio: " . $apartment->name . " aggiornato");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        if($apartment->image) {
            Storage::delete($apartment->image);
        }
        $apartment->delete();
        return to_route("admin.apartments.index")->with("message", "Annuncio: " . $apartment->name . " eliminato");
    }
}
