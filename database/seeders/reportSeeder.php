<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class reportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {
            \DB::table('reports')->insert([
                'title' => $faker->shuffleString('wadkawdlhwadwa'),
                'description' => $faker->sentence(15),
                'location' => '-6.223984118693082,106.65008068084717',
                'location_name' => 'Binus University Alam Sutera, Jalan Jalur Sutera Barat, Alam Sutera, Panunggangan, Pinang, Tangerang Selatan, Banten, Jawa, 15143, Indonesia',
                'image_path' => 'profile_pictures/default-profile.png',
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
        }
    }
}
