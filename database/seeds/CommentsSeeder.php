<?php

use Illuminate\Database\Seeder;

use Corp\Comment;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create(
            [
                'text'=>'Good morning',
                'name'=>'Brewer',
                'email'=>'eurocenter@ukr.net',
                'site'=>'eurocenter.kiev.ua',
                'article_id'=>'1',
            ]
        );
        Comment::create(
            [
                'text'=>'Good morning',
                'name'=>'Brewer',
                'email'=>'eurocenter@ukr.net',
                'site'=>'eurocenter.kiev.ua',
                'article_id'=>'1',
            ]
        );
    }
}
