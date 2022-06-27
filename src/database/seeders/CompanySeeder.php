<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();

        $json = file_get_contents('database/data/data.json');
        $data = json_decode($json, true);

        $map = [];
        $bulk = [];

        foreach ($data as $i => $shipment) {
            $company = $shipment['company'];

            if (isset($map[$company['email']])) {
                continue;
            }

            $bulk[] = [
                'name' => $company['name'],
                'email' => $company['email'],
            ];

            $map[$company['email']] = true;

            if ($i % 1000 === 0 && $i !== 0) {
                Company::upsert($bulk, ['email']);

                $bulk = [];
            }
        }

        if (count($bulk) > 0) {
            Company::upsert($bulk, ['email']);
        }
    }
}
