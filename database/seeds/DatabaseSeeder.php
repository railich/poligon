<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);

        // Запукаем фабрику для постов 100 раз
        factory(\App\Models\BlogPost::class, 100)->create();
    }
}
