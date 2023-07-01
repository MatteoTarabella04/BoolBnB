<?php

namespace Database\Seeders;

use App\Models\ApartmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartment_types = config("db.apartment_types");
        foreach ($apartment_types as $apartment_type) {
            $newApartmentType = new ApartmentType();
            $newApartmentType->name = $apartment_type;
            $newApartmentType->save();
        }
    }
}
