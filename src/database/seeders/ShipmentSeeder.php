<?php

namespace Database\Seeders;

use App\Models\Carrier;
use App\Models\Company;
use App\Models\Shipment;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shipment::truncate();

        $json = file_get_contents('database/data/data.json');
        $data = json_decode($json, true);

        $companyMap = [];
        $carrierMap = [];
        $bulk = [];

        foreach ($data as $i => $shipment) {
            $company = $shipment['company'];
            $carrier = $shipment['carrier'];

            if (!isset($companyMap[$company['email']])) {
                $companyMap[$company['email']] = Company::where('email', $company['email'])->first()->getAttribute('id');
            }

            if (!isset($carrierMap[$carrier['email']])) {
                $carrierMap[$carrier['email']] = Carrier::where('email', $carrier['email'])->first()->getAttribute('id');
            }

            $bulk[] = [
                'id' => $shipment['id'],
                'distance' => $shipment['distance'],
                'time' => $shipment['time'],
                'company_id' => $companyMap[$company['email']],
                'carrier_id' => $carrierMap[$carrier['email']],
                'price' => $this->_calculatePrice($shipment['distance']),
            ];

            if ($i % 1000 === 0 && $i !== 0) {
                Shipment::upsert($bulk, ['id']);

                $bulk = [];
            }
        }

        if (count($bulk) > 0) {
            Shipment::upsert($bulk, ['id']);
        }
    }

    /**
     * @param int $distance
     *
     * @return int
     */
    private function _calculatePrice(int $distance): int
    {
        $kilometers = (int) round($distance / 1000);

        if ($kilometers <= 100) {
            return $kilometers * 30;
        } elseif ($kilometers <= 200) {
            return (100 * 30) + (($kilometers - 100) * 25);
        } elseif ($kilometers <= 300) {
            return (100 * 30) + (100 * 25) + (($kilometers - 200) * 20);
        }

        return (100 * 30) + (100 * 25) + (100 * 20) + (($kilometers - 300) * 15);
    }
}
