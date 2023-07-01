<?php

namespace Database\Seeders;

use App\Models\SponsorizationPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorizationPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorization_plans = config("db.sponsorization_plans");
        foreach ($sponsorization_plans as $sponsorization_plan) {
            $newSponsorizationPlan = new SponsorizationPlan();
            $newSponsorizationPlan->name = $sponsorization_plan["name"];
            $newSponsorizationPlan->duration = $sponsorization_plan["duration"];
            $newSponsorizationPlan->price = $sponsorization_plan["price"];
            $newSponsorizationPlan->notes = $sponsorization_plan["notes"];
            $newSponsorizationPlan->save();
        }
    }
}
