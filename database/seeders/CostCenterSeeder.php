<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CostCenter;

class CostCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // cost center 1
        $cost_center = new CostCenter();

        $cost_center->name = 'cost-center1';
        $cost_center->manager_id = 1;
        $cost_center->delete_flag = false;

        $cost_center->save();

        // cost center 2
        $cost_center = new CostCenter();

        $cost_center->name = 'cost-center2';
        $cost_center->manager_id = 2;
        $cost_center->delete_flag = false;

        $cost_center->save();
    }
}
