<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use App\Models\customer;
use Illuminate\Database\Seeder;
use DB;

class customerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $plainpassword = '123';
        $encrypted = password_hash($plainpassword, PASSWORD_BCRYPT);

        for ($i = 1; $i <= 10; $i++) {
            \DB::table('customer')->insert([
                'name' => $faker->name,
                'age' => $faker->numberBetween(18, 100),
                'username' => $faker->lastName,
                'password' => $encrypted,
                'role' => 'user',
                'profile_picture' => 'profile_pictures/default-profile.png'
            ]);
        }

        // echo "Password asli: " . $plainpassword . PHP_EOL;
    }
}
