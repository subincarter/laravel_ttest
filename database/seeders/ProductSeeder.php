<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::truncate();
        $csvData = fopen(base_path('database/csv/products.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                try {
                    Products::create([
                        'productname' => $data['1'],
                        'price' => $data['2'],
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
        Log::error('error');
        fclose($csvData);
    }
}
