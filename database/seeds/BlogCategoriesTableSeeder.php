<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        // Без категории
        $cName = 'Без категории';
        $categories[] = [
            'title' => $cName,
            'slug' => Str::slug($cName),
            'parent_id' => 0
        ];

        // Другие категории
        for ($i = 2; $i <= 11; $i++) {
            $cName = "Категория №$i";
            $parent_id = ($i > 4) ? rand(1, 4) : 1;
            $categories[] = [
                'title' => $cName,
                'slug' => Str::slug($cName),
                'parent_id' => $parent_id
            ];
        }

        // Заливаем это все в таблицу категорий блока
        DB::table('blog_categories')->insert($categories);
    }
}
