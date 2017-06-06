<?php

use Illuminate\Database\Seeder;
use Corp\Menu;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create(
            [
                'title'=>'Главная',
                'path'=>'http://corporate.loc',
            ]
        );
        Menu::create(
            [
                'title'=>'Блог',
                'path'=>'http://corp.brew/articles',
            ]
        );
        Menu::create(
            [
                'title'=>'Компьютеры',
                'path'=>'http://corp.brew/articles/cat/computers',
            ]
        );
        Menu::create(
            [
                'title'=>'Интересное',
                'path'=>'http://corp.brew/articles/cat/interesting',
            ]
        );
        Menu::create(
            [
                'title'=>'Советы',
                'path'=>'http://corp.brew/articles/cat/recommendations',
            ]
        );
        Menu::create(
            [
                'title'=>'Портфолио',
                'path'=>'http://corp.brew/portfolios',
            ]
        );
        Menu::create(
            [
                'title'=>'Контакты',
                'path'=>'http://corp.brew/contacts',
            ]
        );
    }
}
