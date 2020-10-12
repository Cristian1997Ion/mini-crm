<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get last 30 client_ids
        $clientIds = DB::table('clients')
            ->select('id')
            ->orderByDesc('id')
            ->limit(30)
            ->get()
            ->toArray();

        if (empty($clientIds)) {
            return;
        }

        $data = [];
        for ($i = 0; $i < 30; $i++) {
            $faker = Factory::create();
            // Get a random client_id
            $clientId = $clientIds[array_rand($clientIds)]->id;

            $data[] = [
                'client_id' => $clientId,
                'amount'    => $faker->randomFloat(2, -100000, 100000),
            ];
        }

        DB::table('transactions')->insert($data);

    }
}
