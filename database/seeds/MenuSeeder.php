<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('menus')->insert([
            'title' => "Статьи",
            'alias' => "articles",
            'numeration' => 1,
        ]);
        DB::table('menus')->insert([
            'title' => "Полезные материалы",
            'alias' => "refernces",
            'numeration' => 2,
        ]);
        DB::table('menus')->insert([
            'title' => "Работы",
            'alias' => "works",
            'numeration' => 3,
        ]);
        DB::table('menus')->insert([
            'title' => "Книги",
            'alias' => "books",
            'numeration' => 4,
        ]);
        DB::table('menus')->insert([
            'title' => "Обратная связь",
            'alias' => "feddback",
            'numeration' => 5,
        ]);

    }
}
