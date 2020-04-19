<?php

use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branch = new \App\Branch();
        $branch->branch_name = 'Trishapta Head Office';
        $branch->location = 'Butwal';
        $branch->description = 'Head Office';
        $branch->save();
    }
}
