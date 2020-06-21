<?php

use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Venue::class, 25)->create()->each(function ($venue) {
            $venue->venue_service()->save(factory(App\VenueService::class)->make());
            $venue->contact()->save(factory(App\ContactInfo::class)->make());
        });
    }
}
