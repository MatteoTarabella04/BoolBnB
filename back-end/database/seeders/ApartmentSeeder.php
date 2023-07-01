<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = config("db.apartments");
        foreach ($apartments as $key => $apartment) {
            // USED TO RETRIEVE NEXT ID THAT WILL BE USED
            $statement = DB::select("SHOW TABLE STATUS LIKE 'apartments'");
            $nextId = $statement[0]->Auto_increment;
            
            $newApartment = new Apartment();
            $newApartment->user_id = 1;
            $newApartment->apartment_type_id = 1;
            $newApartment->name = $apartment["name"];
            $newApartment->description = $apartment["description"];
            $newApartment->price_per_night = $apartment["price_per_night"];
            $newApartment->rooms = $apartment["rooms"];
            $newApartment->beds = $apartment["beds"];
            $newApartment->bathrooms = $apartment["bathrooms"];
            $newApartment->square_meters = $apartment["square_meters"];
            $newApartment->address = $apartment["address"];
            $newApartment->latitude = $apartment["latitude"];
            $newApartment->longitude = $apartment["longitude"];
            $newApartment->image = $apartment["image"];
            $newApartment->slug = Apartment::generateSlug($apartment["name"]) . "-" . $nextId;
            $newApartment->save();
        }
    }
}
