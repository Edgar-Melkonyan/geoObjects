<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->delete();

        $types = [
            ['id' => 1, 'name' => 'Point'],
            ['id' => 2, 'name' => 'Line'],
            ['id' => 3, 'name' => 'Area'],
        ];

        DB::table('types')->insert( $types );
    }
}