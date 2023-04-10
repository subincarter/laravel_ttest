<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customers;
use Illuminate\Support\Facades\Log;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customers::truncate();
        $csvData = fopen(base_path('database/csv/customers.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                try {
                    Customers::create([
                        'firstName' => $data['0'],
                        'lastName' => $data['1'],
                        'phoneNumber' => $data['2'],
                        'email' => $data['3'],
                    ]);
                  }
                  //catch exception
                  catch(\Exception $e) {
                    Log::channel('importError')->error($e->getMessage(),$data);
                    return false;
                  }
            }
            $transRow = false;
        }
        Log::channel('importError')->info('import success');
        fclose($csvData);
    }
}
