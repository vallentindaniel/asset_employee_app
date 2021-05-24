<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\AssetUser;

class AssetEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // asset employee 1
        $asset_employee = new AssetUser();

        $asset_employee->asset_id = 1;
        $asset_employee->employee_id = 2;
        $asset_employee->from ='Germany';
        $asset_employee->to = 'Rom';
        //$asset_employee->end_of_life = date('2022-05-10');

        $asset_employee->save();

        // asset employee 2
        $asset_employee = new AssetUser();

        $asset_employee->asset_id = 2;
        $asset_employee->employee_id = 2;
        $asset_employee->from ='Germany';
        $asset_employee->to = 'Rom';
        $asset_employee->end_of_life = true;

        $asset_employee->save();

        // asset employee 3
        $asset_employee = new AssetUser();

        $asset_employee->asset_id = 1;
        $asset_employee->employee_id = 3;
        $asset_employee->from ='Germany';
        $asset_employee->to = 'Rom';
       // $asset_employee->end_of_life = date('2021-05-10');

        $asset_employee->save();

        // asset employee 4
        $asset_employee = new AssetUser();

        $asset_employee->asset_id = 3;
        $asset_employee->employee_id = 3;
        $asset_employee->from ='Germany';
        $asset_employee->to = 'Rom';
        $asset_employee->end_of_life = true;

        $asset_employee->save();



    }
}
