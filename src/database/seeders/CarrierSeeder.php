<?php

namespace Database\Seeders;

use App\Models\Carrier;
use Illuminate\Database\Seeder;

class CarrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carrier::truncate();

        $json = file_get_contents('database/data/data.json');
        $data = json_decode($json, true);

        $map = [];
        $bulk = [];

        foreach ($data as $i => $shipment) {
            $carrier = $shipment['carrier'];

            if (isset($map[$carrier['email']])) {
                continue;
            }

            $bulk[] = [
                'name' => $carrier['name'],
                'email' => $carrier['email'],
            ];

            $map[$carrier['email']] = true;

            if ($i % 1000 === 0 && $i !== 0) {
                Carrier::upsert($bulk, ['email']);

                $bulk = [];
            }
        }

        if (count($bulk) > 0) {
            Carrier::upsert($bulk, ['email']);
        }
    }
}
