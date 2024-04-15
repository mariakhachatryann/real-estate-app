<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [ 'name' => 'Air Conditioning' ],
            [ 'name' => 'Swimming Pool' ],
            [ 'name' => 'Central Heating' ],
            [ 'name' => 'Laundry Room' ],
            [ 'name' => 'Gym' ],
            [ 'name' => 'Alarm' ],
            [ 'name' => 'Window Covering' ],
        ];

        Feature::insert($features);
    }
}
