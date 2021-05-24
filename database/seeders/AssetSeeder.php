<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;
use Illuminate\Support\Carbon;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // asset 1
        $asset = new Asset();

        $asset->name = 'tastatura1';
        $asset->description = 'descrieere 1';
        $asset->input_date = now();
        $asset->cost_center_id = 1;

        $asset->save();


         // asset 2
         $asset = new Asset();

         $asset->name = 'tastatura2';
         $asset->description = 'descrieere 2';
         $asset->input_date = now();
         $asset->cost_center_id = 1;

         $asset->save();


          // asset 3
        $asset = new Asset();

        $asset->name = 'tastatura3';
        $asset->description = 'descrieere 3';
        $asset->input_date = now();
        $asset->cost_center_id = 2;

        $asset->save();

         // asset 4
         $asset = new Asset();

         $asset->name = 'tastatura4';
         $asset->description = 'descrieere 4';
         $asset->input_date = now();
         $asset->cost_center_id = 2;

         $asset->save();




    }
}
