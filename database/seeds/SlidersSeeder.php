<?php

use Illuminate\Database\Seeder;
use Corp\Slider;

class SlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create(
            [
                'image'=>'xx.jpg',
                'descript'=>'Nam id quam a odio euismod pellentesque. Etiam congue rutrum risus non vestibulum. Quisque a diam at ligula blandit consequat. Mauris ac mi velit, a tempor neque',
                'title'=>'<h2 style="color:#fff">CORPORATE, MULTIPURPOSE.. <br /><span>PINK RIO</span></h2>',
            ]
        );
        Slider::create(
            [
                'image'=>'00314.jpg',
                'descript'=>'Nam id quam a odio euismod pellentesque. Etiam congue rutrum risus non vestibulum. Quisque a diam at ligula blandit consequat. Mauris ac mi velit, a tempor neque',
                'title'=>'<h2 style="color:#fff">PINKRIO. <span>STRONG AND POWERFUL.</span></h2>',
            ]
        );
        Slider::create(
            [
                'image'=>'dd.jpg',
                'descript'=>'Nam id quam a odio euismod pellentesque. Etiam congue rutrum risus non vestibulum. Quisque a diam at ligula blandit consequat. Mauris ac mi velit, a tempor neque',
                'title'=>'<h2 style="color:#fff">PINKRIO. <span>STRONG AND POWERFUL.</span></h2>',
            ]
        );
    }
}
