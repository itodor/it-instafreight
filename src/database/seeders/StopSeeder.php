<?php

namespace Database\Seeders;

use App\Models\Stop;
use Illuminate\Database\Seeder;

class StopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stop::truncate();

        $json = file_get_contents('database/data/data.json');
        $data = json_decode($json, true);

        $bulk = [];

        foreach ($data as $i => $shipment) {
            foreach ($shipment['route'] as $j => $stop) {
                $bulk[] = [
                    'id' => $stop['stop_id'],
                    'postcode' => $stop['postcode'] === '' ? 00000 : $stop['postcode'],
                    'city' =>  $stop['city'] === '' ? 'undefined' : $stop['city'],
                    'country' =>  $stop['country'],
                    'shipment_id' =>  $shipment['id'],
                    'order_position' =>  $j,
                ];

                if ($i % 1000 === 0 && $i !== 0) {
                    Stop::upsert($bulk, ['id']);

                    $bulk = [];
                }
            }
        }

        if (count($bulk) > 0) {
            Stop::upsert($bulk, ['id']);
        }
    }
}
