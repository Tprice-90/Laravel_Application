<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('users')->truncate();
        $this->call(UserSeeder::class);

        DB::table('categories')->truncate();
        $this->call(CategorySeeder::class);

        DB::table('articles')->truncate();
        $this->call(ArticleSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
