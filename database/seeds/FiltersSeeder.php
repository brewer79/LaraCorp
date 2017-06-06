<?php

use Illuminate\Database\Seeder;
use Corp\Filter;

class FiltersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Filter::create(
            [
                'title'=>'Brand Identity',
                'alias'=>'brand-identity',
                'created_at'=>'2017-04-18 16:34:17',
            ]
        );
    }
}
