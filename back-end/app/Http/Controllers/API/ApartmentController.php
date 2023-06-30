<?php

namespace App\Http\Controllers\API;

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

        return view('admin.apartments.index', compact('apartments'));
    }

    public function create()
    {
        return view('admin.apartments.create');
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
        //dd($val_data);

        // generate the title slug
        $slug = Apartment::generateSlug($val_data['name']);
        //dd($slug);
        $val_data['slug'] = $slug;
        //dd($val_data);

        $val_data['user_id'] = Auth::id();
        //dd($val_data);


        if ($request->hasFile('image')) {
            $image_path = Storage::put('uploads', $request->image);
            //dd($image_path);
            $val_data['image'] = $image_path;
        }

        $new_apartment = Apartment::create($val_data);

        return to_route('apartments.index')->with('message', 'Annuncio aggiunto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    public function edit(Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            return view('admin.apartments.edit', compact('apartments'));
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
        //dd($val_data);

        // generate the title slug
        $slug = Apartment::generateSlug($val_data['name']);
        //dd($slug);
        $val_data['slug'] = $slug;
        //dd($val_data);


        if ($request->hasFile('image')) {

            if ($apartment->image) {
                Storage::delete($apartment->image);
            }

            $image_path = Storage::put('uploads', $request->image);
            //dd($image_path);
            $val_data['image'] = $image_path;
        }


        $apartment->update($val_data);

        return to_route('apartments.index')->with('message', 'Annuncio: ' . $apartment->name . 'Aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        // remove the image from the storage
        if ($apartment->image) {
            Storage::delete($apartment->image);
        }
        $apartment->delete();
        return to_route('admin.apartments.index')->with('message', 'Annuncio: ' . $apartment->name . 'Eliminato');
    }
}