<?php

namespace Database\Seeders;

use App\Http\Controllers\ClientController;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for ($i = 0; $i < 50; $i++){
            $faker = Factory::create();
            $data[] = [
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'email'      => $faker->email,
                'avatar'     => ClientController::DEFAULT_AVATAR
            ];

        }

        // Multi insert faker data
        DB::table('clients')->insert($data);
    }
}
