<?php

use Illuminate\Database\Seeder;
use Corp\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(
            [
                'title'=>'Блог',
                'alias'=>'blog',
            ]
        );
        Category::create(
            [
                'title'=>'Компьютеры',
                'alias'=>'computers',
            ]
        );
        Category::create(
            [
                'title'=>'Интересное',
                'alias'=>'interesting',
            ]
        );
        Category::create(
            [
                'title'=>'Советы',
                'alias'=>'recommendations',
            ]
        );
    }
}
